@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('jobs.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline">
            &larr; Back to Jobs
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
        <h1 class="text-2xl font-semibold mb-6">Edit Job</h1>

        <form action="{{ route('jobs.update', $job) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Job Title *
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $job->title) }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Job Description *
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="6"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('description') border-red-500 @enderror"
                    required
                >{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="budget" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Budget (USD) *
                </label>
                <input 
                    type="number" 
                    name="budget" 
                    id="budget" 
                    step="0.01"
                    min="0"
                    value="{{ old('budget', $job->budget) }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('budget') border-red-500 @enderror"
                    required
                >
                @error('budget')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 mt-6">
                <button 
                    type="submit" 
                    class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
                >
                    Update Job
                </button>
                <a 
                    href="{{ route('jobs.index') }}" 
                    class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300 dark:hover:bg-zinc-600 text-zinc-900 dark:text-zinc-100 font-medium rounded-lg transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
