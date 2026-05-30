@extends('master')
@section('title', 'Info About User')
@section('content')

<div class="max-w-4xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-12">
    
    <!-- Notifications -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
        
        <!-- Left Column: User Info Card -->
        <div class="md:col-span-1 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col items-center text-center pb-4 border-b border-slate-100">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold text-xl mb-3 shadow-inner">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <h1 class="text-xl font-bold text-slate-800">User Profile</h1>
                <p class="text-xs font-semibold text-indigo-600 mt-1 uppercase tracking-wider bg-indigo-50 px-2.5 py-0.5 rounded-full">ID: #{{ $user->id }}</p>
            </div>
            
            <div class="mt-5 space-y-4 text-sm">
                <div>
                    <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Full Name</span>
                    <span class="block font-semibold text-slate-700 mt-0.5">{{ $user->name }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Email Address</span>
                    <span class="block font-semibold text-slate-700 mt-0.5 break-all">{{ $user->email }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Joined On</span>
                    <span class="block font-semibold text-slate-700 mt-0.5">{{ $user?->created_at?->format('Y m, D') }}</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Actions Forms -->
        <div class="md:col-span-2 space-y-6">
            
            <!-- Edit Password Card -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-800">Security</h2>
                    <p class="text-sm text-slate-500">Update this user's password securely.</p>
                </div>
                
                <form action="{{ route('admin.editUser', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">New Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" 
                                class="w-full px-3.5 py-2 border @error('password') border-rose-400 focus:ring-rose-200 focus:border-rose-500 @else border-slate-300 focus:ring-indigo-200 focus:border-indigo-500 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-4 transition duration-150">
                            @error('password')
                                <span class="block text-xs font-medium text-rose-500 mt-1.5" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" 
                                class="w-full px-3.5 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition duration-150">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone (Delete Card) -->
            <div class="bg-rose-50/50 border border-rose-100 rounded-2xl p-6 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-rose-800">Danger Zone</h2>
                    <p class="text-sm text-rose-600/80">Once you delete this account, there is no going back. Please be certain.</p>
                </div>
                
                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection