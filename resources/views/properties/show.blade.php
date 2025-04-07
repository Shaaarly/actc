@extends('layouts.app')

@section('title', 'Propiedad')
@section('page-title', 'Datos de la propiedad')

@section('content')

    <div class="card">
        <div class="card-body">
            <h3 class="card-title mt-4 ms-3 text-primary">
                {{ $property->type->property_type }}
                @if($property->type->property_type == 'Trastero' || $property->type->property_type == 'Garage')
                {{ $property->letter }}{{ $property->number }}
                @endif
            </h3>
            <div class="d-flex align-items-center">
                <div id="carouselProperty{{ $property->id }}" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach($property->pictures as $index => $picture)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                          <img src="{{ asset('storage/' . $picture->source) }}" class="d-block w-100" alt="Imagen de propiedad">
                        </div>
                      @endforeach
                        <img src="{{ asset('images/property.jpg') }}" class="d-block w-100" alt="Imagen de propiedad">
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>


            <hr>

            <div class="mb-3 col-md-6">
                <label class="form-label">Propietario/s</label>
                <div>
                    @foreach($property->owners as $owner)
                        <span class="badge bg-primary">
                            {{ $owner->name->name }}
                            {{ $owner->name->surname_first }}
                            {{ $owner->name->surname_second }}
                        </span>
                    @endforeach
                </div>
            </div>
            
            <hr>

            <ul class="list-group list-group-flush">
                <li class="list-group-item text-dark"><strong>País:</strong> {{ $property->address->country }}</li>
                <li class="list-group-item text-dark"><strong>Provincia:</strong> {{ $property->address->province }}</li>
                <li class="list-group-item text-dark"><strong>Ciudad:</strong> {{ $property->address->city }}</li>

                {{-- Direccion completa--}}
                @php
                    $direccion = $property->address->street_name . ', ';
                    $direccion .= $property->address->postal_code;
                    if ($property->address?->passageway) {
                        $direccion .= ', pasage: ' . $property->address->passageway;
                    }
                    $direccion .= $property->address->entrance_number;
                    if ($property->address?->block) {
                        $direccion .= ', bloque: ' . $property->address->block;
                    }
                    if($property->type->property_type == 'Piso' || $property->type->property_type == 'Local Comercial') {
                        $direccion .= ', Iden: ' . $property->address->floor . ', puerta: ' . $property->address->apartment_number;
                    }
                @endphp
                <li class="list-group-item text-dark">
                    <strong>Dirección:</strong> {{ $direccion }}
                </li>                            
                <li class="list-group-item text-dark">
                    <strong>Area:</strong> {{ $property->area }}
                </li>                
                <li class="list-group-item text-dark">
                    <strong>Precio:</strong> {{ $property->price }}
                </li>                
                @if($property->ocupied === 1)
                    <li class="list-group-item text-dark">
                        <strong>Ocupado</strong>
                        Esta propiedad esta ocupada actualmente
                    </li>   
                @else 
                    <li class="list-group-item text-dark">
                        <strong>Ocupado</strong> 
                        Esta propiedad no esta ocupada actualmente
                    </li>   
                @endif
                @if($property->available === 1)             
                    <li class="list-group-item text-dark">
                        <strong>Disponible</strong>
                        Esta propiedad está disponible para alquilar
                    </li>  
                @else
                    <li class="list-group-item text-dark">
                        <strong>Disponible</strong>
                        Esta propiedad no está disponible para alquilar
                    </li>  
                @endif  
                @if($property->keys === 1)
                    <li class="list-group-item text-dark">
                        <strong>Llaves</strong> 
                        Esta propiedad tiene llaves
                    </li>  
                @else
                    <li class="list-group-item text-dark">
                        <strong>Llaves</strong> 
                        Esta propiedad no tiene llaves
                    </li>  
                @endif 
                   
                @if($property->type->property_type == 'Trastero' || $property->type->property_type == 'Garage')  
                    @if($property->remote === 1)
                        <li class="list-group-item text-dark">
                            <strong>Mando</strong> 
                            Esta propiedad tiene un mando
                        </li>  
                    @else
                        <li class="list-group-item text-dark">
                            <strong>Mando</strong> 
                            Esta propiedad no tiene mando
                        </li>  
                    @endif
                @else
                    <li class="list-group-item text-dark">
                        <strong>Habitaciones:</strong> {{ $property->rooms }}
                    </li>  
                    <li class="list-group-item text-dark">
                        <strong>Baños:</strong> {{ $property->bathrooms }}
                    </li>  
                @endif

                <li class="list-group-item text-dark">
                    <strong>Descripción:</strong> 
                    {{ $property->description }}
                </li>  
            </ul>
            
        </div>
    </div>
    

@endsection

