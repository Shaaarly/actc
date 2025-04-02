@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
    <h2 class="text-primary">Crear usuario</h2>
    @include('users._form')

@endsection