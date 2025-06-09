<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // Cek ketersediaan tiket
        if ($ticket->remaining < $request->quantity) {
            return back()->with('error', 'Jumlah tiket yang tersedia tidak mencukupi');
        }

        // Buat booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
            'total_price' => $ticket->price * $request->quantity,
            'status' => 'pending'
        ]);

        // Kurangi stok tiket
        $ticket->decrement('remaining', $request->quantity);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Pemesanan berhasil dibuat');
    }
}