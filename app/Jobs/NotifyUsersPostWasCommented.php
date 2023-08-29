<?php

namespace App\Jobs;

use App\Mail\CommentPostedOntPostWatch;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUsersPostWasCommented implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        User::thatHasCommentedOnBlogPost($this->comment->commentable)
            ->get()
            ->filter(function( User $user ){
                return $user->id !== $this->comment->user_id;
            })
            ->map( function( User $user){

                ThrottledMail::dispatch(  new CommentPostedOntPostWatch($this->comment, $user), $user );

                // Mail::to($user)->send(
                //     new CommentPostedOntPostWatch($this->comment, $user)
                // );

            } );
        
    }
}
