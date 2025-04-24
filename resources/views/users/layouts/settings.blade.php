@extends('layouts.app')

@section('title', 'Configuración')
@section('page-title', 'Configuración')

@section('content')

<h1 class="text-dark mt-4">Configuración</h1>
<p class="text-dark text-center">Configura tus preferencias y tus datos personales</p>
<div class="row">
    {{-- Menú lateral de tabs --}}
    <div class="col-md-3 border-end">
        <div class="nav flex-column nav-pills" role="tablist">
            <a class="nav-link {{ request()->is('configuracion') || request()->is('configuracion/general') ? 'active' : '' }}"
               href="{{ route('configuracion', 'general') }}">
                Información general
            </a>
            <a class="nav-link {{ request()->is('configuracion/security') ? 'active' : '' }}"
               href="{{ route('configuracion', 'security') }}">
                Seguridad
            </a>
            <a class="nav-link {{ request()->is('configuracion/notifications') ? 'active' : '' }}"
               href="{{ route('configuracion', 'notifications') }}">
                Notificaciones
            </a>
        </div>
    </div>

    {{-- Contenido dinámico de la pestaña --}}
    <div class="col-md-9">
        @yield('settings-content')
    </div>
</div>
@endsection
