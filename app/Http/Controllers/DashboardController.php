<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\CareSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $plants = Plant::where('user_id', $user->id)->get();
        
        // Jadwal perawatan hari ini
        $todaySchedules = CareSchedule::whereHas('plant', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereDate('next_date', today())->get();

        // Jadwal perawatan mendatang
        $upcomingSchedules = CareSchedule::whereHas('plant', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereDate('next_date', '>', today())
          ->orderBy('next_date')
          ->take(5)
          ->get();

        return view('dashboard', compact('plants', 'todaySchedules', 'upcomingSchedules'));
    }
}