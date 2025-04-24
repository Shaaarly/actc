@extends('layouts.app')

@section('title', 'Verifica tu email')
@section('page-title', 'Verifica tu correo electrónico')

@section('content')
<div class="auth-card">
    <h3 class="text-center text-primary">Confirma tu correo electrónico</h3>

    <p class="mt-3">Hemos enviado un enlace de verificación a tu correo electrónico. Por favor, revisa tu bandeja de entrada y haz clic en el enlace.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mt-3">
            Se ha enviado un nuevo enlace de verificación a tu correo.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-3">Reenviar correo de verificación</button>
    </form>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-link mt-3">Cerrar sesión</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection
