@extends('master')
@section('title', 'Info About User')
@section('content')

<div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-12">

    <!-- Notifications -->
    @if (session('success'))
    <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-xl shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <p class="text-sm font-semibold">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <a href="{{ route('dashboard') }}">Retoure</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <!-- Left Column: User Profile Card & Avatar Upload -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-r from-indigo-500 to-purple-600"></div>

                <div class="relative flex flex-col items-center text-center mt-6 pb-6 border-b border-slate-100">
                    <!-- Profile Image / Initials -->
                    <div class="relative group">
                        @if($user->image)
                        <div class="w-24 h-24 rounded-full ring-4 ring-white shadow-md overflow-hidden bg-slate-100">
                            <img src="/storage/{{ $user->image }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-24 h-24 bg-gradient-to-tr from-indigo-500 to-indigo-600 text-white rounded-full ring-4 ring-white shadow-md flex items-center justify-center font-bold text-2xl uppercase">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        @endif
                    </div>

                    <h1 class="text-xl font-bold text-slate-800 mt-4">{{ $user->name }}</h1>
                    <p class="text-xs font-semibold text-indigo-600 mt-1 uppercase tracking-wider bg-indigo-50/60 px-3 py-1 rounded-full">ID: #{{ $user->id }}</p>
                </div>

                <!-- Info Details -->
                <div class="mt-6 space-y-4 text-sm">
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Email Address</span>
                        <span class="block font-medium text-slate-700 mt-0.5 break-all">{{ $user->email }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Joined On</span>
                        <span class="block font-medium text-slate-700 mt-0.5">{{ $user?->created_at?->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Modern Upload Image Form -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-800 mb-3 uppercase tracking-wider">Update Profile Picture</h3>
                <form action="{{ route('users.editImage', $user->id) }}" method="post" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    @method('PATCH')

                    <div class="relative group flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100/50 hover:border-indigo-400 transition duration-150">
                            <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-500 mb-1.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-xs text-slate-500"><span class="font-semibold text-indigo-600">Click to upload</span> or drag</p>
                            </div>
                            <input type="file" name="image" id="image" class="hidden" onchange="this.form.submit()" />
                        </label>
                    </div>
                    @error('image')
                    <span class="block text-xs font-medium text-rose-500 mt-1" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </form>
            </div>
        </div>

        <!-- Right Column: Security & Actions Forms -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Security Card: Edit Password -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Security Settings</h2>
                        <p class="text-xs text-slate-500">Update this user's account password securely.</p>
                    </div>
                </div>

                <form action="{{ route('admin.editUser', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">New Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="w-full px-3.5 py-2.5 border @error('password') border-rose-300 focus:ring-rose-100 focus:border-rose-500 @else border-slate-200 focus:ring-indigo-100 focus:border-indigo-500 @enderror rounded-xl shadow-sm focus:outline-none focus:ring-4 transition duration-150 text-sm">
                            @error('password')
                            <span class="block text-xs font-medium text-rose-500 mt-1.5" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition duration-150 text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>


            <div class="bg-rose-50/30 border border-gray-100 rounded-2xl p-6 shadow-sm">
                <h1>Don't have phone Number</h1>
                <form action="{{ route('users.addPhoneNumber', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label>Phone Number</label>
                        <input type="text" name="numberPhone" id="numberPhone" placeholder="0628443260">
                    </div>
                    <button type="submit">Add Phone</button>
                </form>
            </div>

            <!-- Account Management: Danger Zone -->
            <div class="bg-rose-50/30 border border-rose-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="space-y-1">
                        <h2 class="text-base font-bold text-rose-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1a3 3 0 003 3h10M4 7h16"></path>
                            </svg>
                            Danger Zone
                        </h2>
                        <p class="text-xs text-rose-600/90 font-medium">Once you delete this account, all data will be permanently wiped out.</p>
                    </div>

                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm rounded-xl shadow-sm hover:shadow-md transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
