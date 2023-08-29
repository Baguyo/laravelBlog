@extends('layout.app')

@section('content')
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">

        @include('posts._form')

    </form>
@endsection