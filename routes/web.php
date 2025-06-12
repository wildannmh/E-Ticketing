<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\HistoryController;
use App\Http\Controllers\TicketingController;

use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::middleware(['auth'])->get('/dashboard', function () {
//     $role = auth()->user()->role;

//     return match ($role) {
//         'admin' => view('admin.dashboard'),
//         'organizer' => view('organizer.dashboard'),
//         'user' => view('welcome'),
//         default => abort(403),
//     };
// })->name('');

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // GET: Tampilkan halaman keamanan
    Route::get('/profile/security', [ProfileController::class, 'showSecurity'])->name('profile.security');

    // PUT: Proses update password
    Route::put('/profile/security', [ProfileController::class, 'updatePassword'])->name('profile.security.update');

    Route::get('/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/history', [HistoryController::class, 'index'])->name('profile.history');
    Route::get('/history/{transaction}', [HistoryController::class, 'show'])->name('profile.history.show');
});


Route::resource('events', EventController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::post('/events/{event}/favorite', [EventController::class, 'favorite'])->name('events.favorite');
Route::post('/events/{event}/unfavorite', [EventController::class, 'unfavorite'])->name('events.unfavorite');

Route::middleware(['auth'])->group(function () {
    Route::get('/events/{event}/tickets/{ticket}/checkout', [TicketingController::class, 'showCheckoutForm'])->name('ticketing.checkout');
    Route::post('/events/{event}/tickets/{ticket}/checkout', [TicketingController::class, 'processCheckout'])->name('ticketing.process');
    Route::get('/transactions/{transaction}/payment', [TicketingController::class, 'showPaymentForm'])->name('ticketing.payment');
    Route::post('/transactions/{transaction}/payment', [TicketingController::class, 'processPayment'])->name('ticketing.process-payment');
    Route::get('/transactions/{transaction}/complete', [TicketingController::class, 'showCompletePage'])->name('ticketing.complete');
});


Route::get('/organizers', [OrganizerController::class, 'index'])->name('organizers.index');
Route::get('/organizers/{organizer}', [OrganizerController::class, 'show'])->name('organizers.show');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');


Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});


Route::get('/organizers/{organizer}', [OrganizerController::class, 'show'])->name('organizers.show');


Route::middleware(['auth', 'organizer'])->group(function () {
    Route::resource('events', EventController::class)->except(['index', 'show']);
});


// Organizer 
Route::middleware(['auth'])->get('/organizer/register', [OrganizerController::class, 'create'])->name('organizer.create');
Route::middleware(['auth'])->post('/organizer/register', [OrganizerController::class, 'store'])->name('organizer.store');


Route::middleware(['auth', 'organizer'])->get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
