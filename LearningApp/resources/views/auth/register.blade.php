@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-zinc-950">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl p-8">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/30 mb-4">
                    <svg class="w-5 h-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-zinc-100 tracking-tight">Create Account</h1>
                <p class="text-sm text-zinc-500 mt-1">Join thousands of clients and freelancers</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- Full Name --}}
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-semibold uppercase tracking-widest text-zinc-400">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        autofocus
                        required
                        placeholder="Jane Smith"
                        @class([
                            'w-full px-4 py-2.5 rounded-lg text-sm text-zinc-100 placeholder-zinc-600',
                            'bg-zinc-800/60 border transition duration-150 outline-none',
                            'focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500',
                            'border-zinc-700 hover:border-zinc-600' => !$errors->has('name'),
                            'border-red-500 focus:ring-red-500 focus:border-red-500' => $errors->has('name'),
                        ])
                        @if($errors->has('name')) aria-describedby="name-error" aria-invalid="true" @endif
                    >
                    @error('name')
                        <p id="name-error" class="flex items-center gap-1.5 text-xs text-red-400 mt-1" role="alert">
                            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

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
                    <label for="password" class="block text-xs font-semibold uppercase tracking-widest text-zinc-400">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="new-password"
                        required
                        placeholder="Min. 8 characters"
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

                {{-- Confirm Password --}}
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-widest text-zinc-400">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        autocomplete="new-password"
                        required
                        placeholder="Repeat password"
                        class="w-full px-4 py-2.5 rounded-lg text-sm text-zinc-100 placeholder-zinc-600
                               bg-zinc-800/60 border border-zinc-700 hover:border-zinc-600
                               transition duration-150 outline-none
                               focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                </div>

                {{-- Divider --}}
                <div class="border-t border-zinc-800 my-1"></div>

                {{-- Account Type --}}
                <div class="space-y-2">
                    <span class="block text-xs font-semibold uppercase tracking-widest text-zinc-400"
                          id="role-group-label">
                        Account Type
                    </span>

                    <div class="grid grid-cols-2 gap-3"
                         role="radiogroup"
                         aria-labelledby="role-group-label"
                         @if($errors->has('role')) aria-describedby="role-error" @endif>

                        {{-- Client --}}
                        <label class="group cursor-pointer">
                            <input
                                type="radio"
                                name="role"
                                value="client"
                                class="sr-only peer"
                                {{ old('role', 'client') === 'client' ? 'checked' : '' }}
                            >
                            <div class="flex flex-col gap-1 p-3.5 rounded-xl border border-zinc-700
                                        bg-zinc-800/40 transition-all duration-150
                                        group-hover:border-zinc-500 group-hover:bg-zinc-800
                                        peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10
                                        peer-focus-visible:ring-2 peer-focus-visible:ring-emerald-500">
                                <span class="text-xl leading-none">🏢</span>
                                <span class="text-sm font-semibold text-zinc-200">Client</span>
                                <span class="text-xs text-zinc-500">I want to hire</span>
                            </div>
                        </label>

                        {{-- Freelancer --}}
                        <label class="group cursor-pointer">
                            <input
                                type="radio"
                                name="role"
                                value="freelancer"
                                class="sr-only peer"
                                {{ old('role') === 'freelancer' ? 'checked' : '' }}
                            >
                            <div class="flex flex-col gap-1 p-3.5 rounded-xl border border-zinc-700
                                        bg-zinc-800/40 transition-all duration-150
                                        group-hover:border-zinc-500 group-hover:bg-zinc-800
                                        peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10
                                        peer-focus-visible:ring-2 peer-focus-visible:ring-emerald-500">
                                <span class="text-xl leading-none">💼</span>
                                <span class="text-sm font-semibold text-zinc-200">Freelancer</span>
                                <span class="text-xs text-zinc-500">I want to work</span>
                            </div>
                        </label>

                    </div>

                    @error('role')
                        <p id="role-error" class="flex items-center gap-1.5 text-xs text-red-400 mt-1" role="alert">
                            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600
                           text-zinc-950 text-sm font-bold rounded-xl
                           transition-all duration-150 shadow-lg shadow-emerald-500/20
                           hover:shadow-emerald-500/30 hover:-translate-y-px active:translate-y-0
                           focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-500"
                >
                    Create Account →
                </button>

            </form>

            {{-- Footer --}}
            <p class="text-center text-xs text-zinc-500 mt-6">
                Already have an account?
                <a href="{{ route('login') }}"
                   class="text-emerald-400 hover:text-emerald-300 font-medium transition-colors duration-150 hover:underline">
                    Login here
                </a>
            </p>

        </div>
    </div>
</div>

@endsection