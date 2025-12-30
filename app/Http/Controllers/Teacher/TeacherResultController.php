<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\ClassSubject;
use App\Models\Result;
use App\Models\AcademicSession;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherResultController extends Controller
{
    public function index(SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;

        $currentSession = AcademicSession::current();

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $subjects = $class->subjects()->orderBy('name')->get();

        $students = $class->students()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('teacher.results.broadsheet', compact('class', 'subjects', 'students', 'currentSession'));
    }

    public function store(Request $request, SchoolClass $class)
    {
        $teacher = Auth::user()->teacher;
        $currentSession = AcademicSession::current();

        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $currentSession?->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403);
        }

        $saved = 0;

        if ($request->has('results')) {
            foreach ($request->results as $studentId => $studentData) {
                if (!isset($studentData['subjects']))
                    continue;

                foreach ($studentData['subjects'] as $classSubjectId => $scores) {
                    $ca = $scores['ca_score'] ?? null;
                    $exam = $scores['exam_score'] ?? null;

                    if (filled($ca) || filled($exam)) {
                        Result::updateOrCreate(
                            [
                                'class_subject_id' => $classSubjectId,
                                'student_id' => $studentId,
                                'academic_session_id' => $currentSession->id,
                            ],
                            [
                                'ca_score' => filled($ca) ? (int) $ca : 0,
                                'exam_score' => filled($exam) ? (int) $exam : 0,
                            ]
                        );
                        $saved++;
                    }
                }
            }
        }

        return back()->with(
            'success',
            $saved > 0
            ? "Successfully saved {$saved} result" . ($saved > 1 ? 's' : '') . "."
            : "No changes were made."
        );
    }
}