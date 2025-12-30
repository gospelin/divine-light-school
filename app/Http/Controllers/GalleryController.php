<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = GalleryItem::published()->latest('published_at')->paginate(15);
        return view('gallery.index', compact('photos'));
    }
}
