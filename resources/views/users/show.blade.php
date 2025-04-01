@extends('layouts.app')

@section('title', 'Usuario')
@section('page-title', 'Datos del usuario')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <img src="{{ asset($user->profile_image ?? 'images/avatar.png') }}"
                    alt="Foto de {{ $user->name }}"
                    class="rounded"
                    style="width: 100px; height: 100px; object-fit: cover;">
                

                <h3 class="card-title mb-0 ms-3">
                {{ $user->name->name }}
                {{ $user->name->surname_first }}
                {{ $user->name->surname_second }}
                </h3>
            </div>
        
            <hr>

            <ul class="list-group list-group-flush">
                <li class="list-group-item text-dark"><strong>DNI:</strong> {{ $user->dni }}</li>
                <li class="list-group-item text-dark"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item text-dark"><strong>Teléfono:</strong> {{ $user->phone }}</li>
                <li class="list-group-item text-dark"><strong>País:</strong> {{ $user->address->country }}</li>
                <li class="list-group-item text-dark"><strong>Provincia:</strong> {{ $user->address->province }}</li>
                <li class="list-group-item text-dark"><strong>Ciudad:</strong> {{ $user->address->city }}</li>
                <li class="list-group-item text-dark"><strong>Código Postal:</strong> {{ $user->address->postal_code }}</li>

                {{-- Direccion completa--}}
                @php
                    $direccion = $user->address->street_name; 
                    if ($user->address?->passageway) {
                        $direccion .= ', pasage: ' . $user->address->passageway;
                    }
                    $direccion .= $user->address->entrance_number;
                    if ($user->address?->block) {
                        $direccion .= ', bloque: ' . $user->address->block;
                    }
                    $direccion .= ', piso: ' . $user->address->floor . ', puerta: ' . $user->address->apartment_number;
                @endphp
                <li class="list-group-item text-dark">
                    <strong>Dirección:</strong> {{ $direccion }}
                </li>

                @if($user->plates->isNotEmpty())
                    <li class="list-group-item text-dark">
                        <strong>Matrículas:</strong>
                        {{ $user->plates->pluck('plate')->implode(', ') }}
                    </li>
                @endif
                
            </ul>
            
        </div>
    </div>

    @if($user->leasesAsClient->isNotEmpty())
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="text-dark">
                    {{ $user->leasesAsClient->count() === 1 ? 'Propiedad' : 'Propiedades' }} alquilada{{ $user->leasesAsClient->count() === 1 ? '' : 's' }}:
                </h3>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-dark"><strong>ID:</strong> {{ $user->leasesAsClient->first()->id }}</li>
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-3">
            Este usuario no tiene ninguna propiedad alquilada actualmente.
        </div>
    
    @endif
    

@endsection

