@extends('master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-slate-50 p-4 sm:p-6 md:p-8 dark:bg-slate-900 text-slate-800 dark:text-slate-100">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER W INFO DYAL L-ADMIN -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 dark:bg-slate-800 dark:border-slate-700">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Admin Control Panel</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage system users and view application status.</p>
            </div>

            <!-- Admin Details -->
            <div class="flex items-center gap-4 bg-slate-50 p-3 rounded-xl dark:bg-slate-900/50">
                <div class="w-10 h-10 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold uppercase shadow-md shadow-indigo-600/20">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="text-sm">
                    <p class="font-bold text-slate-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ auth()->user()->email }}</p>
                </div>
                <span class="px-2.5 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 rounded-md uppercase tracking-wider dark:bg-indigo-950/50 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50">
                    {{ auth()->user()->role }}
                </span>
            </div>
        </div>

        <!-- TABLE DYAL L-USERS -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden dark:bg-slate-800 dark:border-slate-700">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">All Users ({{ count($users) }})</h3>
                <span class="text-xs font-medium text-slate-400">Real-time database records</span>
            </div>

            <!-- Wrapper bch table ybqa responsive unique f t-tilifounat -->
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 dark:bg-slate-900/40 dark:border-slate-700">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">Id</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">User Info</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Created At</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                        @foreach ($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors dark:hover:bg-slate-900/20">
                            <td class="px-6 py-4 text-sm font-semibold text-slate-400 dark:text-slate-500">
                                #{{ $user->id }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900 dark:text-white">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300 font-medium">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->role === 'admin')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-950/30 dark:text-amber-400 dark:border-amber-900/30 uppercase tracking-wide">
                                    {{ $user->role }}
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200 dark:bg-slate-900 dark:text-slate-400 dark:border-slate-700 uppercase tracking-wide">
                                    {{ $user->role }}
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 font-medium whitespace-nowrap">
                                {{ $user->created_at->format('Y / M, d, D') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <a href=""
                                    class="inline-flex items-center justify-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold text-xs rounded-lg transition-colors shadow-sm dark:bg-indigo-950/40 dark:text-indigo-400 dark:hover:bg-indigo-900/60 border border-indigo-100/50 dark:border-indigo-900/30">
                                    Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection