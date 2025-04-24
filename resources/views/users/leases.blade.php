@extends('layouts.app')

@section('title', 'Alquileres')
@section('page-title', 'Alquileres del usuario')

@section('content')


    <h3 class="text-primary m-4 text-center">Alquileres Vigentes</h4>

    @if($leases->isNotEmpty())
        <div class="row g-4">
            @foreach($leases as $lease)
                <div class=" col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between h-100">

                            <div class="mb-3">
                                <p class="mb-2 text-dark"><strong>Tipo:</strong> {{ $lease->property->type->property_type }}</p>
                                <p class="mb-2 text-dark"><strong>Inicio de Alquiler:</strong> {{ $lease->start_lease->format('d/m/Y') }}</p>
                                <p class="mb-2 text-dark"><strong>Fin de Alquiler:</strong> {{ $lease->ending_lease?->format('d/m/Y') ?? 'No especificado' }}</p>
                                <p class="mb-2 text-dark"><strong>Dirección:</strong> {{ $lease->property->address->street_name }}</p>
                            </div>

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

@endsection