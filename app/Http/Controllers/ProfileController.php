<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
