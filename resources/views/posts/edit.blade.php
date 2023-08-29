@extends('layout.app')

@section('content')
    <form action="{{ route('posts.update', ["post" => $post->id]) }}" method="post" enctype="multipart/form-data">


        @method("PUT")

        
        @include('posts._form')
        

    </form>
@endsection