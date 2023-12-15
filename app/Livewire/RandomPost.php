<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class RandomPost extends Component
{
    public $posts;

    public function mount()
    {
        $posts = Post::inRandomOrder()->take(5)->get();
        $this->posts = $posts;
    }

    public function render()
    {
        return view('livewire.web.random-post');
    }
}
