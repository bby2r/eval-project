<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostCreatedNotificationJob;
use App\Notifications\PostCreatedNotification;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyUserSubscribers
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
    public function handle(PostCreated $event): void
    {
        try {
            $event->post->user->subscribers->each(function ($subscriber) use ($event) {
                $subscriber->notify(new PostCreatedNotification($event->post));
            });
        } catch(Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
