<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Access denied. Teacher profile not found.');
        }

        $currentSession = AcademicSession::current();

        // Eager load current classes with pivot
        $teacher->load([
            'classes' => fn($query) => $query->wherePivot('academic_session_id', $currentSession?->id)
        ]);

        $totalStudents = $teacher->classes->sum(function ($class) use ($currentSession) {
            return $class->students()
                ->wherePivot('academic_session_id', $currentSession?->id)
                ->count();
        });

        return view('teacher.dashboard', compact('teacher', 'currentSession', 'totalStudents'));
    }
}