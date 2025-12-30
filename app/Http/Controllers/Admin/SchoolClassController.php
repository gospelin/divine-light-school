<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::ordered()->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|in:Nursery,Primary,Secondary',
            'name' => 'required|string|max:50',
            'group' => 'nullable|string|size:1|regex:/^[A-Z]$/',
            'order' => 'required|integer',
        ]);

        SchoolClass::create($request->all());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function edit(SchoolClass $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'section' => 'required|in:Nursery,Primary,Secondary',
            'name' => 'required|string|max:50',
            'group' => 'nullable|string|size:1|regex:/^[A-Z]$/',
            'order' => 'required|integer',
        ]);

        $class->update($request->all());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class updated.');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return back()->with('success', 'Class deleted.');
    }
}