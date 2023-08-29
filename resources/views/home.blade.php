@extends('layout.app')

@section('content')

    {{-- <h1>Home page</h1> --}}

    <h1>{{ __('messages.welcome') }}</h1>
    <h1>@lang('messages.welcome')</h1>

    {{-- translate with variable --}}
    <p> {{ __('messages.greeting_with_name', [ 'name'=>'emerson' ]) }} </p>

    {{-- translate with depending variable --}}
    <p> {{ trans_choice('messages.comments', 0) }} </p>
    <p> {{ trans_choice('messages.comments', 1) }} </p>
    <p> {{ trans_choice('messages.comments', 2) }} </p>
    

    <p>Translation form json file: {{ __("home page") }} </p>
    <p>Translation form json file: {{ __("greeting :name", ['name'=>'emerson']) }} </p>

@endsection