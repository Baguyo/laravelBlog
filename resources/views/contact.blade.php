@extends('layout.app')

@section('content')
    <h1>Contact page</h1>

    @can('home.secret')
        <a href="{{ route('secret') }}">Secret page for admin</a>
    @endcan

@endsection