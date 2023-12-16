<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $posts = Post::with('category')->latest()->paginate();
        if ($request->search) {
            $posts = Post::where('title', 'like', "%" . $request->search . "%")->orWhere('description', 'like', "%" . $request->search . "%")->orWhere('content', 'like', "%" . $request->search . "%")->with('category')->latest()->paginate();
        }
        return view('admin.posts.index', compact('categories', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
        ]);

        $request->merge(['slug' => Str::slug($request->title)]);

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'description' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:png,jpeg,webp|max:1024',
        ]);

        if ($request->file('thumbnail')) {
            $image_path = $request->file('thumbnail')->store('thumbnail');
            $request->merge(['image_path' => $image_path]);
        }

        $request->merge([
            'user_id' => Auth::user()->id,
            'views' => 0
        ]);

        Post::create($request->except(['thumbnail']));

        return back()->with('success', 'Post Created Successfully');
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }


    public function update($slug, Request $request)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:png,jpeg,webp|max:1024',
        ]);
        if ($request->is_delete_thumbnail) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            $image_path = null;

            $request->merge(['image_path' => $image_path]);
        }
        if ($request->file('thumbnail')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }

            $image_path = $request->file('thumbnail')->store('/thumbnail');

            $request->merge(['image_path' => $image_path]);
        }

        $post->update($request->except(['thumbnail', 'is_delete_thumbnail']));

        return back()->with('success', 'Post updated successfully');
    }

    public function delete($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if ($post->image_path) {
            Storage::delete($post->image_path);
        }
        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
