<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Terbaru
        $latestEvents = Event::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Terdekat
        $upcomingEvents = Event::where('is_published', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(10)
            ->get();

        // Paling sering dibeli (butuh relasi penjualan/tiket)
        $popularEvents = Event::where('is_published', true)
            ->withCount('tickets') // pastikan ada relasi tickets()
            ->orderBy('tickets_count', 'desc')
            ->take(10)
            ->get();

        return view('welcome', compact('latestEvents', 'upcomingEvents', 'popularEvents'));
    }
}
