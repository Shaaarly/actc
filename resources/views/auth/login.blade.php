@extends('layouts.app')

@section('title', 'Login')
@section('page-title', 'Login')

@section('content')
<div class="auth-card">
    <h3 class="text-center text-primary card-title">Inicia sesión</h3>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@dominio.com" required autofocus>
            <label for="email">Email</label>
        </div>
        
        <div class="form-floating mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            <label for="password">Contraseña</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary p-4 w-100">Entrar</button>
        </div>
    </form>

    <div class="card-footer text-center">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a> <br>
        ¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}">Recupérala aquí</a>
    </div>
</div>
@endsection
