@extends('admin.master')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Orders</h1>
    <p><strong>Total Orders:</strong> {{ $orders->total() }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                @php
                $columns = [
                'id' => 'ID',
                'user' => 'User',
                'total' => 'Total (₹)',
                'status' => 'Status',
                'coupon' => 'Coupon',
                'created_at' => 'Created'
                ];
                @endphp

                @foreach ($columns as $key => $label)
                <th>
                    @if (in_array($key, ['id', 'total', 'status', 'created_at']))
                    <a href="{{ route('admin.orders.index', ['sort' => $key, 'direction' => ($sort === $key && $direction === 'asc') ? 'desc' : 'asc']) }}">
                        {{ $label }}
                        @if ($sort === $key)
                        {!! $direction === 'asc' ? '↑' : '↓' !!}
                        @endif
                    </a>
                    @else
                    {{ $label }}
                    @endif
                </th>
                @endforeach

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? '—' }}</td>
                <td>{{ number_format($order->total, 2) }}</td>
                <td><span class="badge badge-info">{{ ucfirst($order->status) }}</span></td>
                <td>{{ $order->coupon?->code ?? '-' }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No orders yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination with sort params --}}
    {{ $orders->appends(['sort' => $sort, 'direction' => $direction])->links() }}
</div>
@endsection