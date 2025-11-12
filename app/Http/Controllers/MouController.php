<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MouController extends Controller
{
    /**
     * Display a listing of MOU announcements.
     */
    public function index(Request $request)
    {
        // Assumption: table name is 'announce'. If different, set MOU_TABLE in .env
        $table = env('MOU_TABLE', 'announce');
        $departmentTable = env('MOU_DEPARTMENT_TABLE', 'department');
        $typeTable = env('MOU_TYPE_TABLE', 'type');
        $soonDays = (int) env('MOU_EXP_SOON_DAYS', 60);

        // Year filter options (distinct years available)
        $years = DB::connection('mysql2')
            ->table($table)
            ->distinct()
            ->orderBy('ann_year')
            ->pluck('ann_year');

        // Type filter options
        $types = DB::connection('mysql2')
            ->table($typeTable)
            ->select('type_id', 'type_name')
            ->orderBy('type_name')
            ->get();

        $query = DB::connection('mysql2')
            ->table($table . ' as a')
            ->leftJoin($departmentTable . ' as d', 'd.dep_id', '=', 'a.ann_dep')
            ->leftJoin($typeTable . ' as t', 't.type_id', '=', 'a.ann_type')
            ->select([
                'a.ann_no',
                'a.ann_year',
                'a.ann_item',
                'a.ann_date',
                'a.ann_exp',
                'a.ann_dep',
                'a.ann_type',
                DB::raw('d.dep_name as dep_name'),
                DB::raw('t.type_name as type_name'),
            ])
            ->orderBy('a.ann_year')
            ->orderBy('a.ann_no');

        // Optional simple search by keyword or item
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('a.ann_item', 'like', "%{$search}%")
                  ->orWhere('a.ann_keyword', 'like', "%{$search}%")
                  ->orWhere('d.dep_name', 'like', "%{$search}%");
            });
        }

        // Optional year filter
        if ($year = $request->input('year')) {
            $query->where('a.ann_year', $year);
        }

        // Optional type filter
        if ($type = $request->input('type')) {
            $query->where('a.ann_type', $type);
        }

        // Optional status filter: active (not expired), soon (expiring within N days), expired, no_limit
        if ($status = $request->input('status')) {
            $today = Carbon::now('Asia/Bangkok')->startOfDay();
            $soonUntil = $today->copy()->addDays($soonDays)->endOfDay();

            // Exclude records with null or '0000-00-00' dates from status filters
            if ($status === 'expired') {
                $query->where('a.ann_exp', '<', $today)
                      ->where('a.ann_exp', '!=', '0000-00-00')
                      ->whereNotNull('a.ann_exp');
            } elseif ($status === 'soon') {
                $query->where('a.ann_exp', '>=', $today)
                      ->where('a.ann_exp', '<=', $soonUntil)
                      ->where('a.ann_exp', '!=', '0000-00-00')
                      ->whereNotNull('a.ann_exp');
            } elseif ($status === 'active') {
                // Active includes both not expired AND no expiration date
                $query->where(function($q) use ($today) {
                    $q->where(function($sq) use ($today) {
                        // Has expiration date and not expired
                        $sq->where('a.ann_exp', '>=', $today)
                           ->where('a.ann_exp', '!=', '0000-00-00')
                           ->whereNotNull('a.ann_exp');
                    })->orWhere(function($sq) {
                        // Or no expiration date (unlimited)
                        $sq->where('a.ann_exp', '=', '0000-00-00')
                           ->orWhereNull('a.ann_exp');
                    });
                });
            } elseif ($status === 'no_limit') {
                // Filter for contracts with no expiration date
                $query->where(function($q) {
                    $q->where('a.ann_exp', '=', '0000-00-00')
                      ->orWhereNull('a.ann_exp');
                });
            }
        }

    // Keep query string on pagination links (compatible across Laravel versions)
        $mous = $query->paginate(20)->appends($request->query());

        return view('mou.index', compact('mous', 'years', 'types'));
    }
}
