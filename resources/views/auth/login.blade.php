{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('layout.app')

@section('content')
    <div class="card mt-5 shadow col-lg-6 mx-auto">
      
      <div class="card-body">
        <form action="{{ route('login') }}" method="post">
            
            @csrf
            
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" id="" class="form-control {{$errors->has('email') ? 'is-invalid' : " "}}" placeholder=""  value="{{old('email')}}">

                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <span>
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    </div>
                @endif

                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" id="" class="form-control {{$errors->has('password') ? 'is-invalid' : " "}}" placeholder="" >

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <span>
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </div>
                    @endif
                </div>

                {{-- <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="custom-control-label" for="remember_me">
                            Remember Me
                        </label>
                    </div>
                </div> --}}

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <button type="submit" name="submit" class=" text-white btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
@endsection