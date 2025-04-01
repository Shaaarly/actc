<form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name->name ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="surname_first">Primer apellido</label>
        <input type="text" name="surname_first" value="{{ old('surname_first', $user->name->surname_first ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="surname_second">Segundo apellido</label>
        <input type="text" name="surname_second" value="{{ old('surname_second', $user->name->surname_second ?? '') }}" class="form-control">
    </div>

    {{-- Dirección --}}
    <div class="mb-3">
        <label for="street_name">Calle</label>
        <input type="text" name="street_name" value="{{ old('street_name', $user->address->street_name ?? '') }}" class="form-control">
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="postal_code">Código postal</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', $user->address->postal_code ?? '') }}" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label for="province">Provincia</label>
            <input type="text" name="province" value="{{ old('province', $user->address->province ?? '') }}" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label for="city">Ciudad</label>
            <input type="text" name="city" value="{{ old('city', $user->address->city ?? '') }}" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label for="country">Pais</label>
            <input type="text" name="country" value="{{ old('country', $user->address->country ?? '') }}" class="form-control">
        </div>
    </div>

    {{-- Otros campos de dirección --}}
    <div class="row">
        <div class="col">
            <label for="entrance_number">Número</label>
            <input type="text" name="entrance_number" value="{{ old('entrance_number', $user->address->entrance_number ?? '') }}" class="form-control">
        </div>
        <div class="col">
            <label for="apartment_number">Puerta</label>
            <input type="text" name="apartment_number" value="{{ old('apartment_number', $user->address->apartment_number ?? '') }}" class="form-control">
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
    <div class="mb-3">
        <label for="dni">DNI</label>
        <input type="text" name="dni" value="{{ old('dni', $user->dni ?? '') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="email">Correo</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="phone">Teléfono</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control">
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
            <div class="input-group mb-2">
                <input type="text" name="plates[]" class="form-control" value="{{ $plate }}" placeholder="Introduce una matrícula">
            </div>
        @endforeach
    </div>

    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPlateInput()">
        <i class="fa-solid fa-plus"></i> Añadir matrícula
    </button>
</div>

<script>
    function addPlateInput() {
        const container = document.getElementById('plates-container');

        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'plates[]';
        input.className = 'form-control';
        input.placeholder = 'Introduce una matrícula';

        div.appendChild(input);
        container.appendChild(div);
    }
</script>

    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Actualizar usuario' : 'Crear usuario' }}</button>
</form>
