@extends("master")
@section('title', 'Vérifier le code')
@section('content')

<h2>Vérification du code</h2>
<h3>Entrez le code à 6 chiffres reçu par email</h3>

@if (session('success'))
<div style="color: green;">{{ session('success') }}</div>
@endif

@if (session('error'))
<div style="color: red;">{{ session('error') }}</div>
@endif

<form action="{{ route('users.verify-code') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <div>
        <label>Code de Validation</label>
        <input type="text" name="code" required placeholder="123456" maxlength="6">
    </div>
    <button type="submit">Vérifier</button>
</form>

@endsection