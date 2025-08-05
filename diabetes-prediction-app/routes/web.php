<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DiabetesTestController;
use App\Http\Controllers\PhysActivityController;
use App\Http\Controllers\NutritionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('MainPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/diabetes-test', function () {
    return Inertia::render('TestMainPage');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/nutrition', function () {
    return Inertia::render('Nutrition');
})->middleware(['auth', 'verified'])->name('nutrition');

Route::get('/dashboard/phys-activity', function () {
    return Inertia::render('PhysActivity');
})->middleware(['auth', 'verified'])->name('phys-activity');

Route::get('/diabetes-test/start', function () {
    return Inertia::render('QuestionPage');
});

Route::post('/diabetes-test/results', [DiabetesTestController::class, 'writeResultsToSession']);

Route::get('/diabetes-test/results/show', [DiabetesTestController::class, 'showResults']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/phys-activities', [PhysActivityController::class, 'store']);
    Route::get('/phys-activities', [PhysActivityController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/nutrition', [NutritionController::class, 'index']);
    Route::post('/nutrition', [NutritionController::class, 'store']);
});

require __DIR__.'/auth.php';
