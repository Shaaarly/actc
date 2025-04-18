<div class="card p-4">
    <form action="{{ isset($lease) ? route('leases.update', $lease) : route('leases.store') }}" method="POST">
        @csrf
        @if(isset($lease))
            @method('PUT')
        @endif

        <!-- Primera fila: Cliente, Propietario y Propiedad -->
        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="client" class="form-label">Cliente</label>
                <select name="client" id="client" class="form-select">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client', isset($lease) ? $lease->client_id : '') == $client->id ? 'selected' : '' }}>
                            {{ $client->name->name . ' ' . $client->name->surname_first . ' ' . $client->name->surname_second }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-4">
                <label for="owner" class="form-label">Propietario</label>
                <select name="owner" id="owner" class="form-select">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner', isset($lease) ? $lease->owner_id : '') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name->name . ' ' . $owner->name->surname_first . ' ' . $owner->name->surname_second }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-4">
                <label for="property" class="form-label">Propiedad</label>
                <select name="property" id="property" class="form-select">
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property', isset($lease) ? $lease->property_id : '') == $property->id ? 'selected' : '' }}>
                            {{ $property->address->street_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Segunda fila: Precio y Tipo de pago -->
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="value" class="form-label">Precio</label>
                <input type="number" id="value" name="value" class="form-control" value="{{ old('value', isset($lease) ?$lease->value : '') }}">
            </div>
            <div class="mb-3 col-md-6">
                <label for="payment_type" class="form-label">Tipo de pago</label>
                <select name="payment_type" id="payment_type" class="form-select">
                    @foreach($paymentTypes as $type)
                        <option value="{{ $type->id }}" {{ old('payment_type', isset($lease) ? $lease->payment_type_id : '') == $type->id ? 'selected' : '' }}>
                            {{ $type->payment_type }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Tercera fila: Fecha de inicio y Fecha de finalización -->
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="start_date" class="form-label">Fecha de inicio</label>
                <input type="date" id="start_date" name="start_date" class="form-control" 
                       value="{{ old('start_date', isset($lease) ? $lease->start_lease->format('Y-m-d') : '') }}">
            </div>
            <div class="mb-3 col-md-6">
                <label for="ending_date" class="form-label">Fecha de finalización</label>
                <input type="date" id="ending_date" name="ending_date" class="form-control" 
                       value="{{ old('ending_date', isset($lease) ? $lease->ending_lease->format('Y-m-d') : '') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-lg text-white w-100 p-3">
            {{ isset($lease) ? 'Actualizar alquiler' : 'Dar de alta' }}
        </button>
    </form>
</div>
