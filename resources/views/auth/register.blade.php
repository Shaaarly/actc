@extends('layouts.app')

@section('title', 'Registro')
@section('page-title', 'Registro')

@section('content')
<div class="auth-card">
    <h3 class="text-center text-primary card-title">Crear cuenta</h3>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            <label for="email">Email</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            <label for="password">Contraseña</label>
        </div>

        <div class="form-floating mb-4">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repite contraseña" required>
            <label for="password_confirmation">Confirmar contraseña</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary p-4 w-100">Registrarse</button>
        </div>
    </form>

    <div class="card-footer text-center">
        ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
    </div>
</div>
@endsection
