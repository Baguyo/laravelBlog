
@forelse ($comments as $comment)
<p >
    {{ $comment->content }}
</p>

@updated( ['date' => $comment->created_at, 'name' => $comment->user->name] ) 
@tag( ['tags' => $comment->tags] ) @endtag
@endupdated

@empty
<p></p>
@endforelse