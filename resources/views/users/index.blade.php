@extends('layouts.app')

@section('title', 'Usuarios')
@section('page-title', 'Usuarios')

@section('content')
<div class="mt-4 mb-4">
    <form action="{{ route('users.create') }}" method="GET">
      @csrf
      <button class="btn btn-success btn-lg" type="submit">Crear Usuario</button>
    </form>
  </div>
  @forelse ($users as $user)
    <div class="card mb-3 w-100">
      <div class="row g-0 align-items-center">
        <!-- Imagen del usuario en columna fija (col-auto) -->
        <div class="col-auto">
          <img src="{{ asset($user->profile_image ?? 'images/default-user.jpg') }}" 
               class="img-fluid rounded-start" 
               alt="{{ $user->name->name }}"
               style="width: 100px; height: 100px;">
        </div>
        <!-- Información del usuario ocupa el resto del espacio -->
        <div class="col">
          <div class="card-body">
            <h5 class="card-title mb-0">
              {{ $user->name->name }} {{ $user->name->surname_first }} {{ $user->name->surname_second }}
            </h5>
            <p class="card-text"><small class="text-muted">{{ $user->dni }}</small></p>
          </div>
        </div>
        <div class="col-auto">
            <div class="d-grid gap-2">
                <form action="{{ route('users.show', $user) }}" method="GET">
                    @csrf
                    <button class="btn btn-info btn-lg w-100 " type="submit">Ver Usuario</button>
                    </form>
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary btn-lg w-100" type="submit">Editar Usuario</button>
                </form>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-lg w-100" type="submit">Eliminar Usuario</button>
                </form>
            </div>
          </div>
          
      </div>
    </div>
  @empty
    <p>No hay usuarios registrados.</p>
  @endforelse
@endsection
