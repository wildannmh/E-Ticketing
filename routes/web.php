<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => view('admin.dashboard'),
        'organizer' => view('welcome'),
        'user' => view('welcome'),
        default => abort(403),
    };
})->name('');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});


Route::resource('events', EventController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::post('/events/{event}/favorite', [EventController::class, 'favorite'])->name('events.favorite');
Route::post('/events/{event}/unfavorite', [EventController::class, 'unfavorite'])->name('events.unfavorite');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');


Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});


Route::get('/organizers/{organizer}', [OrganizerController::class, 'show'])->name('organizers.show');


Route::middleware(['auth', 'is_organizer'])->group(function () {
    Route::resource('events', EventController::class)->except(['index', 'show']);
});