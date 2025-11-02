<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::where('user_id', Auth::id())->get();
        return view('plants.index', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('plants', 'public');
        }

        Plant::create($data);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
          if ($plant->user_id !== Auth::id()) {
            abort(403);
        }

        $careLogs = $plant->careLogs()->orderBy('date', 'desc')->get();
        return view('plants.show', compact('plant', 'careLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
         if ($plant->user_id !== Auth::id()) {
            abort(403);
        }

        return view('plants.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
         if ($plant->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($plant->photo) {
                Storage::disk('public')->delete($plant->photo);
            }
            $data['photo'] = $request->file('photo')->store('plants', 'public');
        }

        $plant->update($data);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
         if ($plant->user_id !== Auth::id()) {
            abort(403);
        }

        if ($plant->photo) {
            Storage::disk('public')->delete($plant->photo);
        }

        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil dihapus!');
    }
}
