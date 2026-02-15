@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline">
            &larr; Back to Orders
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Order #{{ $order->id }}</h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    Placed {{ $order->created_at->format('F d, Y') }} at {{ $order->created_at->format('g:i A') }}
                </p>
            </div>
            
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
                    'active' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                    'completed' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
                    'cancelled' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                ];
            @endphp
            <span class="px-4 py-2 rounded-lg text-sm font-semibold {{ $statusColors[$order->status] ?? 'bg-zinc-100 dark:bg-zinc-800' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Service Details</h2>
            
            @if($order->service)
                <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $order->service->title }}</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">{{ $order->service->description }}</p>
                </div>
            @else
                <p class="text-zinc-500 dark:text-zinc-400">Service details not available</p>
            @endif

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Client</p>
                    <p class="font-medium">{{ $order->client->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Freelancer</p>
                    <p class="font-medium">{{ $order->freelancer->name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6">
            <h2 class="text-xl font-semibold mb-4">Payment Details</h2>
            
            <div class="flex justify-between items-center text-2xl font-bold">
                <span>Total Amount:</span>
                <span class="text-emerald-600 dark:text-emerald-400">${{ number_format($order->amount, 2) }}</span>
            </div>
        </div>

        @can('updateStatus', $order)
            <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">Update Order Status</h2>
                
                <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="flex gap-3">
                    @csrf
                    @method('PATCH')
                    
                    <select 
                        name="status" 
                        class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                    >
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="active" {{ $order->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
                    >
                        Update Status
                    </button>
                </form>
            </div>
        @endcan

        @if($order->review)
            <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">Review</h2>
                
                <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-500 font-bold mr-2">★ {{ $order->review->rating }}/5</span>
                    </div>
                    <p class="text-zinc-700 dark:text-zinc-300">{{ $order->review->comment }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
