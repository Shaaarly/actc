@extends('layouts.app')

@section('title', 'Alquiler')
@section('page-title', 'Detalles del Alquiler')

@section('content')
<div class="container mt-4">
    <!-- Card principal: Detalles del Alquiler -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <!-- Imagen de la propiedad -->
                <img src="{{ asset($lease->property->profile_image ?? 'images/property.jpg') }}"
                    alt="Imagen de propiedad"
                    class="rounded"
                    style="width: 100px; height: 100px; object-fit: cover;">
                <div class="ms-3">
                    <h3 class="card-title text-primary mb-0">
                        {{ $lease->property->address->street_name }}
                    </h3>
                    @if($lease->property->type)
                        <p class="mb-0 text-dark">
                            <strong>Tipo:</strong> {{ $lease->property->type->property_type }}
                        </p>
                    @endif
                    @if(isset($lease->property->number))
                        <p class="mb-0 text-dark">
                            <strong>Identificador:</strong> {{ $lease->property->number }}{{ $lease->property->letter ?? '' }}
                        </p>
                        <a href="{{ route('properties.show', $lease->property) }}" class="btn btn-primary text-white btn-lg">
                            Ver Propiedad
                        </a>
                    @endif
                </div>
            </div>
            <hr>
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-dark">
                    <strong>Modalidad de pago:</strong> 
                    {{ $lease->paymentType ? $lease->paymentType->payment_type : 'N/A' }}
                </li>
                <li class="list-group-item text-dark">
                    <strong>Fecha de inicio:</strong> 
                    {{ $lease->start_lease ? $lease->start_lease->format('d/m/Y') : '' }}
                </li>
                <li class="list-group-item text-dark">
                    <strong>Fecha de finalización:</strong> 
                    @if($lease->ending_lease)
                        {{ $lease->ending_lease->format('d/m/Y') }}
                    @else
                        Indefinida
                    @endif
                </li>
                <li class="list-group-item text-dark">
                    <strong>Precio:</strong> ${{ number_format($lease->value, 2) }}
                </li>
                <li class="list-group-item text-dark">
                    <strong>Llaves devueltas:</strong>
                     @if($lease->keys_returned)
                        Si
                     @else
                        No
                     @endif
                </li>
                @if($lease->property->remote)
                <li class="list-group-item text-dark">
                    <strong>Mando devuelto:</strong>
                     @if($lease->remote_returned)
                        Si
                     @else
                        No
                     @endif
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Card secundaria: Inquilino y Propietario -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Información del inquilino (Cliente) -->
                <div class="col-md-6">
                    <h4 class="text-secondary">Inquilino</h4>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($lease->client->profile_image ?? 'images/avatar.png') }}"
                            alt="Foto de {{ $lease->client->name->name }}"
                            class="rounded"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="ms-3">
                            <h5 class="mb-0 text-dark">
                                {{ $lease->client->name->name }} {{ $lease->client->name->surname_first }} {{ $lease->client->name->surname_second }}
                            </h5>
                            <p class="mb-0 text-dark"><strong>Teléfono:</strong> {{ $lease->client->phone }}</p>
                            <p class="mb-0 text-dark"><strong>Email:</strong> {{ $lease->client->email }}</p>
                            <a href="{{ route('users.show', $lease->client) }}" class="btn btn-secondary text-white btn-lg">
                                Ver Inquilino
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Información del propietario -->
                <div class="col-md-6">
                    <h4 class="text-secondary">Propietario</h4>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($lease->owner->profile_image ?? 'images/avatar.png') }}"
                            alt="Foto de {{ $lease->owner->name->name }}"
                            class="rounded"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="ms-3">
                            <h5 class="mb-0 text-dark">
                                {{ $lease->owner->name->name }} {{ $lease->owner->name->surname_first }} {{ $lease->owner->name->surname_second }}
                            </h5>
                            <p class="mb-0 text-dark"><strong>Teléfono:</strong> {{ $lease->owner->phone }}</p>
                            <p class="mb-0 text-dark"><strong>Email:</strong> {{ $lease->owner->email }}</p>
                            <a href="{{ route('users.show', $lease->owner) }}" class="btn btn-secondary text-white btn-lg">
                                Ver Propietario
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.card-body -->
    </div>
</div>
@endsection
