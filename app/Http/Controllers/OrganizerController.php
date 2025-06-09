<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizerRequest;
use App\Models\Organizer;
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
        $events = Auth::user()->organizer->events()->latest()->paginate(10);
        return view('organizer.dashboard', compact('events'));
    }
}