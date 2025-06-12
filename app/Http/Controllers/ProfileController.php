<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('profile.show'), 'text' => 'Account'],
            ['text' => 'Profile']
        ];

        return view('profile.show', compact('user', 'breadcrumbs'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function security()
    {
        $user = Auth::user();

        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('profile.show'), 'text' => 'Account'],
            ['text' => 'Security']
        ];

        return view('profile.security', compact('user', 'breadcrumbs'));
    }

    public function wishlist()
    {
        $user = Auth::user();

        $events = $user->favorites()->with('tickets')->get();

        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('profile.show'), 'text' => 'Account'],
            ['text' => 'Wishlist']
        ];

        return view('profile.wishlist', compact('user', 'breadcrumbs', 'events'));
    }

    public function update(Request $request)
{
    $user = Auth::user();
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);
    
    // Update data user
    $user->update($validated);
    
    // Handle file upload
    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile-photos');
        $user->profile_photo = $path;
        $user->save();
    }
    
    return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
}
    // public function history()
    // {
    //     $user = Auth::user();

    //     $breadcrumbs = [
    //         ['url' => route('home'), 'text' => 'Home'],
    //         ['url' => route('profile.show'), 'text' => 'Profile'],
    //         ['text' => 'Riwayat Pembelian']
    //     ];

    //     return view('profile.history', compact('user', 'breadcrumbs'));
    // }
}
