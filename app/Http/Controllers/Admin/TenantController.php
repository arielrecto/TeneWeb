<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\PreRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $authUser = Auth::user();
        $tenement =  $authUser->adminProfile->tenement;

        $tenants = User::role(UserRoles::TENANT->value)->where(function($q) use($tenement) {
            $q->whereHas('tenant', function($q) use($tenement) {
                $q->whereHas('room', function($q) use($tenement) {
                    $q->where('tenement_id', $tenement->id);
                });
            });
        })->latest()->paginate(10);


        $unverifiedTenantTotal = PreRegister::where('tenement_id', $tenement->id)->count();




        return view('user.admin.tenant.index', compact(['tenants', 'unverifiedTenantTotal']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $tenant = User::find($id);

        return view('user.admin.tenant.show', compact(['tenant']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenant = User::find($id);


        $tenant->delete();


        return back()->with(['message' => 'Tenant Deleted']);
    }
}
