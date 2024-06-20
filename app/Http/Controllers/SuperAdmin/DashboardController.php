<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Tenement;

class DashboardController extends Controller
{
    public function dashboard() {


        $tenantTotal = Tenant::whereNotNull('move_out_date')->count();


        $tenementTotal = Tenement::count();



        return view('user.super-admin.dashboard', compact(['tenantTotal', 'tenementTotal']));
    }
}
