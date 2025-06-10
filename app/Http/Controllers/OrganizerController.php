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
    public function show($id, Event $event)
    {
        $organizer = Organizer::with(['user', 'events' => function($query) {
            $query->where('is_published', true);
        }])->findOrFail($id);

        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('events.index'), 'text' => 'Event'],
            ['text' => $organizer->name]
        ];

        $price = $event->tickets->min('price') ?? 0;

        // Pisahkan event tersedia dan terpublikasi
        $availableEvents = $organizer->events->where('start_date', '>', now());
        $publishedEvents = $organizer->events->where('start_date', '<=', now());

        return view('organizer.show', compact('organizer', 'breadcrumbs', 'price', 'availableEvents', 'publishedEvents'));
    }

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