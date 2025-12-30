<?php
// app/Http/Controllers/Admin/EventAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::with('author')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now', // Future date only
            'location' => 'nullable|string|max:255',
            'published' => 'sometimes|boolean',
        ]);

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'user_id' => auth()->id(),
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? now() : null,
            'is_upcoming' => Carbon::parse($validated['event_date'])->greaterThanOrEqualTo(now()),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'published' => 'sometimes|boolean',
        ]);

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'published' => $request->boolean('published'),
            'published_at' => $request->boolean('published') ? ($event->published_at ?? now()) : null,
            'is_upcoming' => Carbon::parse($validated['event_date'])->greaterThanOrEqualTo(now()),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }
}