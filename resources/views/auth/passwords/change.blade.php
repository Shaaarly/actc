@extends('layouts.app')

@section('title', 'Recuperar contraseña')
@section('page-title', 'Recuperar contraseña')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="card-title mb-0">Cambiar contraseña</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
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
                        <a href="{{ route('users.show') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
