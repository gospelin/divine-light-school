<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function show(SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $currentSession = AcademicSession::current();

        // Check if teacher is assigned to this class this session
        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403, 'You are not assigned to this class.');
        }

        // Get students in this class for current session
        $students = $class->students()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('teacher.classes.show', compact('class', 'students', 'currentSession'));
    }
}