@extends('layouts.app')

@section('title', $service->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('services.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline">
            &larr; Back to Services
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $service->title }}</h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    by <span class="font-medium">{{ $service->freelancer->name ?? 'Unknown' }}</span>
                </p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">
                    ${{ number_format($service->price, 2) }}
                </div>
                <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                    {{ $service->delivery_time }} day delivery
                </div>
            </div>
        </div>

        <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6 mb-6">
            <h2 class="text-xl font-semibold mb-3">Description</h2>
            <p class="text-zinc-700 dark:text-zinc-300 whitespace-pre-wrap">{{ $service->description }}</p>
        </div>

        <div class="flex gap-4">
            <form action="{{ route('orders.store', $service) }}" method="POST" class="flex-1">
                @csrf
                <button 
                    type="submit" 
                    class="w-full px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
                >
                    Order Now
                </button>
            </form>

            @can('update', $service)
                <a 
                    href="{{ route('services.edit', $service) }}" 
                    class="px-6 py-3 bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300 dark:hover:bg-zinc-600 text-zinc-900 dark:text-zinc-100 font-medium rounded-lg transition"
                >
                    Edit Service
                </a>
            @endcan
        </div>
    </div>
</div>
@endsection
