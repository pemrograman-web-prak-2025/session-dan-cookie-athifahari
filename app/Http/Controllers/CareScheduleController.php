<?php

namespace App\Http\Controllers;

use App\Models\CareSchedule;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareScheduleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plants = Plant::where('user_id', Auth::id())->get();
        return view('care_schedules.create', compact('plants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'type' => 'required|in:siram,pupuk,potong,semprot_hama',
            'interval_days' => 'required|integer|min:1',
            'next_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Pastikan tanaman milik user
        $plant = Plant::where('id', $request->plant_id)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        CareSchedule::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Jadwal perawatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CareSchedule $careSchedule)
    {
         if ($careSchedule->plant->user_id !== Auth::id()) {
            abort(403);
        }

        $plants = Plant::where('user_id', Auth::id())->get();
        return view('care_schedules.edit', compact('careSchedule', 'plants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CareSchedule $careSchedule)
    {
        if ($careSchedule->plant->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'type' => 'required|in:siram,pupuk,potong,semprot_hama',
            'interval_days' => 'required|integer|min:1',
            'next_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $careSchedule->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Jadwal perawatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CareSchedule $careSchedule)
    {
        if ($careSchedule->plant->user_id !== Auth::id()) {
            abort(403);
        }

        $careSchedule->delete();

        return redirect()->route('dashboard')->with('success', 'Jadwal perawatan berhasil dihapus!');
    }
}
