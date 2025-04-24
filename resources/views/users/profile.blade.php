@extends('layouts.app')

@section('title', 'Configuración de perfil')
@section('page-title', 'Ajustes')

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Sidebar de tabs -->
        <div class="col-md-3 mb-3">
            <div class="list-group">
                <a href="{{ route('profile', ['tab' => 'general']) }}"
                   class="list-group-item list-group-item-action {{ request('tab') === 'general' || request('tab') === null ? 'active' : '' }}">
                    Información general
                </a>
                <a href="{{ route('profile', ['tab' => 'security']) }}"
                   class="list-group-item list-group-item-action {{ request('tab') === 'security' ? 'active' : '' }}">
                    Seguridad
                </a>
                <a href="{{ route('profile', ['tab' => 'notifications']) }}"
                   class="list-group-item list-group-item-action {{ request('tab') === 'notifications' ? 'active' : '' }}">
                    Notificaciones
                </a>
            </div>
        </div>

        <!-- Contenido del tab -->
        <div class="col-md-9">
            <div class="tab-content p-4 border rounded bg-white shadow-sm">
                @include('users.tabs.' . (request('tab') ?? 'general'))
            </div>
        </div>
    </div>
</div>
@endsection
