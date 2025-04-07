@extends('layouts.app')

@section('title', 'Editar Propiedad')
@section('page-title', 'Propiedades')

@section('content')
    <h2 class="text-primary">Editar propiedad</h2>
    @include('properties._form', ['property' => $property])

@endsection