@extends("master")
@section('title', 'Login')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 px-4 py-12 dark:bg-slate-900">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-100 dark:bg-slate-800 dark:border-slate-700">

        @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center gap-2 dark:bg-emerald-950/30 dark:border-emerald-800 dark:text-emerald-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 flex items-center gap-2 dark:bg-rose-950/30 dark:border-rose-800 dark:text-rose-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
        @endif

        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight dark:text-white">Welcome Back</h2>
            <p class="text-sm text-slate-500 mt-2 dark:text-slate-400">Please enter your details to sign in.</p>
        </div>

        <form action="{{ route('users.auth') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-700 block dark:text-slate-300">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-800 transition-all dark:bg-slate-900 dark:border-slate-700 dark:text-white dark:focus:border-indigo-400"
                    placeholder="you@example.com">
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-slate-700 block dark:text-slate-300">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-800 transition-all dark:bg-slate-900 dark:border-slate-700 dark:text-white dark:focus:border-indigo-400"
                    placeholder="••••••••">
            </div>

            <p class="text-sm text-slate-600 text-center dark:text-slate-400">
                Don't have an account?
                <a href="{{ route('users.register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline dark:text-indigo-400">
                    Register here
                </a>
            </p>

            <button type="submit"
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-md shadow-indigo-500/10 hover:shadow-indigo-500/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign In
            </button>
            <a href="{{ route('users.view-forget-password') }}"
                class="w-full py-3 px-4 hover:bg-gray-300 font-semibold rounded-xl shadow-md shadow-indigo-500/10 hover:shadow-indigo-500/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 text-black mx-auto max-w-full">
                Mot de Pass Oublie</a>
        </form>

    </div>
</div>

@endsection