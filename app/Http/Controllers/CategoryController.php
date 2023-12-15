<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('posts')->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
        ]);

        $request->merge(['key' => Str::slug($request->name)]);

        $request->validate([
            'key' => 'required|unique:categories',
        ]);

        Category::create($request->all());

        return back()->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }


    public function update($id, Request $request)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|max:20',
        ]);



        $category->update($request->all());

        return back()->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->with('posts')->firstOrFail();
        if (count($category->posts) > 0) {
            throw ValidationException::withMessages([
                'posts_still_exist' => 'Category still has posts',
            ]);
        }
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}
