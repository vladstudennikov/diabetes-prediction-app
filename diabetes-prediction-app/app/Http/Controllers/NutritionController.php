<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionData;
use Illuminate\Support\Facades\Auth;

class NutritionController extends Controller
{
    // Store a new meal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'meal_name' => 'required|string|max:255',
            'dish_name' => 'required|string|in:Сніданок,Обід,Вечеря,Перекус',
        ]);

        $meal = NutritionData::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'meal_name' => $validated['meal_name'],
            'dish_name' => $validated['dish_name'],
        ]);

        return response()->json(['message' => 'Успішно додано!', 'meal' => $meal]);
    }

    // Get meals by date
    public function index(Request $request)
    {
        $date = $request->query('date');

        $meals = NutritionData::where('user_id', Auth::id())
            ->when($date, fn($q) => $q->where('date', $date))
            ->get();

        return response()->json($meals);
    }
}
