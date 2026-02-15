@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <h1 class="text-2xl font-semibold">Services</h1>
    @can('create', App\Models\Service::class)
        <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
            + Create Service
        </a>
    @endcan
</div>

@if($services->isEmpty())
    <p class="text-zinc-500 py-8">No services available yet.</p>
@else
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($services as $service)
            <div class="p-6 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="font-semibold text-lg">{{ $service->title }}</h2>
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">${{ number_format($service->price, 2) }}</span>
                </div>
                
                <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-3">
                    {{ $service->description }}
                </p>
                
                <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400 mb-4">
                    <span>by {{ $service->freelancer->name ?? 'Unknown' }}</span>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('services.show', $service) }}" class="flex-1 text-center px-3 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 rounded-lg text-sm font-medium transition">
                        View Details
                    </a>
                    
                    @can('update', $service)
                        <a href="{{ route('services.edit', $service) }}" class="px-3 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 rounded-lg text-sm font-medium transition">
                            Edit
                        </a>
                    @endcan
                    
                    @can('delete', $service)
                        <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 text-red-700 dark:text-red-400 rounded-lg text-sm font-medium transition">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $services->links() }}
    </div>
@endif
@endsection
