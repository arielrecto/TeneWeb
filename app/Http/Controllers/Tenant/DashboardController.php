<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $authUser = Auth::user();

        $tenement = $authUser->tenant->room->tenement;
        $room = $authUser->tenant->room;


        $totalUnpaidBills = $authUser->tenant->totalUnpaidBills();

        $announcements = Announcement::where('tenement_id', $tenement->id)->latest()->get();



        return view('user.tenant.dashboard', compact(['tenement', 'room', 'totalUnpaidBills', 'announcements']));
    }
}
