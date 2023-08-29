<p>
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tag.index', ['tag'=>$tag->id]) }}" class="badge bg-success text-decoration-none badge-fs"> {{$tag->name}} </a>
    @endforeach
</p>