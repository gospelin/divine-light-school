<?php

namespace App\Http\Controllers\Teacher;

use App\Models\SchoolClass;
use App\Models\Result;
use App\Models\StudentTermSummary;
use App\Models\AcademicSession;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherResultController extends TeacherBaseController
{
    public function index(SchoolClass $class, Request $request)
    {
        $teacher = Auth::user()->teacher;

        $sessions = AcademicSession::orderByDesc('start_year')->get();

        $selectedSession = AcademicSession::find($request->session_id)
            ?? AcademicSession::current()
            ?? $sessions->first();

        if (!$selectedSession) {
            abort(400, 'No academic session available.');
        }

        $terms = ['First', 'Second', 'Third'];
        $selectedTerm = in_array($request->term, $terms) ? $request->term : 'First';

        // Authorization
        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $selectedSession->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            abort(403, 'Unauthorized access.');
        }

        // Use ClassSubject model directly — no pivot confusion
        $classSubjects = $class->classSubjects()
            ->with('subject')
            ->get()
            ->sortBy('subject.name');

        // Build mapping: subject_id => class_subject_id
        $classSubjectIds = $classSubjects->pluck('id', 'subject.id')->toArray();

        // Extract just the Subject models for the table header
        $subjects = $classSubjects->pluck('subject');

        // Load students with results
        $students = $class->students()
            ->wherePivot('academic_session_id', $selectedSession->id)
            ->with(['results' => function ($q) use ($selectedSession, $selectedTerm) {
                $q->where('academic_session_id', $selectedSession->id)
                  ->where('term', $selectedTerm);
            }])
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $subjectAverages = $this->calculateSubjectAverages($selectedSession, $selectedTerm, $classSubjects);

        return view('teacher.results.broadsheet', compact(
            'class',
            'subjects',           // Collection of Subject models (for header)
            'students',
            'sessions',
            'selectedSession',
            'selectedTerm',
            'terms',
            'subjectAverages',
            'classSubjectIds'     // subject_id => class_subject_id mapping
        ));
    }

    protected function calculateSubjectAverages(AcademicSession $session, string $term, $classSubjects)
    {
        $averages = [];

        foreach ($classSubjects as $classSubject) {
            $classSubjectId = $classSubject->id;

            $totals = Result::where('class_subject_id', $classSubjectId)
                ->where('academic_session_id', $session->id)
                ->where('term', $term)
                ->whereNotNull('ca_score')
                ->whereNotNull('exam_score')
                ->get(['ca_score', 'exam_score'])
                ->sum(fn($r) => $r->ca_score + $r->exam_score);

            $count = Result::where('class_subject_id', $classSubjectId)
                ->where('academic_session_id', $session->id)
                ->where('term', $term)
                ->whereNotNull('ca_score')
                ->whereNotNull('exam_score')
                ->count();

            $averages[$classSubjectId] = $count > 0 ? round($totals / $count, 2) : null;
        }

        return $averages;
    }

    public function updateField(Request $request)
    {
        Log::info('Result update request', $request->all());

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_subject_id' => 'required|exists:class_subjects,id',
            'class_id' => 'required|exists:school_classes,id',
            'session_id' => 'required|exists:academic_sessions,id',
            'term' => 'required|in:First,Second,Third',
            'field' => 'required|in:ca_score,exam_score',
            'value' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === null)
                        return; // Allow clearing the score
        
                    if ($request->field === 'ca_score' && $value > 40) {
                        $fail('CA score cannot exceed 40.');
                    }

                    if ($request->field === 'exam_score' && $value > 60) {
                        $fail('Exam score cannot exceed 60.');
                    }
                },
            ],
        ]);

        $teacher = Auth::user()->teacher;
        $session = AcademicSession::findOrFail($request->session_id);
        $class = SchoolClass::findOrFail($request->class_id);
        $term = $request->term;

        // Authorization
        $isAssigned = $teacher->classes()
            ->wherePivot('academic_session_id', $session->id)
            ->where('school_classes.id', $class->id)
            ->exists();

        if (!$isAssigned) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        \DB::transaction(function () use ($request, $session, $term) {
            $result = Result::updateOrCreate(
                [
                    'class_subject_id' => $request->class_subject_id,
                    'student_id' => $request->student_id,
                    'academic_session_id' => $session->id,
                    'term' => $term,
                ],
                [
                    $request->field => $request->filled('value') ? (int) $request->value : null,
                ]
            );

            $result->grade = $this->calculateGrade($result->total);
            $result->remark = $this->generateRemark($result->total);
            $result->save();

            $this->recalculateTermSummary(
                $request->student_id,
                $request->class_id,
                $session->id,
                $term
            );
        });

        $result = Result::where([
            'class_subject_id' => $request->class_subject_id,
            'student_id' => $request->student_id,
            'academic_session_id' => $session->id,
            'term' => $term,
        ])->first();

        $summary = StudentTermSummary::where([
            'student_id' => $request->student_id,
            'school_class_id' => $class->id,
            'academic_session_id' => $session->id,
            'term' => $term,
        ])->first();

        return response()->json([
            'success' => true,
            'total' => $result->total,
            'grade' => $result->grade,
            'remark' => $result->remark,
            'total_score' => $summary?->total_score,
            'average' => $summary?->average ? round($summary->average, 2) : null,
            'principal_comment' => $summary?->principal_comment ?? '',
            'class_teacher_comment' => $summary?->class_teacher_comment ?? '',
        ]);
    }

    protected function recalculateTermSummary(int $studentId, int $classId, int $sessionId, string $term)
    {
        $results = Result::where('student_id', $studentId)
            ->where('academic_session_id', $sessionId)
            ->where('term', $term)
            ->whereHas('classSubject', fn($q) => $q->where('school_class_id', $classId))
            ->get();

        $totalScore   = $results->sum('total');
        $subjectCount = $results->count();
        $average      = $subjectCount > 0 ? round($totalScore / $subjectCount, 2) : null;

        $student = \App\Models\Student::find($studentId);

        StudentTermSummary::updateOrCreate(
            [
                'student_id'          => $studentId,
                'school_class_id'     => $classId,
                'academic_session_id' => $sessionId,
                'term'                => $term,
            ],
            [
                'total_subjects'        => $subjectCount,
                'total_score'           => $totalScore,
                'average'               => $average,
                'principal_comment'     => $this->generatePrincipalRemark($average, $student),
                'class_teacher_comment' => $this->generateTeacherRemark($average, $student),
            ]
        );
    }
}