<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Berita extends Component
{
    #[Title('Berita Terbaru')]

    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('livewire.web.berita');
    }
}
