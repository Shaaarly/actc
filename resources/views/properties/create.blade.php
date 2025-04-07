@extends('layouts.app')

@section('title', 'Crear Propiedad')
@section('page-title', 'Propiedades')

@section('content')
    <h2 class="text-primary">Crear propiedad</h2>
    @include('properties._form')

@endsection