@extends('layout.app')

@section('content')

    <div class="row">

        
        <div class="col-lg-8">

                    @if (session()->has('status'))
                        <p style="color: green">{{session()->get('status')}}</p> 
                    @endif
            
                @forelse ($posts as $post)

                    @if ($post->trashed())
                        <del>
                    @endif
                        <h1>
                            <a class="{{ ($post->trashed() ? 'text-muted' : "") }}" href="{{ route('posts.show', ['post'=>$post->id]) }}">{{$post->title}}</a>
                        </h1>
                    @if ($post->trashed())
                        </del>
                    @endif

                    
                    {{-- <p class="text-muted">
                        Created  {{ $post->created_at->diffForHumans() }}
                        By {{$post->user->name}}
                    </p> --}}
                
                    @updated( ['date' => $post->created_at, 'name' => $post->user->name, 'userID' => $post->user->id ]) @endupdated

                    @tag( ['tags' => $post->tags] ) @endtag

            
                    <p class="text-muted">
                        <p> {{ trans_choice('messages.comments', $post->comments_count) }} </p>
                    </p>
            
                    <p>
            
                        @auth
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', ['post'=>$post->id]) }}" class="btn btn-success text-white">{{ __('Edit') }}</a>
                                @endcan    
                        @endauth

                        
                        @auth
                                @if (! $post->trashed())
                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', ['post'=>$post->id]) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" name="delete" id="" value="{{ __('Delete!') }}"  class="btn btn-danger text-white">
                                        </form>    
                                    @endcan    
                                @endif    
                                
                        @endauth

                        

                        
            
                        {{-- @cannot('update', $post)
                            <h3>Unathoriza to perform actions</h3>
                        @endcannot --}}
            
                        
                    </p>
                @empty
                    <h1>{{ __('No blog posts yet!') }}</h1>
                @endforelse
    

        </div>

        <div class="col-lg-4">

            {{-- <div class="card border">
              
              <div class="card-body">
                <h4 class="card-title">Most Commented Post</h4>
                <p class="card-text">Post that most people are talking about</p>

                    <ul class="nav flex-column">

                        @foreach ($mostCommented as $post)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>
                        </li>    
                        
                        @endforeach

                        
                        
                    </ul>

              </div>
            </div> --}}

            
           @include('posts._activity')

            

            {{-- <div class="card border mt-3">
              
                <div class="card-body">
                  <h4 class="card-title">Most active Author</h4>
                  <p class="card-text">Author with most posts written</p>
  
                      <ul class="nav flex-column">
  
                          @foreach ($mostWrittenBlogPost as $user)
                          <li class="nav-item">
                              <a class="nav-link active" href="#">{{ $user->name }}</a>
                          </li>    
                          
                          @endforeach
  
                          
                          
                      </ul>
  
                </div>
            </div> --}}

              {{-- <div class="card border mt-3">
              
                <div class="card-body">
                  <h4 class="card-title">Most active Author last month</h4>
                  <p class="card-text">Author with most posts written last month</p>
  
                      <ul class="nav flex-column">
  
                          @foreach ($mostActiveAuthorLastMonth as $user)
                          <li class="nav-item">
                              <a class="nav-link active" href="#">{{ $user->name }}</a>
                          </li>    
                          
                          @endforeach
  
                          
                          
                      </ul>
  
                </div>
              </div> --}}



        </div>

        

    </div>

    
@endsection