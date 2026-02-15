@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Create Account</h1>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Full Name *
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                    required
                    autofocus
                >
                @error('name')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Email Address *
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                    required
                >
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Password *
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 @error('password') border-red-500 @enderror"
                    required
                >
                @error('password')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Confirm Password *
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Account Type *
                </label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="role" 
                            value="client"
                            {{ old('role', 'client') === 'client' ? 'checked' : '' }}
                            class="w-4 h-4 text-emerald-600 border-zinc-300 focus:ring-emerald-500"
                        >
                        <span class="ml-2 text-sm text-zinc-700 dark:text-zinc-300">Client (I want to hire)</span>
                    </label>
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="role" 
                            value="freelancer"
                            {{ old('role') === 'freelancer' ? 'checked' : '' }}
                            class="w-4 h-4 text-emerald-600 border-zinc-300 focus:ring-emerald-500"
                        >
                        <span class="ml-2 text-sm text-zinc-700 dark:text-zinc-300">Freelancer (I want to work)</span>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
            >
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-zinc-600 dark:text-zinc-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium">
                    Login here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
