<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReadPost extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
        $post = Post::where('slug', $this->slug)->firstOrFail();

        $post->update([
            'views' => $post->views + 1
        ]);
    }

    #[Layout('components.layouts.web')]
    public function render()
    {
        $post = Post::where('slug', $this->slug)->with(['category', 'comments' => function ($query) {
            $query->where('is_public', true);
        }])->firstOrFail();
        return view('livewire.web.read-post', [
            'post' => $post,
        ]);
    }
}
