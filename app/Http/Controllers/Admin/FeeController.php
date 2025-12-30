<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\FeePayment;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of fees.
     */
    public function index()
    {
        $currentSession = AcademicSession::current();
        $fees = Fee::with(['schoolClass', 'session'])
            ->where('academic_session_id', $currentSession?->id)
            ->orderBy('school_class_id')
            ->get();

        return view('admin.fees.index', compact('fees', 'currentSession'));
    }

    /**
     * Show the form for creating a new fee.
     */
    public function create()
    {
        $sessions = AcademicSession::orderByDesc('start_year')->get();
        $classes = SchoolClass::ordered()->get();

        return view('admin.fees.create', compact('sessions', 'classes'));
    }

    /**
     * Store a newly created fee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'is_mandatory' => 'boolean',
        ]);

        Fee::create($request->all());

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee created successfully.');
    }

    /**
     * Display the specified fee with payment summary.
     */
    public function show(Fee $fee)
    {
        $fee->load(['schoolClass', 'session', 'payments.student']);

        $totalPaid = $fee->payments->sum('amount_paid');
        $totalExpected = $fee->amount * $fee->schoolClass->students()->count(); // Rough estimate

        return view('admin.fees.show', compact('fee', 'totalPaid', 'totalExpected'));
    }

    /**
     * Show the form for editing the specified fee.
     */
    public function edit(Fee $fee)
    {
        $sessions = AcademicSession::orderByDesc('start_year')->get();
        $classes = SchoolClass::ordered()->get();

        return view('admin.fees.edit', compact('fee', 'sessions', 'classes'));
    }

    /**
     * Update the specified fee.
     */
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'is_mandatory' => 'boolean',
        ]);

        $fee->update($request->all());

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee updated successfully.');
    }

    /**
     * Remove the specified fee.
     */
    public function destroy(Fee $fee)
    {
        // Prevent deletion if payments exist
        if ($fee->payments()->exists()) {
            return back()->with('error', 'Cannot delete fee with recorded payments.');
        }

        $fee->delete();

        return back()->with('success', 'Fee deleted successfully.');
    }

    /**
     * Show form and record payment for a student.
     */
    public function recordPayment(Request $request, Student $student)
    {
        $currentSession = AcademicSession::current();

        if (!$currentSession) {
            return back()->with('error', 'No current academic session set.');
        }

        $fees = Fee::where('academic_session_id', $currentSession->id)
            ->where('school_class_id', $student->current_class?->id)
            ->get();

        if ($request->isMethod('post')) {
            $request->validate([
                'fee_id' => 'required|exists:fees,id',
                'amount_paid' => 'required|numeric|min:0.01',
                'payment_date' => 'required|date',
                'notes' => 'nullable|string',
            ]);

            $fee = Fee::findOrFail($request->fee_id);

            // Prevent duplicate payment
            $existing = FeePayment::where('student_id', $student->id)
                ->where('fee_id', $fee->id)
                ->first();

            if ($existing) {
                return back()->with('error', 'Payment for this fee has already been recorded.');
            }

            FeePayment::create([
                'student_id' => $student->id,
                'fee_id' => $fee->id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'receipt_number' => 'REC-' . strtoupper(substr($student->admission_number, -4)) . '-' . date('YmdHis'),
                'notes' => $request->notes,
                'recorded_by' => auth()->id(),
            ]);

            return redirect()->route('admin.students.index')
                ->with('success', "Payment recorded for {$student->fullName()}");
        }

        return view('admin.fees.payment', compact('student', 'fees', 'currentSession'));
    }
}