@extends('layout.app')

@section('content')

    <div class="row">

        <div class="col-lg-8">
            @if ( session()->has('status') )
                <p style="color: green">
                    {{ session()->get("status") }}
                </p>
            @endif

            <h1> 
                {{ $post->title }}

                @badge( ['show' => now()->diffInMinutes($post->created_at) < 5, 'type'=>'primary' ] )
                    {{ __('Brand new Post!') }}
                @endbadge

            </h1>

            @if ($post->image)
                <img src="{{$post->image->url()}}" alt="" class=" img-thumbnail" width="100%">
            @endif

            <p>{{ $post->content }}</p>


            @updated( ['date' => $post->created_at, 'name' => $post->user->name] ) 
            @endupdated

            @tag( ['tags' => $post->tags] ) @endtag

            {{ trans_choice('messages.people.reading', $counter) }}

            {{-- @updated( ['date' => $post->updated_at, 'name' => $post->user->name] ) 
            Updated at
            @endupdated --}}
            
            
                

            

            
            <h4>{{ __('Comments') }}</h4>

            
                @commentForm(['route' => route('post.comment.store', ['post'=>$post->id])  ])
                @endcommentForm

                @commentList( ['comments' => $post->comments] )
                @endcommentList

                

        </div>

        <div class="col-lg-4">

            @include('posts._activity')

        </div>

    </div>
    
@endsection