@extends('users.layouts.settings')

@section('settings-content')
<h4 class="mb-4 mt-4 text-dark">Seguridad</h4>
<h5 class="text-muted mb-4">Configura tus preferencias de seguridad</h5>

{{-- ✅ Cambiar contraseña directamente --}}
@if (session('status') === 'password-updated')
    <div class="alert alert-success">
        Contraseña actualizada correctamente.
    </div>
@endif

@if ($errors->updatePassword->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->updatePassword->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card mb-4">
    <div class="card-header fw-bold">
        Cambiar contraseña
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="current_password" class="form-label">Contraseña actual</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-outline-primary btn-lg">Actualizar contraseña</button>
        </form>
    </div>
</div>


{{-- ✅ Cambiar email --}}
<div class="card mb-4">
    <div class="card-header fw-bold">
        Cambiar correo electrónico
    </div>
    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="email" class="form-label">Nuevo correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ auth()->user()->email }}" required>
            </div>
            <button type="submit" class="btn btn-lg btn-outline-primary">Actualizar email</button>
        </form>
    </div>
</div>

{{-- ✅ Sesiones activas --}}
<div class="card mb-4">
    <div class="card-header fw-bold">
        Sesiones activas
    </div>
    <div class="card-body">
        @forelse($sessions as $session)
            <div class="d-flex justify-content-between align-items-center border p-2 rounded mb-3">
                <div>
                    <div><strong>Dispositivo:</strong> {{ Str::limit($session->user_agent, 60) }}</div>
                    <small class="text-muted">Última actividad: {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</small>
                </div>
                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-lg btn-danger me-4">Cerrar</button>
                </form>
            </div>
        @empty
            <p class="text-muted">No hay otras sesiones activas.</p>
        @endforelse
    </div>
</div>

{{-- ✅ 2FA --}}
<div class="card">
    <div class="card-header fw-bold">
        Autenticación en dos pasos (2FA)
    </div>
    <div class="card-body">
        @if (!auth()->user()->two_factor_secret)
            <p class="text-dark">Activa la autenticación en dos pasos para añadir una capa extra de seguridad a tu cuenta.</p>
            <a href="{{ route('two-factor.setup') }}" class="btn btn-lg btn-success text-white mb-2">Activar 2FA</a>
        @else
            <p class="text-success">La autenticación en dos pasos está <strong>activada</strong>.</p>
        @endif
    </div>
</div>

{{-- ❌ Eliminar cuenta --}}
<div class="card mt-5">
    <div class="card-header text-dark fw-bold">
        Eliminar cuenta
    </div>
    <div class="card-body">
        <p class="text-dark">Una vez que elimines tu cuenta, todos tus datos serán borrados de forma permanente y no se podrán recuperar.</p>

        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta permanentemente? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-lg btn-danger mb-2">Eliminar cuenta</button>
        </form>
    </div>
</div>

@endsection
