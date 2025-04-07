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
                

                <h3 class="card-title mb-0 ms-3 text-primary">
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
                <h3 class="text-primary">
                    {{ $user->leasesAsClient->count() === 1 ? 'Propiedad' : 'Propiedades' }} alquilada{{ $user->leasesAsClient->count() === 1 ? '' : 's' }}:
                </h3>
                <hr>
                
                <ul class="list-group list-group-flush">
                    @foreach($user->leasesAsClient->all() as $property)
                        <li class="list-group-item d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="mb-0 text-dark"><strong>Tipo:</strong> {{ $property->type->property_type }}</p>
                                <p class="mb-0 text-dark"><strong>Dirección:</strong> {{ $property->address->street_name }}</p>
                            
                                @if(isset($property->number))
                                    <p class="mb-4 text-dark"><strong>Identificador:</strong> {{ $property->number }}{{ $property->letter }}</p>
                                @endif
                            </div>
                            <div class="d-flex gap-3">
                                <form action="{{ route('properties.show', $property) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-warning btn-lg text-white" type="submit">Ver Propiedad</button>
                                </form>
                                <form action="{{ route('properties.edit', $property) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary btn-lg text-white" type="submit">Editar Propiedad</button>
                                </form>
                            </div>
                        </li>
                        
                    @endforeach
                    
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-3">
            Este usuario no tiene ninguna propiedad alquilada actualmente.
        </div>
    
    @endif
    

@endsection

