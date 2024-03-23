<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
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

        $post->increment('views', 1);
    }

    #[Layout('components.layouts.web')]
    public function render()
    {

        $slug = $this->slug;

        $post = Cache::remember('read-post-' . $slug, now()->addDays(7), function () use ($slug) {
            return Post::where('slug', $slug)->with(['category', 'comments' => function ($query) {
                $query->where('is_public', true);
            }])->firstOrFail();
        });
        return view('livewire.web.read-post', [
            'post' => $post,
        ]);
    }
}
