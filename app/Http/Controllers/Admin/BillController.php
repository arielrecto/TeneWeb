<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Tenant;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $tenant = User::find($request->tenant);

        return view('user.admin.tenant.bill.create', compact(['tenant']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'type' => 'required'
        ]);

        $tenant = Tenant::find($request->tenant);

        Bill::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'type' => $request->type,
            'tenant_id' => $tenant->id,
            'room_id' => $tenant->room->id
        ]);



        return back()->with(['message' => "Bill {$request->type} added"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bill = Bill::find($id);


        return view('user.admin.bill.edit', compact(['bill']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bill::find($id);



        $bill->update([
            'name' => $request->name ?? $bill,
            'amount' => $request->amount ?? $bill->amount,
            'type' => $request->type ?? $bill->type
        ]);


        return back()->with(['message' => "Bill {$bill->name} Data Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);

        $bill->delete();


        return back()->with(['message' => 'Bill Deleted Success']);
    }
}
