<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Event::with(['organizer', 'tickets', 'favoritedBy'])
            ->where('is_published', true);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($category) {
            $query->where('category', $category);
        }

        $events = $query->latest()->paginate(8)->withQueryString();

        $categories = Event::where('is_published', true)
            ->select('category')
            ->distinct()
            ->pluck('category');

        $breadcrumbs = [
            ['url' => url('/'), 'text' => 'Home'],
            ['text' => 'Cari Event']
        ];

        return view('events.index', compact('events', 'categories', 'search', 'category', 'breadcrumbs'));
    }


    public function show(Event $event)
    {
        if (!$event->is_published) {
            abort(404);
        }

        $event->load('organizer', 'tickets');

        $breadcrumbs = [
            ['url' => url('/'), 'text' => 'Home'],
            ['url' => route('events.index'), 'text' => 'Cari Event'],
            ['text' => $event->title]
        ];

        return view('events.show', compact('event', 'breadcrumbs'));
    }

    public function create()
    {
        // Pastikan user adalah organizer dan sudah memiliki profil organizer
        if (!auth()->user()->organizer) {
            return redirect()->route('organizer.create')
                ->with('warning', 'Anda perlu melengkapi profil organizer terlebih dahulu');
        }

        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'location_link' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'policies' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        // Otomatis set organizer_id dari user yang login
        $validated['organizer_id'] = auth()->user()->organizer->id;

        // Upload banner
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('event_banners', 'public');
        }

        $event = Event::create($validated);

        return redirect()->route('events.index', $event)->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'organizer_id' => 'required|exists:organizers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'location_link' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'policies' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('event_banners', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    public function favorite(Event $event)
    {
        $user = auth()->user();
        if (!$user->favorites->contains($event->id)) {
            $user->favorites()->attach($event->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event added to favorites'
        ]);
    }

    public function unfavorite(Event $event)
    {
        $user = auth()->user();
        if ($user->favorites->contains($event->id)) {
            $user->favorites()->detach($event->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event removed from favorites'
        ]);
    }

}