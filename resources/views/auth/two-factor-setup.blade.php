@extends('layouts.app')

@section('title', 'Seguridad - 2FA')
@section('page-title', 'Autenticación en dos pasos (2FA)')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">Seguridad: Autenticación en dos pasos (2FA)</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (!auth()->user()->two_factor_secret)
        <p>Activa la autenticación en dos pasos para proteger mejor tu cuenta.</p>

        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Activar 2FA</button>
        </form>
    @else
        <p>La autenticación en dos pasos está activada.</p>

        {{-- QR --}}
        <div class="my-4">
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>

        {{-- Recovery codes --}}
        <div class="mb-4">
            <p><strong>Guarda estos códigos de recuperación:</strong></p>
            <ul class="list-group">
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                    <li class="list-group-item font-monospace">{{ $code }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Opciones --}}
        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Desactivar 2FA</button>
        </form>
    @endif

    <a href="{{ route('profile') }}" class="btn btn-link mt-3">← Volver al perfil</a>
</div>
@endsection
