<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhysActivityData;
use Illuminate\Support\Facades\Auth;

class PhysActivityController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'activity_name' => 'required|string|max:255',
        ]);

        $activity = PhysActivityData::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'duration' => $validated['duration'],
            'activity_name' => $validated['activity_name'],
        ]);

        return response()->json(['message' => 'Успішно збережено!', 'activity' => $activity]);
    }

    public function index(Request $request)
    {
        $date = $request->query('date');
        $activities = PhysActivityData::where('user_id', Auth::id())
            ->when($date, fn($q) => $q->where('date', $date))
            ->get();

        return response()->json($activities);
    }
}
