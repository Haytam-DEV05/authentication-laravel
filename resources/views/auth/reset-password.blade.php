@extends("master")
@section('title', 'Réinitialiser le mot de passe')
@section('content')

<h2>Nouveau mot de passe</h2>
<h3>Créez votre nouveau mot de passe sécurisé</h3>

@if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('users.reset-password') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <div>
        <label>Nouveau mot de passe</label>
        <input type="password" name="password" required placeholder="••••••••">
    </div>

    <div>
        <label>Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" required placeholder="••••••••">
    </div>

    <button type="submit">Modifier le mot de passe</button>
</form>

@endsection