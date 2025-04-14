@extends('layouts.app')

@section('title', 'Editar Alquiler')
@section('page-title', 'Alquileres')

@section('content')
    <h2 class="text-primary">Editar Alquiler</h2>
    @include('leases._form', ['lease' => $lease])
@endsection