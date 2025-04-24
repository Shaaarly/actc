@extends('layouts.app')

@section('title', 'Nueva contraseña')
@section('page-title', 'Nueva contraseña')

@section('content')
<div class="auth-card">
    <h3 class="text-center text-primary card-title">Cambia tu contraseña</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        {{-- Token --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

        <div class="form-floating mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva contraseña" required>
            <label for="password">Nueva contraseña</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
            <label for="password_confirmation">Confirmar contraseña</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary p-4 w-100">Guardar contraseña</button>
        </div>
    </form>
</div>
@endsection
