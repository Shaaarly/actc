@extends('layouts.app')

@section('title', 'Usuarios')
@section('page-title', 'Usuarios')

@section('content')
<div class="mt-4 mb-4">
    <form action="{{ route('users.create') }}" method="GET">
      @csrf
      <button class="btn btn-success btn-lg text-white" type="submit">Crear Usuario</button>
    </form>
  </div>
  @forelse ($users as $user)
    
    @php
      $leases = $user->leasesAsClient;
      $style = '';

      foreach ($leases as $lease) {
        if($lease->active) {
          $style = 'border-success';
        } else {
          $style = 'border-off';
        }
      }
      

    @endphp

    <div class="card {{ $style }} border-4 mb-3 w-100">
      <div class="row g-0 align-items-center">
        <!-- Imagen del usuario en columna fija (col-auto) -->
        <div class="col-auto">
          <img src="{{ asset($user->profile_image ?? 'images/avatar.png') }}" 
               class="img-fluid rounded-start" 
               alt="{{ $user->email }}"
               style="width: 100px; height: 100px;">
        </div>
        <!-- Información del usuario ocupa el resto del espacio -->
        <div class="col">
          <div class="card-body">
            <h5 class="card-title mb-0">
              @if($user->name)
                {{ $user->name->name }} {{ $user->name->surname_first }} {{ $user->name->surname_second }}
              @else
                {{ $user->email }}
              @endif
            </h5>
            <p class="card-text">
              <small class="text-muted">
                {{ $user->phone }} 
              </small>
            </p>
          </div>
        </div>

        <!-- Botones CRUD -->
        <div class="col d-flex justify-content-end align-items-center">
          <div class="d-flex gap-3 p-4">
              <form action="{{ route('users.show', $user) }}" method="GET">
                  @csrf
                  <button class="btn btn-secondary btn-lg text-white" type="submit">Ver Usuario</button>
              </form>
              <form action="{{ route('users.edit', $user) }}" method="GET">
                  @csrf
                  <button class="btn btn-primary btn-lg text-white" type="submit">Editar Usuario</button>
              </form>
              <form action="{{ route('users.destroy', $user) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-lg" type="submit">Eliminar Usuario</button>
              </form>
          </div>
      </div>
      
          
      </div>
    </div>
  @empty
    <p>No hay usuarios registrados.</p>
  @endforelse
@endsection
