<?php

namespace App\Http\Controllers;

use App\Models\Location;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $locations = Location::query();

    if ($request->q) {
        $locations->where('nama_kota', 'like', '%' . $request->q . '%');
    }

    $locations = $locations->get();

    return view('location.index', compact('locations'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kota' =>'required',
            'alamat' =>'required',
            'ling' => 'nullable',
        ]);

        Location::create([
            'nama_kota' => $request->nama_kota,
            'alamat' => $request->alamat,
            'ling' => $request->ling,
        ]);

        return redirect()->route('location.index')
                        ->with('success', 'Lokasi Berhasil ditambahkan');
    } 

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Location $location)
{
    $request->validate([
        'nama_kota' => 'required',
        'alamat' => 'required',
        'ling' => 'nullable',
    ]);

    $location->update([
        'nama_kota' => $request->nama_kota,
        'alamat' => $request->alamat,
        'ling' => $request->ling,
    ]);

    return redirect()->route('location.index')
        ->with('success', 'Lokasi berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
{
    $location->delete();

    return redirect()->route('location.index')
        ->with('success', 'Lokasi berhasil dihapus');
}
}
