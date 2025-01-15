<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Notifications\NotifyCommentCreatorNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyPostAuthor
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $event->comment->post->user->notify(new NotifyCommentCreatorNotification($event->comment));
    }
}
