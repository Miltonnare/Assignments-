@extends('layouts.app')

@section('title', 'Create Service')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('services.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline">
            &larr; Back to Services
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
        <h1 class="text-2xl font-semibold mb-6">Create New Service</h1>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Service Title *
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Description *
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="5"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('description') border-red-500 @enderror"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Price (USD) *
                </label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    step="0.01"
                    min="0"
                    value="{{ old('price') }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('price') border-red-500 @enderror"
                    required
                >
                @error('price')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="delivery_time" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Delivery Time (days) *
                </label>
                <input 
                    type="number" 
                    name="delivery_time" 
                    id="delivery_time" 
                    min="1"
                    value="{{ old('delivery_time') }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('delivery_time') border-red-500 @enderror"
                    required
                >
                @error('delivery_time')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 mt-6">
                <button 
                    type="submit" 
                    class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
                >
                    Create Service
                </button>
                <a 
                    href="{{ route('services.index') }}" 
                    class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300 dark:hover:bg-zinc-600 text-zinc-900 dark:text-zinc-100 font-medium rounded-lg transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
