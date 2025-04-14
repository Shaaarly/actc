@extends('layouts.app')

@section('title', 'Nuevo Alquiler')
@section('page-title', 'Alquileres')

@section('content')
    <h2 class="text-primary">Dar de alta un alquiler</h2>
    @include('leases._form')

@endsection