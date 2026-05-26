@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="min-h-screen bg-slate-50 p-6 dark:bg-slate-900 flex items-center justify-center">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden dark:bg-slate-800 dark:border-slate-700">

        <div class="h-32 bg-gradient-to-r from-indigo-600 to-purple-600 flex items-end p-6">
            <h1 class="text-2xl font-bold text-white tracking-wide">
                Welcome Back, {{ auth()->user()?->name ?? 'User' }}! 👋
            </h1>
        </div>

        <div class="p-8">
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100 dark:border-slate-700">
                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-3xl font-bold uppercase shadow-inner dark:bg-indigo-950/50 dark:text-indigo-400">
                    {{ substr(auth()->user()?->name ?? 'U', 0, 1) }}
                </div>

                <div class="text-center sm:text-left space-y-1">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Account Overview</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Manage your profile details and account security.</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-900/50 dark:border-slate-700">
                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 tracking-wider uppercase block mb-1">Full Name</span>
                    <span class="text-base font-semibold text-slate-800 dark:text-white">
                        {{ auth()->user()?->name ?? 'Not set' }}
                    </span>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-900/50 dark:border-slate-700">
                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 tracking-wider uppercase block mb-1">Email Address</span>
                    <span class="text-base font-semibold text-slate-800 dark:text-white break-all">
                        {{ auth()->user()?->email ?? 'Not set' }}
                    </span>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600">
                    <a href="{{ route('users.show', auth()->user()) }}">Edit Profile</a>
                </button>
                <button class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/10 hover:shadow-indigo-500/20 transition-all duration-200">
                    Delete
                </button>
            </div>

        </div>
    </div>
</div>

@endsection