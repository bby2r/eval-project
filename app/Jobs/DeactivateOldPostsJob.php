<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class DeactivateOldPostsJob implements ShouldQueue
{
    use Queueable, SerializesModels, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $posts = Post::where('created_at', '<', now()->subDays(7))->get();
        $posts->each(function (Post $post) {
            $post->active = false;
            $post->save();
        });
    }
}
