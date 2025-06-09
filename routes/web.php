<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/event-detail', function () {
    return view('event-detail');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Auth::routes();

Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => view('admin.dashboard'),
        'organizer' => view('organizer.dashboard'),
        'user' => view('user.dashboard'),
        default => abort(403),
    };
})->name('dashboard');
