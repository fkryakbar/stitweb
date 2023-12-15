<?php

namespace App\Livewire\Admin;

use App\Models\Comment as ModelsComment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Comment extends Component
{

    public function updateVisibility($comment_id, $visibility)
    {
        $comment = ModelsComment::where('id', $comment_id)->firstOrFail();
        $comment->update([
            'is_public' => $visibility
        ]);
    }
    public function delete($id)
    {
        $comment = ModelsComment::find($id);
        $comment->delete();
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('admin.comments.index', [
            'comments' => ModelsComment::with('post')->latest()->paginate()
        ]);
    }
}
