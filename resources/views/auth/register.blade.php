{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('layout.app')

    @section('content')
    {{-- <x-jet-validation-errors class="mb-3" /> --}}

    <div class="card mt-5 shadow col-lg-6 mx-auto">
      
      <div class="card-body">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
              <label for="" class="form-label">Name</label>
              <input type="text" name="name" id="" class="form-control {{$errors->has('name') ? 'is-invalid' : " "}} " placeholder="" value="{{old('name')}}">
    
              @if ($errors->has('name'))
                  <div class="invalid-feedback">
                      <span>
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  </div>
              @endif
    
            </div>
    
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
    
              <div class="mb-3">
                <label for="" class="form-label">Retype password</label>
                <input type="password" name="password_confirmation" id="" class="form-control" placeholder="">
              </div>
    
              <button type="submit" class="btn btn-primary text-white">Submit</button>
        </form>    
      </div>
    </div>
    
    @endsection

    