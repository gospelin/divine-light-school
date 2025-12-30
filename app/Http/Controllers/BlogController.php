<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with('author') // Optional: eager load author for performance
            ->latest('published_at')
            ->paginate(6);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Ensure only published posts are viewable
        if (!$post->published || is_null($post->published_at)) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
}