<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment; // Add this line

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['url' => route('home'), 'text' => 'Home'],
            ['url' => route('profile.show'), 'text' => 'Account'],
            ['text' => 'Riwayat Pembelian']
        ];

        $transactions = Transaction::with(['event', 'ticket', 'payment']) // Add payment relationship
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('profile.partials.history_table', compact('transactions'));
        }

        return view('profile.history', compact('breadcrumbs', 'transactions'));
    }

    public function show(Transaction $transaction)
    {
        // Pastikan transaksi milik user yang login
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Load payment information
        $payment = $transaction->payment;

        return view('profile.history_detail', [
            'transaction' => $transaction,
            'payment' => $payment
        ]);
    }
}