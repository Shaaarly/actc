@extends('layouts.app')

@section('title', 'Editar Usuario')
@section('page-title', 'Editar usuario: ' . $user->name->name . ' ' . $user->name->surname_first)

@section('content')
    <h2>Editar usuario</h2>
    @include('users._form', ['user' => $user])

@endsection