<div class="row g-4 align-items-end justify-content-cneter w-100">

    {{-- Tipo de Propiedad --}}
    <div class="col-md-2">
        <label for="property_type_id" class="form-label">Tipo de Propiedad:</label>
        <select name="property_type_id" id="property_type_id" class="form-select">
            <option value="">Todos</option>
            @foreach($propertyTypes as $type)
                <option value="{{ $type->id }}" {{ request('property_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->property_type }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Estado del alquiler --}}
    <div class="col-md-2">
        <label for="active" class="form-label">Estado:</label>
        <select name="active" id="active" class="form-select">
            <option value="">Todos</option>
            <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Activos</option>
            <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Finalizados</option>
        </select>
    </div>

    {{-- Cliente (oculto si ya está seleccionado fijo desde el perfil) --}}
    @if(!isset($fixedClientId))
        <div class="col-md-2">
            <label for="client_id" class="form-label">Cliente:</label>
            <select name="client_id" id="client_id" class="form-select">
                <option value="">Todos</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name->name }} {{ $client->name->surname_first }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <input type="hidden" name="client_id" value="{{ $fixedClientId }}">
    @endif

    {{-- Ordenar por --}}
    <div class="col-md-2">
        <label for="sort_by" class="form-label">Ordenar por:</label>
        <select name="sort_by" id="sort_by" class="form-select">
            <option value="">Sin orden</option>
            <option value="start_lease_asc" {{ request('sort_by') == 'start_lease_asc' ? 'selected' : '' }}>Inicio (Asc)</option>
            <option value="start_lease_desc" {{ request('sort_by') == 'start_lease_desc' ? 'selected' : '' }}>Inicio (Desc)</option>
            <option value="ending_lease_asc" {{ request('sort_by') == 'ending_lease_asc' ? 'selected' : '' }}>Fin (Asc)</option>
            <option value="ending_lease_desc" {{ request('sort_by') == 'ending_lease_desc' ? 'selected' : '' }}>Fin (Desc)</option>
        </select>
    </div>

    {{-- Botones --}}
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary btn-lg w-100 text-white p-4">Aplicar</button>
    </div>

    <div class="col-md-12 text-end">
        <a href="{{ route('leases.create') }}" class="btn btn-success btn-lg w-100 p-4 text-white">
            Nuevo Alquiler
        </a>
    </div>

</div>
