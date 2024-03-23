<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class RandomPost extends Component
{
    public function render()
    {
        $posts = Cache::remember('random-posts', now()->addDays(1), function () {
            return Post::inRandomOrder()->take(5)->get();
        });
        return view('livewire.web.random-post', compact('posts'));
    }
}
