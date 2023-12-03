<?php

use App\Http\Controllers\CronJobController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchedulerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect(route("dashboard"));
});

Route::get('/dashboard', function () {
    return Inertia::render('dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('schedulers', SchedulerController::class);
    Route::get('/all-schedulers', [SchedulerController::class,'getSchedulers'])->name("all-schedulers");
    Route::get('/timezones', [SchedulerController::class, 'getTimezones'])->name("timezones");
    Route::get('/cron-jobs', [SchedulerController::class, 'getCronJobs'])->name("cron-jobs");

    Route::resource('frequencies',FrequencyController::class);
    Route::get("frequencies", [FrequencyController::class, 'getFrequencies'])->name("frequencies");
});



require __DIR__ . '/auth.php';
