@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <h1 class="text-2xl font-semibold">My Orders</h1>
</div>

@if($orders->isEmpty())
    <p class="text-zinc-500 py-8">No orders yet.</p>
@else
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="block p-6 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <h2 class="font-semibold text-lg">Order #{{ $order->id }}</h2>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
                            'active' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                            'completed' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
                            'cancelled' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                        ];
                    @endphp
                    <span class="px-2 py-0.5 rounded text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-zinc-100 dark:bg-zinc-800' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                
                <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-3">
                    {{ $order->service ? $order->service->title : 'Service not available' }}
                </p>
                
                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium text-emerald-600 dark:text-emerald-400">
                        ${{ number_format($order->amount, 2) }}
                    </span>
                    <span class="text-zinc-500 dark:text-zinc-400">
                        {{ $order->created_at->format('M d, Y') }}
                    </span>
                </div>

                <div class="mt-3 pt-3 border-t border-zinc-200 dark:border-zinc-700 text-xs text-zinc-500 dark:text-zinc-400">
                    @if($order->client_id === auth()->id())
                        Client: You → Freelancer: {{ $order->freelancer->name ?? 'N/A' }}
                    @else
                        Client: {{ $order->client->name ?? 'N/A' }} → Freelancer: You
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
@endif
@endsection
