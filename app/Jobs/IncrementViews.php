<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementViews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $slug;

    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = Post::where('slug', $this->slug)->first();
        if ($post) {
            $post->increment('views', 1);
        }
    }
}
