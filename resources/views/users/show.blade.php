@extends('layouts.app')

@section('title', 'Perfil')
@section('page-title', 'Perfil de usuario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">Tu perfil</h2>
    <a href="{{ route('configuracion') }}" class="btn btn-outline-primary btn-lg">
        <i class="fa-solid fa-gear"></i> Configurar
    </a>
</div>
<div class="user-container">
    {{-- Encabezado del perfil --}}
    <div class="card mb-4">
        <div class="card-body text-center">
            <img src="{{ asset($user->profile_image ?? 'images/avatar.png') }}"
                 alt="Foto de {{ $user->name }}"
                 class="rounded-circle mb-3"
                 style="width: 100px; height: 100px; object-fit: cover;">

            <h4 class="mb-1 text-primary">
                @if($user->name)
                    {{ $user->name->name }} {{ $user->name->surname_first }} {{ $user->name->surname_second }}
                @else
                    {{ $user->email }}
                @endif
            </h4>

            <p class="{{ $user->email_verified_at ? 'text-success' : 'text-danger' }} mb-0">
                {{ $user->email_verified_at ? '' : 'Usuario no confirmado' }}
            </p>
        </div>
    </div>

    {{-- Card 1: General --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-primary mb-3">General</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>DNI:</strong> {{ $user->dni ?? 'Sin especificar' }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->phone ?? 'Sin especificar' }}</li>
                @if($user->plates->isNotEmpty())
                    <li class="list-group-item">
                        <strong>Matrículas:</strong> {{ $user->plates->pluck('plate')->implode(', ') }}
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Card 2: Dirección --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-primary mb-3">Dirección</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>País:</strong> {{ $user->address?->country ?? 'Sin especificar' }}</li>
                <li class="list-group-item"><strong>Provincia:</strong> {{ $user->address?->province ?? 'Sin especificar' }}</li>
                <li class="list-group-item"><strong>Ciudad:</strong> {{ $user->address?->city ?? 'Sin especificar' }}</li>
                <li class="list-group-item"><strong>Código Postal:</strong> {{ $user->address?->postal_code ?? 'Sin especificar' }}</li>
                <li class="list-group-item">
                    <strong>Dirección completa:</strong> 
                    @if($user->address)
                        {{ $user->formatFullAddress() }}
                    @else
                        <span>Dirección no disponible</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    {{-- Card 3: Actividad --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-primary mb-3">Actividad</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Último acceso:</strong> 
                    {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Sin registros' }}
                </li>
                <li class="list-group-item">
                    <strong>IP actual:</strong> {{ request()->ip() }}
                </li>
                <li class="list-group-item">
                    <strong>Dispositivo actual:</strong> {{ request()->userAgent() }}
                </li>
            </ul>
        </div>
    </div>

    {{-- Card 4: Seguridad --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-primary mb-3">Seguridad</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Verificación en dos pasos:</strong> 
                    @if($user->two_factor_secret)
                        <span class="text-success fw-bold">Activada</span>
                    @else
                        <span class="text-danger fw-bold">No activada</span> 
                        <a href="{{ route('two-factor.setup') }}" class="btn btn-lg btn-outline-primary ms-3">Activar ahora</a>
                    @endif
                </li>
                <li class="list-group-item">
                    <strong>Email verificado:</strong>
                    <span class="{{ $user->email_verified_at ? 'text-success' : 'text-danger' }}">
                        {{ $user->email_verified_at ? 'Sí' : 'No' }}
                    </span>
                </li>
            </ul>
        </div>
    </div>




</div>
@endsection
