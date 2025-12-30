<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search by name or admission number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('other_names', 'like', "%{$search}%")
                    ->orWhere('admission_number', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(first_name, ' ', other_names, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
        }

        // Filter by current class
        if ($request->filled('class_id')) {
            $classId = $request->class_id;
            $currentSessionId = AcademicSession::current()?->id;

            $query->whereHas('classes', function ($q) use ($classId, $currentSessionId) {
                $q->where('class_id', $classId)
                    ->where('class_student.academic_session_id', $currentSessionId);
            });
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by admission session
        if ($request->filled('admission_session_id')) {
            $query->where('admission_session_id', $request->admission_session_id);
        }

        $students = $query->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(25)
            ->withQueryString(); // Keeps filters in pagination links

        $classes = SchoolClass::ordered()->get();
        $sessions = AcademicSession::orderByDesc('start_year')->get();

        return view('admin.students.index', compact('students', 'classes', 'sessions'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $classes = SchoolClass::ordered()->get();
        $sessions = AcademicSession::orderByDesc('start_year')->get();

        return view('admin.students.create', compact('classes', 'sessions'));
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'other_names' => 'nullable|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',

            // Parent & Guardian
            'father_name' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'father_office_phone' => 'nullable|string|max:20',
            'father_place_of_employment' => 'nullable|string|max:200',

            'mother_name' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'mother_office_phone' => 'nullable|string|max:20',
            'mother_place_of_employment' => 'nullable|string|max:200',

            'guardian_name' => 'nullable|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_office_phone' => 'nullable|string|max:20',
            'guardian_place_of_employment' => 'nullable|string|max:200',

            // Other info
            'childhood_history' => 'nullable|string',
            'last_school_attended' => 'nullable|string|max:200',
            'languages_spoken_at_home' => 'nullable|string|max:200',
            'medical_history' => 'nullable|string',

            'admission_session_id' => 'required|exists:academic_sessions,id',
            'class_id' => 'required|exists:school_classes,id',
        ]);

        // Auto-generate admission number: DLISS/2025/0001
        $admissionSession = AcademicSession::findOrFail($request->admission_session_id);
        $year = $admissionSession->start_year;

        $lastStudent = Student::where('admission_session_id', $admissionSession->id)
            ->orderByDesc('id')
            ->first();

        $nextNumber = $lastStudent
            ? ((int) substr($lastStudent->admission_number, -4)) + 1
            : 1;

        $admissionNumber = sprintf('DLISS/%d/%04d', $year, $nextNumber);

        // Create student
        $student = Student::create(array_merge($request->except('class_id'), [
            'admission_number' => $admissionNumber,
        ]));

        // Enroll in current class for current session
        $currentSession = AcademicSession::current();

        $student->classes()->attach($request->class_id, [
            'academic_session_id' => $currentSession?->id,
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', "Student {$admissionNumber} registered successfully.");
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(Student $student)
    {
        $classes = SchoolClass::ordered()->get();
        $sessions = AcademicSession::orderByDesc('start_year')->get();

        $currentEnrollment = $student->classes()
            ->wherePivot('academic_session_id', AcademicSession::current()?->id)
            ->first();

        return view('admin.students.edit', compact('student', 'classes', 'sessions', 'currentEnrollment'));
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, Student $student)
{
    $request->validate([
        // REMOVE admission_number from validation — it's auto-generated and read-only
        'first_name'                 => 'required|string|max:100',
        'last_name'                  => 'required|string|max:100',
        'other_names'                => 'nullable|string|max:100',
        'date_of_birth'              => 'required|date',
        'gender'                     => 'required|in:Male,Female',
        'parent_phone'               => 'nullable|string|max:20',
        'address'                    => 'nullable|string|max:500',

        // Parent & Guardian
        'father_name'                => 'nullable|string|max:100',
        'father_occupation'          => 'nullable|string|max:100',
        'father_office_phone'        => 'nullable|string|max:20',
        'father_place_of_employment' => 'nullable|string|max:200',

        'mother_name'                => 'nullable|string|max:100',
        'mother_occupation'          => 'nullable|string|max:100',
        'mother_office_phone'        => 'nullable|string|max:20',
        'mother_place_of_employment' => 'nullable|string|max:200',

        'guardian_name'              => 'nullable|string|max:100',
        'guardian_occupation'        => 'nullable|string|max:100',
        'guardian_office_phone'      => 'nullable|string|max:20',
        'guardian_place_of_employment' => 'nullable|string|max:200',

        'childhood_history'          => 'nullable|string',
        'last_school_attended'       => 'nullable|string|max:200',
        'languages_spoken_at_home'   => 'nullable|string|max:200',
        'medical_history'            => 'nullable|string',

        'admission_session_id'       => 'required|exists:academic_sessions,id',
        'class_id'                   => 'required|exists:school_classes,id',
    ]);

    // Update all fields EXCEPT admission_number and class_id (handled separately)
    $student->update($request->except(['class_id', 'admission_number']));

    $currentSessionId = AcademicSession::current()?->id;

    if (!$currentSessionId) {
        return back()->with('error', 'No current academic session set.');
    }

    $currentEnrollment = $student->classes()
        ->wherePivot('academic_session_id', $currentSessionId)
        ->first();

    $newClassId = $request->class_id;

    // Only change class if different
    if (!$currentEnrollment || $currentEnrollment->id != $newClassId) {
        $student->classes()
            ->wherePivot('academic_session_id', $currentSessionId)
            ->detach();

        $student->classes()->attach($newClassId, [
            'academic_session_id' => $currentSessionId,
            'enrolled_at' => now(),
        ]);
    }

    return redirect()
        ->route('admin.students.index')
        ->with('success', 'Student updated successfully.');
}

    /**
     * Remove the student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Student deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,promote',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $students = Student::find($request->student_ids);

        if ($request->action === 'delete') {
            $students->each->delete();
            return back()->with('success', 'Selected students deleted.');
        }

        // Promote logic later
        return back()->with('info', 'Bulk promote coming soon!');
    }
}