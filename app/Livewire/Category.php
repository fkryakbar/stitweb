<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Category extends Component
{
    use WithPagination;


    #[Title('Berita Terbaru')]

    public $category;
    public $search_query = '';
    public function mount($key)
    {
        $category = ModelsCategory::where('key', $key)->with('posts')->firstOrFail();
        $this->category = $category;
    }

    #[On('search_post')]
    public function set_search_query($search_query)
    {
        $this->search_query = $search_query;
    }

    #[Layout('components.layouts.web')]
    public function render()
    {

        $posts = Post::where('category_id', $this->category->id)->latest()->paginate(10);
        if (Str::length($this->search_query) >= 3) {
            $posts = Post::where('title', 'like', "%" . $this->search_query . "%")->orWhere('description', 'like', "%" . $this->search_query . "%")->orWhere('content', 'like', "%" . $this->search_query . "%")->latest()->paginate(10);
        }

        return view('livewire.web.category', [
            'posts' => $posts
        ]);
    }
}
