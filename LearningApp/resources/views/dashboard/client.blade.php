@extends('layouts.app')

@section('title', 'Client Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">
            Available Services
        </h1>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Services Grid -->
    @if($services->isEmpty())
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-800 p-12 text-center">
            <p class="text-zinc-500 dark:text-zinc-400 text-lg">
                No services available at the moment.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-md transition-shadow overflow-hidden">
                    <!-- Card Content -->
                    <div class="p-6 space-y-4">
                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ $service->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-zinc-600 dark:text-zinc-400 line-clamp-3">
                            {{ $service->description }}
                        </p>

                        <!-- Service Details -->
                        <div class="space-y-2 text-sm">
                            <!-- Price -->
                            <div class="flex items-center justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Price:</span>
                                <span class="font-semibold text-emerald-600 dark:text-emerald-400 text-lg">
                                    ${{ number_format($service->price, 2) }}
                                </span>
                            </div>

                            <!-- Delivery Days -->
                            <div class="flex items-center justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Delivery:</span>
                                <span class="font-medium text-zinc-700 dark:text-zinc-300">
                                    {{ $service->delivery_days }} {{ Str::plural('day', $service->delivery_days) }}
                                </span>
                            </div>

                            <!-- Freelancer -->
                            <div class="flex items-center justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Freelancer:</span>
                                <span class="font-medium text-zinc-700 dark:text-zinc-300">
                                    {{ $service->freelancer->name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="px-6 pb-6">
                        @if($service->user_id === auth()->id())
                            <button 
                                disabled 
                                class="w-full bg-zinc-300 dark:bg-zinc-700 text-zinc-500 dark:text-zinc-400 px-4 py-2.5 rounded-lg font-medium cursor-not-allowed"
                            >
                                Your Service
                            </button>
                        @else
                            <form method="POST" action="{{ route('services.request', $service->id) }}">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-4 py-2.5 rounded-lg font-medium transition-colors"
                                >
                                    Request Service
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
