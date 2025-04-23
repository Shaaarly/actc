@extends('layouts.app')

@section('title', 'Login')
@section('page-title', 'Login')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="card-title mb-0">Log in</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@dominio.com" required autofocus>
                            <label for="email">Introduce tu email</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                            <label for="password">Introduce tu contraseña</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Acceder!</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    ¿Aún no tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a> |
                    ¿Olvidaste tu contraseña? <a href="{{ route('password.request') }}">Recuperar contraseña</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
