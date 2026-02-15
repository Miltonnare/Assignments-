@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

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
                    autofocus
                >
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
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

            <div class="flex items-center mb-6">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember"
                    class="w-4 h-4 text-emerald-600 border-zinc-300 rounded focus:ring-emerald-500"
                >
                <label for="remember" class="ml-2 text-sm text-zinc-700 dark:text-zinc-300">
                    Remember me
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition"
            >
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-zinc-600 dark:text-zinc-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline font-medium">
                    Register here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
