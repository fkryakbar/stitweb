<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

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
        $post = Post::where('slug', $this->slug)->with(['category', 'comments' => function ($query) {
            $query->where('is_public', true);
        }])->first();
        if ($post) {
            $post->increment('views', 1);
            Cache::put('read-post-' . $this->slug, $post, now()->addDays(7));
        }
    }
}
