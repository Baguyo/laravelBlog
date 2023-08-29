@extends('layout.app')

@section('content')

          @if ( session()->has('status') )
                <p style="color: green">
                    {{ session()->get("status") }}
                </p>
            @endif

    <form action="{{ route('users.update', ['user'=>$user->id]) }}" method="post" class="form-row" enctype="multipart/form-data">
        
        @method('PUT')
        @csrf

        <div class="row">

            <div class="col-lg-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="avatar img-thumbnail">

                <div class="card ">
                  <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Upload new avatar</label>
                        <input type="file" class="form-control" name="avatar" id="" placeholder="" >
                      </div>
                  </div>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="mb-3">
                  <label for="" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                </div>

                <div class="mb-3">
                  <label for="" class="form-label">{{ __('Language') }}</label>
                  <select class="form-control" name="locale" id="">
                        @foreach(App\Models\User::LOCALES as $locale => $label)
                            <option value="{{ $locale }}" {{ $user->locale !== $locale ? : "selected"; }} > {{ $label }} </option>
                        @endforeach
                  </select>
                </div>

                @errors @enderrors

                <input type="submit" value="Submit" name="submit" class="btn btn-primary text-white">

            </div>

        </div>

    </form>

@endsection