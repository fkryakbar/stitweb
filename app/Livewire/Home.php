<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('STIT Assunniyyah Tambarangan')]

    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('livewire.web.home', [
            'posts' => Post::where('category_id', 1)->latest()->limit(3)->get(),
            'pengumuman' => Post::where('category_id', 2)->latest()->limit(3)->get()
        ]);
    }
}
