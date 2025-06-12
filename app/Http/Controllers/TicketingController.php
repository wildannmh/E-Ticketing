<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketingController extends Controller
{
    public function showCheckoutForm(Request $request, Event $event, Ticket $ticket)
    {
        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('events.index'), 'text' => 'Cari Event'],
            ['url' => route('events.show', $event), 'text' => $event->title],
            ['text' => 'Checkout']
        ];

        $quantity = (int) $request->input('quantity', 1);

        if ($ticket->event_id !== $event->id) {
            abort(404, 'Tiket tidak valid untuk acara ini.');
        }

        if ($ticket->remaining < $quantity) {
            return back()->withErrors(['Jumlah tiket melebihi stok yang tersedia.']);
        }

        return view('ticketing.checkout', compact('event', 'ticket', 'breadcrumbs', 'quantity'));
    }

    public function processCheckout(Request $request, Event $event, Ticket $ticket)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$ticket->remaining,
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date'
        ]);

        // Buat transaksi
        $transaction = Transaction::create([
            'order_number' => 'MOEKET-' . Str::upper(Str::random(8)),
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'quantity' => $validated['quantity'],
            'total_price' => $ticket->price * $validated['quantity'],
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'status' => 'pending'
        ]);

        // Kurangi stok tiket
        $ticket->decrement('remaining', $validated['quantity']);

        return redirect()->route('ticketing.payment', $transaction);
    }

    public function showPaymentForm(Transaction $transaction)
    {
        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('events.index'), 'text' => 'Cari Event'],
            ['url' => route('events.show', $transaction->event), 'text' => $transaction->event->title],
            ['url' => route('ticketing.checkout', [$transaction->event, $transaction->ticket]), 'text' => 'Checkout'],
            ['text' => 'Pembayaran']
        ];

        $banks = [
            [
                'name' => 'BNI',
                'account_number' => '9999999999',
                'account_name' => 'Amang Yayan'
            ],
            [
                'name' => 'BCA',
                'account_number' => '8888888888',
                'account_name' => 'Amang Yayan'
            ],
            [
                'name' => 'Mandiri',
                'account_number' => '7777777777',
                'account_name' => 'Amang Yayan'
            ]
        ];

        return view('ticketing.payment', compact('transaction', 'breadcrumbs', 'banks'));
    }

    public function processPayment(Request $request, Transaction $transaction)
    {
        $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'proof_image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        // Simpan bukti transfer
        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('payment_proofs', 'public');
        } else {
            return back()->withErrors(['proof_image' => 'Bukti transfer tidak ditemukan.']);
        }

        // Simpan ke tabel payments
        Payment::create([
            'transaction_id' => $transaction->id,
            'bank_account_id' => $request->bank_account_id,
            'proof_image' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('ticketing.complete', $transaction->id)
                        ->with('success', 'Pembayaran berhasil dikirim! Mohon tunggu konfirmasi.');
    }




    public function showCompletePage(Transaction $transaction)
    {
        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('events.index'), 'text' => 'Cari Event'],
            ['url' => route('events.show', $transaction->event), 'text' => $transaction->event->title],
            ['url' => route('ticketing.checkout', [$transaction->event, $transaction->ticket]), 'text' => 'Checkout'],
            ['url' => route('ticketing.payment', $transaction), 'text' => 'Pembayaran'],
            ['text' => 'Selesai']
        ];

        return view('ticketing.complete', compact('transaction', 'breadcrumbs'));
    }
}