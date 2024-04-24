<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Department;
use Carbon\Carbon;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::pluck('dep_name', 'id');
        $currentYearTH = Carbon::now()->year + 543;

        $exists = Contract::where('contract_year', $currentYearTH)->exists();

        $contract_query = Contract::select('contract_no', 'contract_year')->orderBy('contract_year', 'DESC')->orderBy('contract_no', 'DESC') ->first();

        if ($exists) {
            $contract_no = $contract_query->contract_no + 1;
        } else {
            $contract_no = 1;
        }

        return view('contracts.create', compact('departments', 'currentYearTH', 'contract_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
