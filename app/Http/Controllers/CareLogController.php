<?php

namespace App\Http\Controllers;

use App\Models\CareLog;
use App\Models\Plant;
use App\Models\CareSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CareLogController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $plantId = $request->get('plant_id');
        $plants = Plant::where('user_id', Auth::id())->get();
        
        return view('care_logs.create', compact('plants', 'plantId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'action_type' => 'required|in:siram,pupuk,potong,semprot_hama',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Pastikan tanaman milik user
        $plant = Plant::where('id', $request->plant_id)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        CareLog::create($request->all());

        // Update next_date pada jadwal terkait
        $schedule = CareSchedule::where('plant_id', $request->plant_id)
                               ->where('type', $request->action_type)
                               ->first();

        if ($schedule) {
            $nextDate = Carbon::parse($request->date)->addDays($schedule->interval_days);
            $schedule->update(['next_date' => $nextDate]);
        }

        return redirect()->route('plants.show', $request->plant_id)->with('success', 'Catatan perawatan berhasil ditambahkan!');
    }
}
