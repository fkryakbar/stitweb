<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchBar extends Component
{
    #[Validate('min:3')]
    public $query = '';

    public $is_show_search_bar = false;

    public function search()
    {
        if ($this->query != '') {
            $this->validate();
        }
        $this->dispatch('search_post', search_query: $this->query);
    }

    public function mount()
    {
        if (explode('/', url()->current())[3] == 'category') {
            $this->is_show_search_bar = true;
        }
    }

    public function render()
    {

        return view('livewire.web.search-bar');
    }
}
