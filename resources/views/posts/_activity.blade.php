@card()

@slot('title')
    {{ __('Most Commented') }}
@endslot

@slot('caption')
    {{ __('What people are currently talking about') }}
@endslot

@slot('items')
    <ul class="list-group">

        @foreach ($mostCommented as $post)
        <li class="list-group-item">
            <a class="text-decoration-none" href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>
        </li>    
        
        @endforeach

        
        
    </ul>
@endslot
@endcard


@card( ['margin' => 'mt-3' ] )

@slot('title')
    {{ __('Most Active') }}
@endslot

@slot('caption')
    {{ __('Writers with most posts written') }}
@endslot

@slot('items', $mostWrittenBlogPost->pluck('name') )
@endcard


@card( ['margin' => 'mt-3' ] )

@slot('title')
    {{ __('Most Active Last Month') }}
@endslot

@slot('caption')
    {{ __('Users with most posts written in the month') }}
@endslot

@slot('items', $mostActiveAuthorLastMonth->pluck('name') )
@endcard