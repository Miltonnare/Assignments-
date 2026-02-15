@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <h1 class="text-2xl font-semibold">Job Listings</h1>
    @can('create', App\Models\Job::class)
        <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
            + Post a Job
        </a>
    @endcan
</div>

@if($jobs->isEmpty())
    <p class="text-zinc-500 py-8">No jobs posted yet.</p>
@else
    <div class="space-y-4">
        @foreach($jobs as $job)
            <div class="p-6 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        <h2 class="font-semibold text-xl mb-2">{{ $job->title }}</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-3 line-clamp-2">
                            {{ $job->description }}
                        </p>
                        <div class="flex items-center gap-4 text-sm text-zinc-500 dark:text-zinc-400">
                            <span>Posted by {{ $job->client->name ?? 'Unknown' }}</span>
                            <span>•</span>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-end gap-2">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                            ${{ number_format($job->budget, 2) }}
                        </div>
                        
                        <div class="flex gap-2">
                            @can('update', $job)
                                <a href="{{ route('jobs.edit', $job) }}" class="px-3 py-1.5 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 rounded-lg text-sm font-medium transition">
                                    Edit
                                </a>
                            @endcan
                            
                            @can('delete', $job)
                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 text-red-700 dark:text-red-400 rounded-lg text-sm font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
@endif
@endsection
