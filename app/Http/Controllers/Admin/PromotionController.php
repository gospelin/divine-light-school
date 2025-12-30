<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $sessions = AcademicSession::orderByDesc('start_year')->get();
        $classes = SchoolClass::ordered()->get();

        return view('admin.promotions.index', compact('sessions', 'classes'));
    }

    public function promote(Request $request)
    {
        $request->validate([
            'from_session_id' => 'required|exists:academic_sessions,id',
            'to_session_id' => 'required|exists:academic_sessions,id|different:from_session_id',
            'from_class_id' => 'required|exists:school_classes,id',
            'to_class_id' => 'required|exists:school_classes,id',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $fromSession = AcademicSession::findOrFail($request->from_session_id);
        $toSession = AcademicSession::findOrFail($request->to_session_id);
        $fromClass = SchoolClass::findOrFail($request->from_class_id);
        $toClass = SchoolClass::findOrFail($request->to_class_id);

        $query = Student::whereHas('classes', function ($q) use ($fromSession, $fromClass) {
            $q->where('class_id', $fromClass->id)
                ->where('class_student.academic_session_id', $fromSession->id);
        });

        if ($request->filled('student_ids')) {
            $query->whereIn('id', $request->student_ids);
        }

        $students = $query->get();

        if ($students->isEmpty()) {
            return back()->with('error', 'No students found to promote.');
        }

        $promotedCount = 0;

        foreach ($students as $student) {
            // DO NOT detach old class — preserve history!

            // Only add new enrollment for next session
            $alreadyEnrolled = $student->classes()
                ->wherePivot('academic_session_id', $toSession->id)
                ->wherePivot('class_id', $toClass->id)
                ->exists();

            if (!$alreadyEnrolled) {
                $student->classes()->attach($toClass->id, [
                    'academic_session_id' => $toSession->id,
                    'enrolled_at' => now(),
                ]);
                $promotedCount++;
            }
        }

        return back()->with('success', "{$promotedCount} student(s) successfully promoted to {$toClass->display_name} in {$toSession->name}. Previous history preserved.");
    }
}