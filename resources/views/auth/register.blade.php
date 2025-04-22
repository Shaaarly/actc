@extends('layouts.app')

@section('title', 'Registro')
@section('page-title', 'Registro')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center mb-4">
                    <h3 class="card-title mb-0">Registrarse</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="form-floating mb-4 mt-4">
                            <input type="email" name="email" id="email" class="form-control" placeholder=" " required>
                            <label for="email">Introduce tu email</label>
                        </div>

                        {{-- Contraseña --}}
                        <div class="form-floating mb-4 mt-4">
                            <input type="password" name="password" id="password" class="form-control" placeholder=" " required>
                            <label for="password">Introduce tu contraseña</label>
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div class="form-floating mb-4 mt-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder=" " required>
                            <label for="password_confirmation">Repite la contraseña</label>
                        </div>

                        {{-- Botón --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg p-4 text-white">¡Regístrate!</button>
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
