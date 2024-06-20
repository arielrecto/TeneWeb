<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;

        $query = Room::where('tenement_id', $tenement->id);


        $rooms = $query->paginate(10);

        $roomTotal = $query->count();

        $occupiedRoomTotal = $query->whereHas('tenants', function ($q) {
            $q->whereNull('move_out_date');
        })->count();


        $vacantRoomTotal = $query->whereHas('tenants', function ($q) {
            $q->whereNotNull('move_out_date');
        })->count();


        return view('user.admin.room.index', compact(['rooms', 'roomTotal', 'occupiedRoomTotal', 'vacantRoomTotal']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'descriptions' => 'required',
            'price' => 'required'
        ]);


        $tenement = Auth::user()->adminProfile->tenement;


        Room::create([
            'room_number' => $request->room_number,
            'description' => $request->descriptions,
            'rate' => $request->price,
            'tenement_id' => $tenement->id
        ]);


        return back()->with(['message' => "Room Added Success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $room = Room::find($id);

        return view('user.admin.room.show', compact(['room']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::find($id);


        return view('user.admin.room.edit', compact(['room']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::find($id);



        $room->update([
            'room_number' => $request->room_number,
            'description' => $request->descriptions,
            'rate' => $request->price,
        ]);



        return back()->with(['message' => "{$room->room_number} data Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);

        $room->delete();


        return back()->with(['message' => 'Room Deleted']);
    }
}
