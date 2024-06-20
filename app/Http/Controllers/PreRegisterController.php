<?php

namespace App\Http\Controllers;

use App\Enums\GeneralStatus;
use App\Models\Room;
use App\Models\User;
use App\Enums\UserRoles;
use App\Models\Tenement;
use App\Models\PreRegister;
use App\Models\AdminProfile;
use App\Notifications\PreRegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreRegisterController extends Controller
{
    public function create()
    {
        $tenements = Tenement::get();
        return view('pre-register.create', compact(['tenements']));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tenant_type' => 'required',
            'room_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'contact_no' => 'required',
            'document' => 'required',
            'tenement' => 'required'
        ]);



        $documentName = 'DCMNT-' . uniqid() . '.' . $request->document->extension();
        $docDir = $request->document->storeAs('/document', $documentName, 'public');

        $tenement = Tenement::find($request->tenement);

        $preRegister =  PreRegister::create([
            'name' => $request->name,
            'email' => $request->email,
            'tenant_type' => $request->tenant_type,
            'room_number' => $request->room_number,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'document' => asset('/storage/' . $docDir),
            'gender' => $request->gender,
            'tenement_id' => $tenement->id
        ]);


        if ($request->hasFile('image')) {

            $imageName = 'DCMNT-' . uniqid() . '.' . $request->image->extension();
            $dir = $request->image->storeAs('/profile', $imageName, 'public');

            $preRegister->update([
                'image' => asset('/storage/' . $dir),
            ]);
        }


        $admin = $tenement->adminProfile->user ?? null;

        if(!$admin){
            $admin = User::role(UserRoles::SUPERADMIN->value)->first();
        }

        $message = [
            'message' => "New Pre Register Tenant in Tenement: {$tenement->name}, Room : {$request->room_number}"
        ];

        $admin->notify(new PreRegisterNotification($message));


        return back()->with(['message' => 'Pre Register Sent Admin Will Sent Email for the Verification']);
    }
    public function getRooms(string $id)
    {


        $rooms = Room::where(function ($q) use ($id) {
            $q->where('tenement_id', $id)
            ->where('status', GeneralStatus::VACANT->value);
        })->get();

        return response([
            'rooms' => $rooms
        ], 200);
    }
}
