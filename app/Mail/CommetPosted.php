<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CommetPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Comment Posted on {$this->comment->commentable->title} Blog post";
        return $this

            // ->attach(
            // storage_path('app/public') . "/" . $this->comment->user->image->path,
            // [
            //     'as' => 'ProfilePicture.jpeg',
            //     'mime' => 'image/jpeg'
                
            // ]
            // )
                // ->attachFromStorage($this->comment->user->image->path, 'Profile_Picture.jpeg')
                // ->attachFromStorageDisk('public', $this->comment->user->image->path )
                ->attachData( Storage::get($this->comment->user->image->path), 'Profle_picture.jpg', ['mime' => 'image/jpg' ]  )
                ->subject($subject)
                ->view('emails.posts.comment');
    }
}
