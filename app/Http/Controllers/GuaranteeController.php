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

        // เรียงลำดับ
        $query->orderBy('contract_year', 'desc')
            ->orderBy('contract_no', 'desc');

        // Paginate
        $guarantees = $query->paginate(20)->appends($request->all());

        // คำนวณสถิติ
        $totalAmount = Contract::whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0)
            ->sum('guarantee_amount');

        $totalCount = Contract::whereNotNull('types_of_guarantee')
            ->where('types_of_guarantee', '>', 0)
            ->count();

        return view('guarantee.index', compact(
            'guarantees',
            'years',
            'departments',
            'totalAmount',
            'totalCount'
        ));
    }
}
