@extends('users.layouts.settings')

@section('settings-content')
    <h4 class="mb-4 mt-4 text-dark">Información General</h4>
    <h5 class="text-muted mb-4">Actualiza tus datos personales</h5>

    {{-- Actualizar nombre y apellidos --}}
    <div class="card p-4">
            <form action="{{ route('profile.update') }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name->name ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="surname_first" class="form-label">Primer apellido</label>
                        <input type="text" name="surname_first" class="form-control" value="{{ old('surname_first', $user->name->surname_first ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="surname_second" class="form-label">Segundo apellido</label>
                        <input type="text" name="surname_second" class="form-control" value="{{ old('surname_second', $user->name->surname_second ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni', $user->dni) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg p-4 w-100 text-white">Guardar cambios</button>
            </form>
        </div>
    {{-- Dirección del usuario --}}
    <hr>

    <div class="card p-4">


        <h5 class="mb-3 text-primary">Dirección</h5>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="country" class="form-label">País</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $user->address->country ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label for="province" class="form-label">Provincia</label>
                    <input type="text" name="province" class="form-control" value="{{ old('province', $user->address->province ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $user->address->city ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="postal_code" class="form-label">Código postal</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->address->postal_code ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label for="street_name" class="form-label">Calle</label>
                    <input type="text" name="street_name" class="form-control" value="{{ old('street_name', $user->address->street_name ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label for="passageway" class="form-label">Pasage</label>
                    <input type="text" name="passageway" class="form-control" value="{{ old('passageway', $user->address->passageway ?? '') }}">
                </div>
                <div class="col-md-1">
                    <label for="building_number" class="form-label">Número</label>
                    <input type="text" name="building_number" class="form-control" value="{{ old('building_number', $user->address->building_number ?? '') }}">
                </div>
                <div class="col-md-1">
                    <label for="block" class="form-label">Bloque</label>
                    <input type="text" name="block" class="form-control" value="{{ old('block', $user->address->block ?? '') }}">
                </div>
                <div class="col-md-1">
                    <label for="floor" class="form-label">Piso</label>
                    <input type="text" name="floor" class="form-control" value="{{ old('floor', $user->address->floor ?? '') }}">
                </div>
                <div class="col-md-1">
                    <label for="number" class="form-label">Puerta</label>
                    <input type="text" name="number" class="form-control" value="{{ old('number', $user->address->number ?? '') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-secondary btn-lg p-4 w-100 text-white">Actualizar dirección</button>
        </form>
    </div>
@endsection
