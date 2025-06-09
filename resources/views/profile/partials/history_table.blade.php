<table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-light fw-semibold">
        <tr>
            <th scope="col">Order Date</th>
            <th scope="col">Number</th>
            <th scope="col">Kategori</th>
            <th scope="col">Event</th>
            <th scope="col">Status</th>
            <th scope="col">Total Price</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                <td>{{ $transaction->order_number }}</td>
                <td>{{ $transaction->event->category }}</td>
                <td>{{ $transaction->event->title }}</td>
                <td>{!! $transaction->status_badge !!}</td>
                <td>{{ $transaction->formatted_total_price }}</td>
                <td><a href="{{ route('profile.history.show', $transaction) }}" class="text-primary">Detail</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada riwayat pembelian</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $transactions->links() }}
</div>