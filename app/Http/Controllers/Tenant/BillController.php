<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index(){

        $authUser = Auth::user();


        $bills = $authUser->tenant->bills()->where('status', GeneralStatus::UNPAID->value)->latest()->paginate(10);


        return view('user.tenant.bill.index', compact(['bills']));
    }

    public function show(string $id){

        $bill = Bill::find($id);


        return view('user.tenant.bill.show', compact(['bill']));
    }
}
