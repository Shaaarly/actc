<div class="card p-4">
    <form action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}" method="POST">
        @csrf
        @if(isset($property))
            @method('PUT')
        @endif
    
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="property_type_id" class="form-label">Selecciona el tipo de propiedad</label>
                <select name="property_type_id" id="property_type_id" class="form-select">
                    <option value="" disabled {{ old('property_type_id', isset($property) ? $property->property_type_id : '') == '' ? 'selected' : '' }}>
                        Seleccione un tipo
                    </option>
                    @foreach ($propertyTypes as $type)
                        <option value="{{ $type->id }}"
                            {{ old('property_type_id', isset($property) ? $property->property_type_id : '') == $type->id ? 'selected' : '' }}>
                            {{ $type->property_type }}
                        </option>
                    @endforeach
                </select>
            </div>
                      
        

            <div class="mb-3 col-md-6">
                <label class="form-label">Selecciona los propietarios</label>
                @php
                    $selectedOwners = old('owners', isset($property) ? $property->owners->pluck('id')->toArray() : ['']);
                    
                @endphp
                <div>
                    @foreach ($propertyOwners as $owner)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="owners[]" id="owner_{{ $owner->id }}" value="{{ $owner->id }}"
                                {{ in_array($owner->id, $selectedOwners) ? 'checked' : '' }}>
                            <label class="form-check-label" for="owner_{{ $owner->id }}">
                                {{ $owner->name->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                
            </div>

        </div>

        <hr>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="area" class="form-label">Area</label>
                <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="price" class="form-label">Precio</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $property->price ?? '') }}" required>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="remote" class="form-label">Mando</label>
                <select name="remote" id="remote" class="form-select" required>
                    <option disabled {{ !isset($property->remote) ? 'selected' : '' }}>Seleccione una opción</option>
                    <option value="1" {{ isset($property->remote) ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ !isset($property->remote) ? 'selected' : '' }}>No</option>
                </select>
                
            </div>
            <div class="mb-3 col-md-6">
                <label for="keys" class="form-label">Llaves</label>
                <select name="keys" id="keys" class="form-select" required>
                    <option disabled {{ !isset($property->keys) ? 'selected' : '' }}>Seleccione una opción</option>
                    <option value="1" {{ isset($property->keys) ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ !isset($property->keys) ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="available" class="form-label">Disponible</label>
                <select name="available" id="available" class="form-select" required>
                    <option disabled {{ !isset($property->available) ? 'selected' : '' }}>Seleccione una opción</option>
                    <option value="1" {{ isset($property->available) ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ !isset($property->available) ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="ocupied" class="form-label">Ocupada</label>
                <select name="ocupied" id="ocupied" class="form-select" required>
                    <option disabled {{ !isset($property->ocupied) ? 'selected' : '' }}>Seleccione una opción</option>
                    <option value="1" {{ isset($property->ocupied) ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ !isset($property->ocupied) ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <hr>
        {{-- Dirección --}}
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="country">Pais</label>
                <input type="text" name="country" value="{{ old('country', $property->address->country ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="province">Provincia</label>
                <input type="text" name="province" value="{{ old('province', $property->address->province ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="city">Ciudad</label>
                <input type="text" name="city" value="{{ old('city', $property->address->city ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="postal_code">Código postal</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $property->address->postal_code ?? '') }}" class="form-control" required>
            </div>
        </div>
    
        {{-- Otros campos de dirección --}}
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="street_name">Calle</label>
                <input type="text" name="street_name" value="{{ old('street_name', $property->address->street_name ?? '') }}" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="passageway">Passage</label>
                <input type="text" name="passageway" value="{{ old('passageway', $property->address->passageway ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="entrance_number">Número</label>
                <input type="text" name="entrance_number" value="{{ old('entrance_number', $property->address->entrance_number ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="apartment_number">Puerta</label>
                <input type="text" name="apartment_number" value="{{ old('apartment_number', $property->address->apartment_number ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="floor">Piso</label>
                <input type="text" name="floor" value="{{ old('floor', $property->address->floor ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="block">Bloque</label>
                <input type="text" name="block" value="{{ old('block', $property->address->block ?? '') }}" class="form-control">
            </div>
        </div>
    
        <hr>
    
        <div id="extraGarageTrasteroFields" style="display: none;">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="letter" class="form-label">Letra</label>
                    <input type="text" name="letter" id="letter" class="form-control" value="{{ old('letter', $property->letter ?? '') }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{ old('number', $property->number ?? '') }}">
                </div>
            </div>
        </div>
        
        <div id="extraLocalPisoFields" style="display: none;">
            <div class="row">
            <!-- Contenedor para local comercial o piso -->
                <div class="mb-3 col-md-6">
                    <label for="bathrooms" class="form-label">Baños</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms ?? '') }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="rooms" class="form-label">Habitaciones</label>
                    <input type="number" name="rooms" id="rooms" class="form-control" value="{{ old('rooms', $property->rooms ?? '') }}">
                </div>
            </div>
        </div>
        
    
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $property->description ?? '') }}</textarea>
        </div>
    
    
    
        <button type="submit" class="btn btn-primary text-light">{{ isset($property) ? 'Actualizar propiedad' : 'Crear propiedad' }}</button>
    </form>
</div>      


