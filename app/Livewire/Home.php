<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('STIT Assunniyyah Tambarangan')]

    #[Layout('components.layouts.web')]
    public function render()
    {

        $posts = Cache::remember('posts-limit-3', now()->addDays(5), function () {
            return Post::where('category_id', 1)->latest()->limit(3)->get();
        });

        $pengumuman = Cache::remember('pengumuman-limit-3', now()->addDays(5), function () {
            return Post::where('category_id', 2)->latest()->limit(3)->get();
        });

        return view('livewire.web.home', [
            'posts' => $posts,
            'pengumuman' => $pengumuman
        ]);
    }
}
