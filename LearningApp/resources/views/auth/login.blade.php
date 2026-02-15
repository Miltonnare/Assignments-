@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-zinc-950">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl p-8">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/30 mb-4">
                    <svg class="w-5 h-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-zinc-100 tracking-tight">Welcome back</h1>
                <p class="text-sm text-zinc-500 mt-1">Sign in to your account to continue</p>
            </div>

            {{-- Global auth error (e.g. invalid credentials) --}}
            @if($errors->has('email') && !$errors->has('password'))
            @endif

            @if(session('status'))
                <div class="flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm rounded-lg px-4 py-3 mb-6" role="alert">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-semibold uppercase tracking-widest text-zinc-400">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        autofocus
                        required
                        placeholder="you@example.com"
                        @class([
                            'w-full px-4 py-2.5 rounded-lg text-sm text-zinc-100 placeholder-zinc-600',
                            'bg-zinc-800/60 border transition duration-150 outline-none',
                            'focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500',
                            'border-zinc-700 hover:border-zinc-600' => !$errors->has('email'),
                            'border-red-500 focus:ring-red-500 focus:border-red-500' => $errors->has('email'),
                        ])
                        @if($errors->has('email')) aria-describedby="email-error" aria-invalid="true" @endif
                    >
                    @error('email')
                        <p id="email-error" class="flex items-center gap-1.5 text-xs text-red-400 mt-1" role="alert">
                            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-widest text-zinc-400">
                            Password
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-xs text-emerald-400 hover:text-emerald-300 transition-colors duration-150 hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        required
                        placeholder="••••••••"
                        @class([
                            'w-full px-4 py-2.5 rounded-lg text-sm text-zinc-100 placeholder-zinc-600',
                            'bg-zinc-800/60 border transition duration-150 outline-none',
                            'focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500',
                            'border-zinc-700 hover:border-zinc-600' => !$errors->has('password'),
                            'border-red-500 focus:ring-red-500 focus:border-red-500' => $errors->has('password'),
                        ])
                        @if($errors->has('password')) aria-describedby="password-error" aria-invalid="true" @endif
                    >
                    @error('password')
                        <p id="password-error" class="flex items-center gap-1.5 text-xs text-red-400 mt-1" role="alert">
                            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember me --}}
                <label class="group flex items-center gap-3 cursor-pointer select-none">
                    <div class="relative">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="sr-only peer"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <div class="w-4 h-4 rounded border border-zinc-600 bg-zinc-800
                                    transition-all duration-150
                                    peer-checked:bg-emerald-500 peer-checked:border-emerald-500
                                    peer-focus-visible:ring-2 peer-focus-visible:ring-emerald-500 peer-focus-visible:ring-offset-1 peer-focus-visible:ring-offset-zinc-900
                                    group-hover:border-zinc-500">
                        </div>
                        <svg class="absolute inset-0 w-4 h-4 text-zinc-950 opacity-0 peer-checked:opacity-100 transition-opacity duration-150 pointer-events-none"
                             viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 8 6.5 11.5 13 5"/>
                        </svg>
                    </div>
                    <span class="text-sm text-zinc-400 group-hover:text-zinc-300 transition-colors duration-150">
                        Remember me
                    </span>
                </label>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600
                           text-zinc-950 text-sm font-bold rounded-xl
                           transition-all duration-150 shadow-lg shadow-emerald-500/20
                           hover:shadow-emerald-500/30 hover:-translate-y-px active:translate-y-0
                           focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-500"
                >
                    Sign In →
                </button>

            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-800"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-zinc-900 px-3 text-xs text-zinc-600">or</span>
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-zinc-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                   class="text-emerald-400 hover:text-emerald-300 font-medium transition-colors duration-150 hover:underline">
                    Register here
                </a>
            </p>

        </div>
    </div>
</div>

@endsection