<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Comment as CommentModel;
use App\Models\Post;
use Livewire\Attributes\Reactive;

class Comment extends Component
{
    public $post;

    #[Validate('required|max:500')]
    public $comment;

    #[Validate('required|max:100')]
    public $name;

    #[Validate('required|max:50')]
    public $email;

    public function save()
    {
        $this->validate();

        CommentModel::create([
            'post_id' => $this->post->id,
            'comment' => $this->comment,
            'name' => $this->name,
            'email' => $this->email,
            'is_public' => false
        ]);

        $this->reset('comment', 'name', 'email');
        session()->flash('comment_status', 'Komentar Berhasil dikirim');
    }
    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.web.comment');
    }
}
