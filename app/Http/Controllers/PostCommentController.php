<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;
use App\Mail\CommetPosted;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Comment as CommentResource;

class PostCommentController extends Controller
{
    //
    

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index( $blogPost){
        $post = BlogPost::findOrFail($blogPost);

        return CommentResource::collection($post->comments()->with('user')->get());

        // return $post->comments()->with('user')->get();
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment =  $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        // Mail::to($post->user)->send( new CommentPostedMarkdown($comment) );
        // Mail::to($post->user)->queue( new CommentPostedMarkdown($comment) );

        event( new EventsCommentPosted($comment));
        $request->session()->flash('status', 'Comment successfully created');
        return redirect()->back();
    }
}
