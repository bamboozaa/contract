<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuaranteeController extends Controller
{
    public function index(Request $request)
    {
        // ดึงรายการปีที่มีในฐานข้อมูล
        $years = Contract::select('contract_year')
            ->distinct()
            ->whereNotNull('types_of_guarantee')
            ->orderBy('contract_year', 'desc')
            ->pluck('contract_year');

        // ดึงรายการหน่วยงาน
        $departments = Department::orderBy('dep_name')->get();

        // เริ่มต้น query
        $query = Contract::with(['department'])
            ->whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0);

        // ค้นหา
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('contract_no', 'like', "%{$search}%")
                    ->orWhere('contract_name', 'like', "%{$search}%")
                    ->orWhere('partners', 'like', "%{$search}%");
            });
        }

        // กรองตามปี
        if ($request->filled('year')) {
            $query->where('contract_year', $request->year);
        }

        // กรองตามหน่วยงาน
        if ($request->filled('department')) {
            $query->where('dep_id', $request->department);
        }

        // กรองตามชนิดหลักประกัน
        if ($request->filled('type')) {
            $query->where('types_of_guarantee', $request->type);
        }

        // กรองตามเงื่อนไขการคืน
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // กรองตามสถานะการคืนหลักประกัน
        // ต้องใช้ PHP level filtering เนื่องจากต้องคำนวณวันทำการ
        $returnStatusFilter = $request->filled('return_status') ? $request->return_status : null;

        // เรียงลำดับ
        $query->orderBy('contract_year', 'desc')
            ->orderBy('contract_no', 'desc');

        // ถ้ามี filter สถานะการคืน ให้ดึงข้อมูลทั้งหมดมาก่อนแล้ว filter ที่ PHP
        if ($returnStatusFilter) {
            $allGuarantees = $query
                ->where('condition', '!=', 2)
                ->whereNotNull('duration')
                ->whereNotNull('contract_date')
                ->get(); // ดึงเฉพาะที่ต้องคืนและมีข้อมูลครบ

            $today = now();
            $filtered = $allGuarantees->filter(function ($contract) use ($returnStatusFilter, $today) {
                try {
                    $baseDateCarbon = \Carbon\Carbon::parse($contract->contract_date);
                    $returnDate = \App\Helpers\BusinessDayCalculator::addBusinessYears($baseDateCarbon, $contract->duration);
                    $daysUntilReturn = $today->diffInDays($returnDate, false);

                    switch ($returnStatusFilter) {
                        case 'overdue':
                            return $daysUntilReturn < 0;
                        case 'due_soon':
                            return $daysUntilReturn >= 0 && $daysUntilReturn <= 90;
                        case 'active':
                            return $daysUntilReturn > 90;
                        default:
                            return true;
                    }
                } catch (\Exception $e) {
                    return false;
                }
            });

            // Manual pagination
            $page = $request->get('page', 1);
            $perPage = 20;
            $total = $filtered->count();
            $guarantees = new \Illuminate\Pagination\LengthAwarePaginator(
                $filtered->forPage($page, $perPage),
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            // Paginate ปกติถ้าไม่มี filter สถานะการคืน
            $guarantees = $query->paginate(20)->appends($request->all());
        }

        // คำนวณสถิติ (ใช้ raw SQL เพื่อความเร็ว)
        $totalAmount = Contract::whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0)
            ->sum('guarantee_amount');

        $totalCount = Contract::whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0)
            ->count();

        // สถิติตามสถานะการคืน (ใช้วันทำการ) - ดึงเฉพาะที่จำเป็น
        $today = now();
        $allGuaranteesForStats = Contract::select('contract_date', 'duration')
            ->whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0)
            ->where('condition', '!=', 2) // นับทุกสัญญาที่ไม่ใช่ "ไม่ต้องคืน"
            ->whereNotNull('duration')
            ->whereNotNull('contract_date')
            ->get();

        $overdueCount = 0;
        $dueSoonCount = 0;

        foreach ($allGuaranteesForStats as $contract) {
            try {
                $baseDateCarbon = \Carbon\Carbon::parse($contract->contract_date);
                $returnDate = \App\Helpers\BusinessDayCalculator::addBusinessYears($baseDateCarbon, $contract->duration);
                $daysUntilReturn = $today->diffInDays($returnDate, false);

                if ($daysUntilReturn < 0) {
                    $overdueCount++;
                } elseif ($daysUntilReturn <= 90) {
                    $dueSoonCount++;
                }
            } catch (\Exception $e) {
                // Skip if error in calculation
                continue;
            }
        }

        return view('guarantee.index', compact(
            'guarantees',
            'years',
            'departments',
            'totalAmount',
            'totalCount',
            'overdueCount',
            'dueSoonCount'
        ));
    }

    /**
     * ปรับสถานะเป็นคืนเงินหลักประกันแล้ว
     */
    public function markAsReturned(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $contract->update([
            'is_returned' => true,
            'returned_date' => $request->returned_date ?? now()->format('Y-m-d'),
            'returned_note' => $request->returned_note,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'อัปเดตสถานะการคืนเงินหลักประกันสำเร็จ',
        ]);
    }

    /**
     * ยกเลิกสถานะการคืน
     */
    public function unmarkAsReturned($id)
    {
        $contract = Contract::findOrFail($id);

        $contract->update([
            'is_returned' => false,
            'returned_date' => null,
            'returned_note' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'ยกเลิกสถานะการคืนเงินหลักประกันสำเร็จ',
        ]);
    }
}
