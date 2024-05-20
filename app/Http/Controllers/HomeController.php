<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contract;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $department = Auth::user()->department;
        $left_pos = strripos($department, '(') + 1;
        $department = substr($department, $left_pos, strlen($department));
        $department = trim($department, ')');
        $dep_id = Department::select('id')->where('dep_name', 'like', $department)->get();

        if (Auth::user()->role === 0) {
            $contracts = Contract::where('dep_id', $dep_id[0]->id)->get();
            $contracts_1 = Contract::where('dep_id', $dep_id[0]->id)->where('contract_type', 1)->get();
            $contracts_2 = Contract::where('dep_id', $dep_id[0]->id)->where('contract_type', 2)->get();
            $contracts_3 = Contract::where('dep_id', $dep_id[0]->id)->where('contract_type', 3)->get();
            $contracts_4 = Contract::where('dep_id', $dep_id[0]->id)->where('contract_type', 4)->get();
            $contracts_5 = Contract::where('dep_id', $dep_id[0]->id)->where('contract_type', 5)->get();
        } else {
            $contracts = Contract::all();
            $contracts_1 = Contract::where('contract_type', 1)->get();
            $contracts_2 = Contract::where('contract_type', 2)->get();
            $contracts_3 = Contract::where('contract_type', 3)->get();
            $contracts_4 = Contract::where('contract_type', 4)->get();
            $contracts_5 = Contract::where('contract_type', 5)->get();
        }

        $users = User::all();

        return view('home', compact('users', 'contracts', 'contracts_1', 'contracts_2', 'contracts_3', 'contracts_4', 'contracts_5'));
    }
}
