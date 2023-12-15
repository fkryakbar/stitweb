<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;


    #[Title('Berita Terbaru')]

    public $category;

    public function mount($key)
    {
        $category = ModelsCategory::where('key', $key)->with('posts')->firstOrFail();
        $this->category = $category;
    }

    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('livewire.web.category', [
            'posts' => Post::where('category_id', $this->category->id)->latest()->paginate(10)
        ]);
    }
}
