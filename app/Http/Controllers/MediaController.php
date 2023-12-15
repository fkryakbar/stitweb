<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::latest()->paginate();
        return view('admin.media.index', compact('medias'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|not_in:php'
        ]);

        $path = $request->file('file')->store('media');

        $request->merge([
            'filename' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'size' => number_format($request->file('file')->getSize() / 1024, 2)
        ]);
        Media::create($request->except(['file']));
        return back()->with('success', 'File successfully uploaded');
    }

    public function delete($id)
    {
        $media = Media::where('id', $id)->firstOrFail();
        Storage::delete($media->path);

        $media->delete();

        return back()->with('success', 'File successfully deleted');
    }
}
