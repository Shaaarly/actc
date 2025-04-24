@extends('layouts.app')

@section('title', 'Recuperar contraseña')
@section('page-title', 'Recuperar contraseña')

@section('content')
<div class="auth-card">
    <h3 class="text-center text-primary card-title">¿Olvidaste tu contraseña?</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Tu email" required autofocus>
            <label for="email">Introduce tu email</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary p-4 w-100">Enviar enlace</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Volver al login</a>
    </div>
</div>
@endsection
