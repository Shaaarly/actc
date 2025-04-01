@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
    <h2>Crear usuario</h2>
    @include('users._form')

@endsection