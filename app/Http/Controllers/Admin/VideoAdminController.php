<?php
// app/Http/Controllers/Admin/VideoAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoAdminController extends Controller
{
    public function index()
    {
        $videos = Video::with('author')->latest()->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'video_url' => 'required|url',
            'published' => 'sometimes|boolean',
        ]);

        $video = Video::create([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'video_url' => $validated['video_url'],
            'user_id' => auth()->id(),
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? now() : null,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video added successfully!');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'video_url' => 'required|url',
            'published' => 'sometimes|boolean',
        ]);

        $video->update([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'video_url' => $validated['video_url'],
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? ($video->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }
}