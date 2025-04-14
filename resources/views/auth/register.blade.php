@extends('layouts.app')

@section('title', 'Registro')
@section('page-title', 'Registro')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
             <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="card-title mb-0">Registrarse</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@dominio.com" required>
                            <label for="email">Introduce tu email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                            <label for="password">Introduce tu contraseña</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                            <label for="password_confirmation">Vuelve a introducir tu contraseña</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">¡Regístrate!</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
