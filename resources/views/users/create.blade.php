@extends('layouts.app')

@section('title', 'Crear Usuario')
@section('page-title', 'Usuarios')

@section('content')
    <h2 class="text-primary">Crear usuario</h2>
    @include('users._form')

@endsection