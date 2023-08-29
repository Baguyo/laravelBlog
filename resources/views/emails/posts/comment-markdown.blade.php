@component('mail::message')
# New Comment Posted in your Blog post

Hi! {{ $comment->commentable->user->name }}

@component('mail::button', ['url' => route('posts.show', ['post'=> $comment->commentable->id ])])
Visit Blog post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user'=> $comment->user->id ])])
Visit {{ $comment->user->name }} Profile
@endcomponent

@component('mail::panel')
{{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
