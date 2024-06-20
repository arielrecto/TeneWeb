<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);

        return view('user.admin.announcement.index', compact(['announcements']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'descriptions' => 'required'
        ]);

        $tenement = Auth::user()->adminProfile->tenement;


        Announcement::create([
            'title' => $request->title,
            'description' => $request->descriptions,
            'tenement_id' => $tenement->id
        ]);


        return back()->with([
            'message' => 'Announcements Posted!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announcement = Announcement::find($id);


        return view('user.admin.announcement.show', compact(['announcement']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::find($id);

        return view('user.admin.announcement.edit', compact(['announcement']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::find($id);



        $announcement->update([
            'title' => $request->title ?? $announcement->title,
            'description' => $request->descriptions
        ]);


        return back()->with([
            'message' => 'Announcement Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::find($id);


        $announcement->delete();


        return back()->with(['message' => 'Announcement Delete']);
    }
}
