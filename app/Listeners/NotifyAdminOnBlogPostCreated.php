<?php

namespace App\Listeners;

use App\Events\BlogPostCreated;
use App\Jobs\ThrottledMail;
use App\Mail\NotifyAdminPostCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOnBlogPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostCreated $event)
    {
        User::thatIsAdmin()->get()->map( function(User $user){
            ThrottledMail::dispatch( new NotifyAdminPostCreated(), $user );
        } );
    }
}
