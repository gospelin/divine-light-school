<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published' => 'sometimes|boolean',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->excerpt = $validated['excerpt'];
        $post->body = $validated['body'];
        $post->user_id = auth()->id();

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->file('featured_image')->store('blog', 'public');
        }

        // Explicitly handle publish status
        $isPublished = $request->boolean('published');

        $post->published = $isPublished;
        $post->published_at = $isPublished ? now() : null;

        $post->save();

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published' => 'sometimes|boolean',
        ]);

        $post->title = $validated['title'];
        $post->excerpt = $validated['excerpt'];
        $post->body = $validated['body'];

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->featured_image = $request->file('featured_image')->store('blog', 'public');
        }

        $isPublished = $request->boolean('published');
        $post->published = $isPublished;
        $post->published_at = $isPublished ? ($post->published_at ?? now()) : null;

        $post->save();

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully!');
    }
    
    public function destroy(Post $post)
    {
        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully!');
    }
}