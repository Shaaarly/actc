@extends('layouts.app')

@section('title', 'Propiedades')
@section('page-title', 'Propiedades')

@section('content')

    <div class="mt-4 mb-4">
        <form action="{{ route('properties.create') }}" method="GET">
        @csrf
        <button class="btn btn-success btn-lg text-white" type="submit">Dar de alta una propiedad</button>
        </form>
    </div>

    @foreach($groupedProperties as $typeName => $properties)
        <h3 class="text-primary mt-4 pt-4">{{ $typeName }}</h3>
        @forelse ($properties as $property)
            <div class="card border-primary mb-3 w-100">
                <div class="row g-0 align-items-center">
                <!-- Imagen de la propiedad en columna fija -->
                    <div class="col-auto">
                    <img src="{{ asset($property->profile_image ?? 'images/property.jpg') }}" 
                        class="img-fluid rounded-start" 
                        alt="Imagen de propiedad"
                        style="width: 100px; height: 100px;">
                    </div>
                <!-- Información de la propiedad -->
                    <div class="col">
                        <div class="card-body">
                            @if($property->ocupied === 1)
                            <p class="card-text"><small class="text-danger">Ocupado</small></p>
                            @else
                            <p class="card-text"><small class="text-success">Libre</small></p>
                            @endif
                            <h5 class="card-title mb-0">
                                @if($property->address)
                                    {{ $property->address->street_name }}
                                @else
                                    <span>Dirección no disponible</span>
                                @endif
                            </h5>
                        </div>
                    </div>

                <!-- Botones CRUD -->
                <div class="col d-flex justify-content-end align-items-center">
                    <div class="d-flex gap-3 p-4">
                        <form action="{{ route('properties.show', $property) }}" method="GET">
                            @csrf
                            <button class="btn btn-secondary btn-lg text-white" type="submit">Ver Propiedad</button>
                        </form>
                        <form action="{{ route('properties.edit', $property) }}" method="GET">
                            @csrf
                            <button class="btn btn-primary btn-lg text-white" type="submit">Editar Propiedad</button>
                        </form>
                        <form action="{{ route('properties.destroy', $property) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-lg" type="submit">Eliminar Propiedad</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>No hay propiedades registradas.</p>
        @endforelse
    @endforeach
@endsection
