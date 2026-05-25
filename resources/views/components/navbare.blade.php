<nav class="bg-slate-900 text-white px-6 py-4 flex items-center justify-between shadow-md">
    <div class="text-xl font-bold tracking-wide text-indigo-400 cursor-pointer hover:text-indigo-300 transition-colors">
        Logo
    </div>

    <ul class="flex items-center gap-4">
        @guest
        <li>
            <a href="{{ route('users.login') }}"
                class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition-colors">
                Login
            </a>
        </li>
        <li>
            <a href="{{ route('users.register') }}"
                class="px-4 py-2 text-sm font-medium bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg shadow transition-all duration-200">
                Register
            </a>
        </li>
        @endguest

        @auth
        <li>
            <a href="{{ route('users.logout') }}"
                class="px-4 py-2 text-sm font-medium bg-rose-600/10 text-rose-400 hover:bg-rose-600 hover:text-white rounded-lg transition-all duration-200">
                Logout
            </a>
        </li>
        @endauth
    </ul>
</nav>