<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<p>
    Hi! {{$comment->commentable->user->name}}
</p>

<p>
    New Comment posted on your blog post 
    <a href="{{ route('posts.show', ['post'=>$comment->commentable->id]) }}"> {{ $comment->commentable->title }} </a>
</p>

<hr>

<p>
    <img src="{{ $message->embed($comment->user->image->url()) }}" alt="" width="168px" height="168px">
    <a href="{{ route('users.show', ['user'=>$comment->user->id]) }}"> {{ $comment->user->name }} </a>
</p>

<p>
    Said: {{ $comment->content }}
</p>