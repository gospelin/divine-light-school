<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClassSubjectController extends Controller
{
    public function index(SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', AcademicSession::current()?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $assignedSubjectIds = $class->subjects()->pluck('subjects.id')->toArray();
        $availableSubjects = Subject::orderBy('name')->get();

        $classSubjects = $class->subjects()->orderBy('name')->get();

        return view('teacher.class_subjects.index', compact(
            'class',
            'availableSubjects',
            'assignedSubjectIds',
            'classSubjects'
        ));
    }

    public function store(Request $request, SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', AcademicSession::current()?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $request->validate([
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $newSubjects = array_diff($request->subject_ids, $class->subjects()->pluck('subjects.id')->toArray());

        if (empty($newSubjects)) {
            return back()->with('info', 'No new subjects selected.');
        }

        $class->subjects()->attach($newSubjects);

        return back()->with('success', count($newSubjects) . ' subject(s) added to class.');
    }

    public function destroy(SchoolClass $class, Subject $subject)
    {
        $teacher = Auth::user()->teacher;

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', AcademicSession::current()?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $class->subjects()->detach($subject->id);

        return back()->with('success', 'Subject removed from class.');
    }
}