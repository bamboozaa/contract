<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::pluck('dep_name', 'id');

        $currentYearTH = Carbon::now()->year + 543;
        $currentYear = Carbon::now()->year;
        $startDate = $currentYear . '-08-01';
        $endDate = $currentYear + 1 . '-07-31';
        $current_date = Carbon::now();

        if ($current_date >= $startDate) {
            $currentYearTH = $currentYearTH + 1;
        } else if ($current_date <= $startDate) {
            $currentYearTH;
        }

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
        if ($file = $request->file('formFile')) {
            $file_name =time().$file->getClientOriginalName();
            $file->move('uploads', $file_name);
        }

        $contract = Contract::create($request->all());
        $contract->formFile = $file_name;
        $contract->save();

        session()->flash('success', 'Contract created successfully.');
        \Log::info("Contract NO(" . $request->contract_no . "/" . $request->contract_year . ") Create finished by " . Auth::user()->name);

        return redirect()->route('contracts.index');
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
        $departments = Department::pluck('dep_name', 'id');
        return view('contracts.edit', compact('contract', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        if ($request->hasfile('formFile')) {
            $file = $request->file('formFile');
            $file_name =time().$file->getClientOriginalName();
            $fileToDelete = public_path('uploads/' . $contract->formFile);
            is_null($contract->formFile) ? "" : unlink($fileToDelete);
            $file->move('uploads', $file_name);
            $file_name = $contract->formFile;
            $data = ['formFile' => $file_name];
            $contract->update($data);
        }

        $data = [
            'contract_no' => $request->input('contract_no'),
            'contract_year' => $request->input('contract_year'),
            'dep_id' => $request->input('dep_id'),
            'contract_name' => $request->input('contract_name'),
            'partners' => $request->input('partners'),
            'acquisition_value' => $request->input('acquisition_value'),
            'fund' => $request->input('fund'),
            'contract_type' => $request->input('contract_type'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'types_of_guarantee' => $request->input('types_of_guarantee'),
            'guarantee_amount' => $request->input('guarantee_amount'),
            'duration' => $request->input('duration'),
            'condition' => $request->input('condition'),
            'status' => $request->input('status'),
        ];

        $contract->update($data);

        session()->flash('success', 'Contract updated successfully.');
        \Log::info("Contract NO(" . $contract->contract_no . "/" . $contract->contract_year . ") Update finished by " . Auth::user()->name);

        return redirect()->route('contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        if (!is_null($contract->formFile)) {
            $fileToDelete = public_path('uploads/' . $contract->formFile);
            unlink($fileToDelete);
        }

        $contract->delete();

        session()->flash('success', 'Contract deleted successfully.');

        return redirect()->route('contracts.index');
    }
}
