<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $currentSessionId = AcademicSession::current()?->id;

        $teachers = Teacher::with(['user'])
            ->with([
                'classes' => function ($query) use ($currentSessionId) {
                    $query->wherePivot('academic_session_id', $currentSessionId);
                }
            ])
            ->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $classes = SchoolClass::ordered()->get();
        $currentSession = AcademicSession::current();

        return view('admin.teachers.create', compact('classes', 'currentSession'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'qualification' => 'required|string|max:100',
            'specialization' => 'nullable|string|max:100',
            'date_employed' => 'required|date',
            'bio' => 'nullable|string',
            'class_ids' => 'array',
            'class_ids.*' => 'exists:school_classes,id',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('teacher123'), // Default password — teacher must change
        ]);

        $user->assignRole('teacher');

        // Create teacher profile
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'date_employed' => $request->date_employed,
            'bio' => $request->bio,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Assign to classes in current session
        $currentSessionId = AcademicSession::current()?->id;
        if ($currentSessionId && $request->filled('class_ids')) {
            $syncData = [];
            foreach ($request->class_ids as $classId) {
                $syncData[$classId] = ['academic_session_id' => $currentSessionId];
            }
            $teacher->classes()->sync($syncData);
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', "Teacher {$user->name} created successfully. Default password: teacher123");
    }

    public function show(Teacher $teacher)
    {
        $teacher->load([
            'user',
            'classes' => function ($q) {
                $q->wherePivot('academic_session_id', AcademicSession::current()?->id);
            }
        ]);

        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $classes = SchoolClass::ordered()->get();
        $currentSession = AcademicSession::current();
        $assignedClassIds = $teacher->classes()
            ->wherePivot('academic_session_id', AcademicSession::current()?->id)
            ->pluck('school_classes.id')
            ->toArray();

        return view('admin.teachers.edit', compact('teacher', 'classes', 'currentSession', 'assignedClassIds'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($teacher->user->id)],
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'qualification' => 'required|string|max:100',
            'specialization' => 'nullable|string|max:100',
            'date_employed' => 'required|date',
            'bio' => 'nullable|string',
            'class_ids' => 'array',
            'class_ids.*' => 'exists:school_classes,id',
        ]);

        // Update user
        $teacher->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update teacher profile
        $teacher->update([
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'date_employed' => $request->date_employed,
            'bio' => $request->bio,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Update class assignments
        $currentSessionId = AcademicSession::current()?->id;
        if ($currentSessionId) {
            $syncData = [];
            if ($request->filled('class_ids')) {
                foreach ($request->class_ids as $classId) {
                    $syncData[$classId] = ['academic_session_id' => $currentSessionId];
                }
            }
            $teacher->classes()->sync($syncData);
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        // Optional: Prevent delete if has classes or results
        // if ($teacher->classes()->exists()) {
        //     return back()->with('error', 'Cannot delete teacher assigned to classes.');
        // }

        $teacher->user->delete();
        $teacher->delete();

        return back()->with('success', 'Teacher deleted successfully.');
    }
}
