@extends('layouts.app')

@section('title', 'Recuperar contraseña')
@section('page-title', 'Recuperar contraseña')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="card-title mb-0">Recuperar contraseña</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu email" required autofocus>
                            <label for="email">Introduce tu email</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enviar enlace de recuperación</button>
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
