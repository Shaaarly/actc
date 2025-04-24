@extends('users.layouts.settings')

@section('settings-content')
    @includeIf('users.tabs.' . $tab, compact('user', 'sessions'))
@endsection
