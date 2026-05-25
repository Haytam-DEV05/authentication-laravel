@extends('master')
@section('title', 'Verify email')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-900 text-white p-6">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-xl max-w-md text-center border-t-4 border-red-500">
        <h2 class="text-2xl font-bold mb-4 text-blue-400">Ttheqeq mn l-Email dialek!</h2>
        <p class="text-slate-300 mb-6">
            Sifna lik wahed l-lien dial l-verification l-email dialek.
            Ghir cliki 3lih bach t-active l-compte.
        </p>

        @if (session('message'))
        <div class="mb-4 text-sm font-medium text-green-400">
            L-lien t-sifet lik mra khrra jded!
        </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition duration-200">
                Re-sifet l-email mra khrra
            </button>
        </form>
    </div>
</div>
@endsection