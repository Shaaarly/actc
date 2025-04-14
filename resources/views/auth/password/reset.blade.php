@extends('layouts.app')

@section('title', 'Recuperar contraseña')
@section('page-title', 'Recuperar contraseña')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="card-title mb-0">Recuperar contraseña</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <!-- Es común usar método PUT/PATCH para la actualización de contraseña -->
                            @method('PUT')

                            <!-- Campo token (oculto) -->
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu email" value="{{ old('email', $email) }}" required>
                                <label for="email">Email</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Nueva contraseña" required>
                                <label for="password">Nueva contraseña</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirma la contraseña" required>
                                <label for="password_confirmation">Confirmar contraseña</label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
                            </div>
                    </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('login') }}">Volver al login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
