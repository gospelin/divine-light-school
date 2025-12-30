<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherStudentController extends Controller
{

    public function show(Student $student)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $currentSession = AcademicSession::current();

        // Security: Only allow viewing students in teacher's current classes
        $isInTeachersClass = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->whereHas('students', function ($q) use ($student, $currentSession) {
                $q->where('students.id', $student->id);
                if ($currentSession) {
                    $q->where('class_student.academic_session_id', $currentSession->id);
                }
            })
            ->exists();

        if (!$isInTeachersClass) {
            abort(403, 'You can only view students in your assigned classes.');
        }

        // Load current class
        $currentClass = $student->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->first();

        return view('teacher.students.show', compact('student', 'currentClass', 'currentSession'));
    }
    public function edit(Student $student)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $currentSession = AcademicSession::current();

        // CORRECTED: Use explicit pivot table name in nested whereHas
        $isInTeachersClass = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->whereHas('students', function ($q) use ($student, $currentSession) {
                $q->where('students.id', $student->id);
                if ($currentSession) {
                    $q->where('class_student.academic_session_id', $currentSession->id);
                }
            })
            ->exists();

        if (!$isInTeachersClass) {
            abort(403, 'You can only edit students in your assigned classes.');
        }

        $classes = SchoolClass::ordered()->get();
        $sessions = AcademicSession::orderByDesc('start_year')->get();

        $currentEnrollment = $student->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->first();

        return view('teacher.students.edit', compact('student', 'classes', 'sessions', 'currentEnrollment'));
    }

    public function update(Request $request, Student $student)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $currentSession = AcademicSession::current();

        // CORRECTED: Same fix in update method
        $isInTeachersClass = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->whereHas('students', function ($q) use ($student, $currentSession) {
                $q->where('students.id', $student->id);
                if ($currentSession) {
                    $q->where('class_student.academic_session_id', $currentSession->id);
                }
            })
            ->exists();

        if (!$isInTeachersClass) {
            abort(403, 'You can only edit students in your assigned classes.');
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'other_names' => 'nullable|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'guardian_name' => 'nullable|string|max:100',
            'medical_history' => 'nullable|string',
            'class_id' => 'required|exists:school_classes,id',
        ]);

        // Update basic info (excluding class_id)
        $student->update($request->except('class_id'));

        // Handle class change
        $currentEnrollment = $student->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->first();

        $newClassId = $request->class_id;

        if (!$currentEnrollment || $currentEnrollment->id != $newClassId) {
            // Security: Teacher must be assigned to the new class
            $teacherTeachesNewClass = $teacher->classes()
                ->wherePivot('academic_session_id', $currentSession?->id)
                ->where('school_classes.id', $newClassId)
                ->exists();

            if (!$teacherTeachesNewClass) {
                return back()->with('error', 'You can only move the student to a class you teach.');
            }

            // Detach from old class, attach to new
            $student->classes()
                ->wherePivot('academic_session_id', $currentSession?->id)
                ->detach();

            $student->classes()->attach($newClassId, [
                'academic_session_id' => $currentSession?->id,
                'enrolled_at' => now(),
            ]);
        }

        $redirectClassId = $currentEnrollment?->id ?? $newClassId;

        return redirect()
            ->route('teacher.classes.show', $redirectClassId)
            ->with('success', 'Student details updated successfully.');
    }
}