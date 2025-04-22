@extends('layouts.app')

@section('title', 'Alquileres')
@section('page-title', 'Listado de Alquileres')

@section('content')
<div class="container mt-4">

    <form method="GET" action="{{ route('leases.index') }}" class="row g-3 mb-4 align-items-end justify-content-center">
        @include('partials._lease-filters', ['propertyTypes' => $propertyTypes, 'clients' => $clients])
    </form>

    @forelse($leases as $lease)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="{{ asset($lease->property->profile_image ?? 'images/property.jpg') }}"
                             alt="Imagen de propiedad"
                             class="img-fluid rounded-start"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="col">
                        <h5 class="mb-2 text-muted">
                            <span class="text-primary">
                                @if($lease->property->type)
                                {{ $lease->property->type->property_type }}
                                @endif
                            </span>
                            - {{ $lease->property->address->street_name }}
                        </h5>
                        
                        <!-- Datos del inquilino -->
                        <p class="mb-1 text-dark">
                            <strong>Inquilino:</strong> {{ $lease->client->name->name ?? 'Sin nombre' }}
                            {{ $lease->client->name->surname_first ?? '' }}
                            {{ $lease->client->name->surname_second ?? '' }}
                            |
                            <strong>Tel.:</strong> {{ $lease->client->phone }}
                        </p>
                        
                        <p class="mb-1 text-dark">
                            <strong>Inicio:</strong> {{ $lease->start_lease->format('d/m/Y')}}
                            | <strong> Fin:</strong>
                            @if($lease->ending_lease)
                                {{ $lease->ending_lease->format('d/m/Y') }}
                            @else
                                Indefinido
                            @endif
                        </p>
                        
                        @if($lease->value)
                          <p class="mb-0 text-dark">
                              <strong>Precio:</strong> {{ $lease->value }}€
                              | <strong> Tipo de pago:</strong>
                            {{ $lease->paymentType->payment_type }}
                          </p>
                        @endif
                    </div>
                    <div class="col-auto">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <form action="{{ route('leases.show', $lease) }}" method="GET">
                                @csrf
                                <button class="btn btn-secondary btn-lg text-white" type="submit">Ver Alquiler</button>
                            </form>
                            <form action="{{ route('leases.edit', $lease) }}" method="GET">
                                @csrf
                                <button class="btn btn-primary btn-lg text-white" type="submit">Editar Alquiler</button>
                            </form>
                            <form action="{{ route('leases.destroy', $lease) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-lg" type="submit">Finalizar Alquiler</button>
                            </form>
                            {{-- <form action="{{ route('leases.invoice', $lease) }}" method="POST">
                                <button class="btn btn-info btn-sm" type="submit">Generar Factura</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No hay ningún alquiler activo</p>
    @endforelse
</div>
@endsection
