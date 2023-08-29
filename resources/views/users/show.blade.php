@extends('layout.app')

@section('content')

    

        <div class="row">

            @if ( session()->has('status') )
                <p style="color: green">
                    {{ session()->get("status") }}
                </p>
            @endif

            <div class="col-lg-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="avatar img-thumbnail">

                

            </div>

            

            <div class="col-lg-8">
                <h5> {{ $user->name }} </h5>

                <p>Currently {{ $counter }} user viewing your profile at the moment </p>

                @commentForm(['route' => route('users.comment.store', ['user'=>$user->id])  ])
                @endcommentForm

                @commentList( ['comments' => $user->commentsOn] )
                @endcommentList

            </div>

        </div>

    </form>

@endsection