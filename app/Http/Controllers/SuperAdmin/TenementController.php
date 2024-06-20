<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenement;
use Illuminate\Http\Request;

class TenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenements = Tenement::latest()->paginate(10);


        return view('user.super-admin.tenement.index', compact(['tenements']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.super-admin.tenement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);



        $imageName = 'TNMNTS-' . uniqid() . '.' . $request->image->extension();
        $dir = $request->image->storeAs('/tenements', $imageName, 'public');


        Tenement::create([
            'name' => $request->name,
            'image' => asset('/storage/' . $dir),
            'description' => $request->description
        ]);



        return back()->with([
            'message' => 'Tenement Added'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenement = Tenement::find($id);


        return view('user.super-admin.tenement.show', compact(['tenement']));
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
        //
    }
}
