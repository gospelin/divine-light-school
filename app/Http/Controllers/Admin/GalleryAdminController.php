<?php
// app/Http/Controllers/Admin/GalleryAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $items = GalleryItem::with(['media', 'author'])->latest()->paginate(12);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'published' => 'sometimes|boolean',
        ]);

        $item = GalleryItem::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => auth()->id(), 
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? now() : null,
        ]);

        if ($request->hasFile('image')) {
            $item->addMedia($request->file('image'))
                ->toMediaCollection('images');
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added successfully!');
    }

    public function edit(GalleryItem $galleryItem)
    {
        $galleryItem->load('media');
        return view('admin.gallery.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'published' => 'sometimes|boolean',
        ]);

        $galleryItem->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? ($galleryItem->published_at ?? now()) : null,
        ]);

        if ($request->hasFile('image')) {
            // Clear existing media and add new one
            $galleryItem->clearMediaCollection('images');
            $galleryItem->addMedia($request->file('image'))
                ->toMediaCollection('images');
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItem->clearMediaCollection('images');
        $galleryItem->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
    }
}