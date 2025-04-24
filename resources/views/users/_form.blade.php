<div class="card container p-4">
    @php
        $formAction = $isProfile ?? false
            ? route('profile.update')
            : (isset($user) ? route('users.update', $user) : route('users.store'));
    @endphp

    <form action="{{ $formAction }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
    
        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name->name ?? '') }}" class="form-control" required>
            </div>
        
            <div class="mb-3 col-md-3">
                <label for="surname_first">Primer apellido</label>
                <input type="text" name="surname_first" value="{{ old('surname_first', $user->name->surname_first ?? '') }}" class="form-control" required>
            </div>
        
            <div class="mb-3 col-md-3">
                <label for="surname_second">Segundo apellido</label>
                <input type="text" name="surname_second" value="{{ old('surname_second', $user->name->surname_second ?? '') }}" class="form-control">
            </div>
            <div class="mb-3 col-md-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $user->dni ?? '') }}" class="form-control">
            </div>
        </div>
    
        {{-- Dirección --}}
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="country">Pais</label>
                <input type="text" name="country" value="{{ old('country', $user->address->country ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="province">Provincia</label>
                <input type="text" name="province" value="{{ old('province', $user->address->province ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="city">Ciudad</label>
                <input type="text" name="city" value="{{ old('city', $user->address->city ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="postal_code">Código postal</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $user->address->postal_code ?? '') }}" class="form-control">
            </div>
        </div>
    
        {{-- Otros campos de dirección --}}
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="street_name">Calle</label>
                <input type="text" name="street_name" value="{{ old('street_name', $user->address->street_name ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label for="passageway">Passage</label>
                <input type="text" name="passageway" value="{{ old('passageway', $user->address->passageway ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="building_number">Número</label>
                <input type="text" name="building_number" value="{{ old('building_number', $user->address->building_number ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="number">Puerta</label>
                <input type="text" name="number" value="{{ old('number', $user->address->number ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="floor">Piso</label>
                <input type="text" name="floor" value="{{ old('floor', $user->address->floor ?? '') }}" class="form-control">
            </div>
            <div class="col">
                <label for="block">Bloque</label>
                <input type="text" name="block" value="{{ old('block', $user->address->block ?? '') }}" class="form-control">
            </div>
        </div>
    
        <hr>
    
        {{-- Otros datos del usuario --}}
        <div class="row">
            <div class="mb-4 col-md-6">
                <label for="email">Correo</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control">
            </div>
        
            <div class="mb-4 col-md-6">
                <label for="phone">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control">
            </div>
        </div>
    
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $user->description ?? '') }}</textarea>
        </div>
    
        {{-- Contraseña solo si es creación --}}
        @if(!isset($user))
        <div class="mb-3">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        @endif
    
        {{-- Matrículas (si permite varias) --}}
        <div class="mb-3">
        <label for="plates[]">Matrículas</label>
    
        <div id="plates-container">
            @php
                $plates = old('plates', isset($user) ? $user->plates->pluck('plate')->toArray() : ['']);
            @endphp
    
            @foreach ($plates as $plate)
                <div class="input-group mb-3">
                    <input type="text" name="plates[]" class="form-control" value="{{ $plate }}" placeholder="Introduce una matrícula">
                </div>
            @endforeach
        </div>
    
        <button type="button" class="btn btn-md btn-outline-primary" onclick="addPlateInput()">
            <i class="fa-solid fa-plus"></i> Añadir matrícula
        </button>
    </div>
    
    
    <button type="submit" class="text-light btn btn-success btn-lg">
        {{ isset($user) ? 'Actualizar usuario' : 'Crear usuario' }}
    </button>
</div>
</form>


