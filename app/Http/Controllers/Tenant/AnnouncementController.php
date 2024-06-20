<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index(){
        $tenement = Auth::user()->tenant->room->tenement;


        $announcements = Announcement::where('tenement_id', $tenement->id)->latest()->paginate(10);


        return view('user.tenant.announcement.index', compact(['announcements']));
    }


    public function show(string $id){
        $announcement = Announcement::find($id);

        return view('user.tenant.announcement.show', compact(['announcement']));
    }
}
