<?php
// app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::published()->latest('published_at')->paginate(12);
        return view('videos.index', compact('videos'));
    }
}