<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name',
        ]);

        Subject::create($request->only('name'));

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject added successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name,' . $subject->id,
        ]);

        $subject->update($request->only('name'));

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        // Optional: prevent delete if assigned to classes
        if ($subject->classes()->exists()) {
            return back()->with('error', 'Cannot delete subject assigned to classes.');
        }

        $subject->delete();

        return back()->with('success', 'Subject deleted.');
    }
}