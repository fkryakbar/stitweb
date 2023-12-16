<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $posts_total = count($posts);
        $comments_total = count(Comment::all());
        $views = 0;

        foreach ($posts as $post) {
            $views = $views + $post->views;
        }

        return view('admin.dashboard.index', compact('posts_total', 'comments_total', 'views'));
    }
}
