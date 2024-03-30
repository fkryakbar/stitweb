<?php

namespace App\Livewire;

use App\Jobs\IncrementViews;
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

        IncrementViews::dispatch($slug);

        return view('livewire.web.read-post', [
            'post' => $post,
        ]);
    }
}
