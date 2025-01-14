<?php

namespace App\Console\Commands;

use App\Jobs\DeactivateOldPostsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeactivateOldPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-old-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate old posts if created_at more than 7 days ago';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            DeactivateOldPostsJob::dispatch();
        } catch(\Exception $error) {
            Log::error($error);
        }

    }
}
