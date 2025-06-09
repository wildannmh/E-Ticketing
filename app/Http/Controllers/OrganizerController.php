<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizerRequest;
use App\Models\Organizer;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function create()
    {
        // Pastikan user belum menjadi organizer
        if (Auth::user()->organizer) {
            return redirect()->route('organizer.dashboard');
        }

        return view('organizer.create');
    }

    public function store(OrganizerRequest $request)
    {
        // Validasi sudah dilakukan di OrganizerRequest
        $data = $request->validated();
        
        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('organizer_logos', 'public');
        }

        // Buat organizer dan hubungkan dengan user
        $organizer = Auth::user()->organizer()->create($data);

        // Update role user menjadi organizer
        Auth::user()->update(['role' => 'organizer']);

        return redirect()->route('organizer.dashboard')
            ->with('success', 'Profil organizer berhasil dibuat!');
    }

    public function dashboard()
    {
        $organizer = auth()->user();

        $events = $organizer->events()->with('tickets')->latest()->get();
        $totalEvents = $events->count();
        $totalTickets = $events->flatMap->tickets->sum('quantity');
        $ticketsSold = $events->flatMap->tickets->sum(function ($ticket) {
            return $ticket->quantity - $ticket->remaining;
        });

        return view('organizer.dashboard', compact('events', 'totalEvents', 'totalTickets', 'ticketsSold'));
    }

}