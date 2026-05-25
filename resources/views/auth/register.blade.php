@extends("master")
@section('title', 'Register')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 px-4 py-12 dark:bg-slate-900">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-100 dark:bg-slate-800 dark:border-slate-700">

        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight dark:text-white">Create an Account</h2>
            <p class="text-sm text-slate-500 mt-2 dark:text-slate-400">Join us today! It only takes a few minutes.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-slate-700 block dark:text-slate-300">Full Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-800 transition-all dark:bg-slate-900 dark:border-slate-700 dark:text-white dark:focus:border-indigo-400"
                    placeholder="John Doe">
            </div>

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

            <p class="text-sm text-slate-600 text-center dark:text-slate-400 pt-2">
                Already have an account?
                <a href="{{ route('users.login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline dark:text-indigo-400">
                    Login
                </a>
            </p>

            <button type="submit"
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-md shadow-indigo-500/10 hover:shadow-indigo-500/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Register
            </button>
        </form>

    </div>
</div>

@endsection