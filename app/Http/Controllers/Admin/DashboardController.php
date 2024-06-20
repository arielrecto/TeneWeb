<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\PreRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function dashboard(){

        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;

        $unverifiedTenants = PreRegister::where('tenement_id', $tenement->id)->paginate(10);

        $totalTenant = Tenant::totalActive($tenement->id);

        return view('user.admin.dashboard', compact(['unverifiedTenants', 'totalTenant']));
    }
}
