<?php
// app/Http/Controllers/ChannelController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use App\Models\GalleryItem;
use Illuminate\Pagination\LengthAwarePaginator;

class ChannelController extends Controller
{
    public function index()
    {
        $filter = request()->query('filter');
        $perPage = 12;

        if ($filter === 'blog') {
            $feed = Post::published()
                ->latest('published_at')
                ->paginate($perPage)
                ->through(fn($p) => (object) [
                    'type' => 'blog',
                    'item' => $p,
                    'date' => $p->published_at ?? now(),
                ]);

        } elseif ($filter === 'video') {
            $feed = Video::published()
                ->latest('published_at')
                ->paginate($perPage)
                ->through(fn($v) => (object) [
                    'type' => 'video',
                    'item' => $v,
                    'date' => $v->published_at ?? now(),
                ]);

        } elseif ($filter === 'photo') {
            $feed = GalleryItem::published()
                ->latest('published_at')
                ->paginate($perPage)
                ->through(fn($g) => (object) [
                    'type' => 'photo',
                    'item' => $g,
                    'date' => $g->published_at ?? now(),
                ]);

        } else {
            // Mixed feed: All content (blogs, videos, photos) sorted by date
            $blogs = Post::published()->latest('published_at')->get()->map(fn($p) => (object) [
                'type' => 'blog',
                'item' => $p,
                'date' => $p->published_at ?? now(),
            ]);

            $videos = Video::published()->latest('published_at')->get()->map(fn($v) => (object) [
                'type' => 'video',
                'item' => $v,
                'date' => $v->published_at ?? now(),
            ]);

            $photos = GalleryItem::published()->latest('published_at')->get()->map(fn($g) => (object) [
                'type' => 'photo',
                'item' => $g,
                'date' => $g->published_at ?? now(),
            ]);

            $feedCollection = collect([$blogs, $videos, $photos])
                ->flatten()
                ->sortByDesc('date');

            // Manual pagination for mixed collection
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = $feedCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $feed = new LengthAwarePaginator(
                $currentItems,
                $feedCollection->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        }

        return view('channel.index', compact('feed', 'filter'));
    }
}