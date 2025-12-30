<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{
    // app/Http/Controllers/EventController.php
    public function index()
    {
        $upcoming = Event::published()->upcoming()->get();
        $past = Event::published()->past()->take(6)->get();
        return view('events.index', compact('upcoming', 'past'));
    }
}
