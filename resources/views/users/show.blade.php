@extends('layouts.app')

@section('title', 'Perfil')
@section('page-title', 'Perfil de usuario')

@section('content')
<div class="container">
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
                {{ $user->confirmed ? '' : 'Usuario no confirmado' }}
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
                    @php
                        $direccion = $user->address?->street_name ?? ''; 
                        if ($user->address?->passageway) {
                            $direccion .= ', pasaje: ' . $user->address->passageway;
                        }
                        $direccion .= $user->address?->entrance_number ?? '';
                        if ($user->address?->block) {
                            $direccion .= ', bloque: ' . $user->address->block;
                        }
                        $direccion .= ', piso: ' . $user->address?->floor ?? '' . ', puerta: ' . $user->address?->apartment_number ?? '';
                    @endphp
                    <strong>Dirección completa:</strong> {{ $direccion }}
                </li>
            </ul>
        </div>
    </div>

    {{-- Título general fuera de las cards --}}
    <h3 class="text-primary m-4 text-center">Alquileres Vigentes</h4>

    @if($user->leasesAsClient->isNotEmpty())
        <div class="row g-4">
            @foreach($user->leasesAsClient as $lease)
                <div class=" col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between h-100">

                            {{-- Info del alquiler --}}
                            <div class="mb-3">
                                <p class="mb-2 text-dark"><strong>Tipo:</strong> {{ $lease->property->type->property_type }}</p>
                                <p class="mb-2 text-dark"><strong>Inicio de Alquiler:</strong> {{ $lease->start_lease->format('d/m/Y') }}</p>
                                <p class="mb-2 text-dark"><strong>Fin de Alquiler:</strong> {{ $lease->ending_lease?->format('d/m/Y') ?? 'No especificado' }}</p>
                                <p class="mb-2 text-dark"><strong>Dirección:</strong> {{ $lease->property->address->street_name }}</p>
                            </div>

                            {{-- Botones al fondo --}}
                            <div class="row mt-auto g-2">
                                <div class="{{ in_array(auth()->user()->role_id, [2, 3]) ? 'col-6' : 'col-12' }}">
                                    <a href="{{ route('properties.show', $lease->property) }}" class="btn btn-primary text-white w-100 btn-lg p-4">Ver</a>
                                </div>
                                @if(in_array(auth()->user()->role_id, [2, 3]))
                                    <div class="col-6">
                                        <a href="{{ route('properties.edit', $lease->property) }}" class="btn btn-secondary text-white w-100 btn-lg p-4">Editar</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Este usuario no tiene ninguna propiedad alquilada actualmente.
        </div>
    @endif


</div>
@endsection
