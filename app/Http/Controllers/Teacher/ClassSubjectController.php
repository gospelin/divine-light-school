<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\AcademicSession;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function index(SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        $currentSessionId = AcademicSession::current()?->id;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSessionId)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        // Load assigned class-subject combinations
        $classSubjects = $class->classSubjects()
            ->with('subject')
            ->get()
            ->sortBy('subject.name');

        $assignedSubjectIds = $classSubjects->pluck('subject.id')->toArray();

        $availableSubjects = Subject::whereNotIn('id', $assignedSubjectIds)
            ->orderBy('name')
            ->get();

        return view('teacher.class_subjects.index', compact(
            'class',
            'classSubjects',
            'availableSubjects',
            'assignedSubjectIds'
        ));
    }

    public function store(Request $request, SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        $currentSessionId = AcademicSession::current()?->id;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSessionId)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $request->validate([
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $newSubjectIds = $request->subject_ids;

        $addedCount = 0;

        foreach ($newSubjectIds as $subjectId) {
            // Check if already assigned
            $exists = $class->classSubjects()
                ->where('subject_id', $subjectId)
                ->exists();

            if (!$exists) {
                // Create new ClassSubject record
                ClassSubject::create([
                    'school_class_id' => $class->id,
                    'subject_id'      => $subjectId,
                ]);

                $addedCount++;
            }
        }

        if ($addedCount === 0) {
            return back()->with('info', 'No new subjects were added (already assigned).');
        }

        return back()->with('success', "{$addedCount} subject(s) successfully added.");
    }

    public function destroy(SchoolClass $class, Subject $subject)
    {
        $teacher = Auth::user()->teacher;

        $currentSessionId = AcademicSession::current()?->id;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSessionId)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $classSubject = $class->classSubjects()
            ->where('subject_id', $subject->id)
            ->first();

        if (!$classSubject) {
            return back()->with('info', 'Subject not found in this class.');
        }

        $classSubject->delete();

        return back()->with('success', 'Subject removed from class successfully.');
    }
}