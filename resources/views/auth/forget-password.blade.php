@extends("master")
@section('title', 'Forget Password')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 px-4 py-12 dark:bg-slate-900">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-100 dark:bg-slate-800 dark:border-slate-700">

        @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 flex items-center gap-2 dark:bg-rose-950/30 dark:border-rose-800 dark:text-rose-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
        @endif

        <div class="mb-8 text-center">
            <div class="mx-auto w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mb-4 dark:bg-indigo-950/50 dark:text-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight dark:text-white">Forgot Password?</h2>
            <p class="text-sm text-slate-500 mt-2 dark:text-slate-400">Enter your email and we'll help you find your account.</p>
        </div>

        <form action="{{ Route('users.forget-password') }}" method="post" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-700 block dark:text-slate-300">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-800 transition-all dark:bg-slate-900 dark:border-slate-700 dark:text-white dark:focus:border-indigo-400"
                    placeholder="Enter your email">
            </div>

            <button type="submit"
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-md shadow-indigo-500/10 hover:shadow-indigo-500/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Continue
            </button>

            <div class="text-center pt-2">
                <a href="{{ route('users.login') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors dark:text-slate-400 dark:hover:text-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Login
                </a>
            </div>
        </form>

    </div>
</div>

@endsection