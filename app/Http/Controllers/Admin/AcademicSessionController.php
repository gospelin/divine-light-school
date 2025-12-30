<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function index()
    {
        $sessions = AcademicSession::orderByDesc('start_year')->get();
        $current = AcademicSession::current();

        return view('admin.sessions.index', compact('sessions', 'current'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_year' => 'required|integer|digits:4',
            'end_year' => 'required|integer|digits:4|gt:start_year',
            'is_current' => 'sometimes|boolean',
        ]);

        $data = $request->only(['start_year', 'end_year']);

        if ($request->boolean('is_current')) {
            // First: turn off all others
            AcademicSession::query()->update(['is_current' => false]);
            $data['is_current'] = true;
        }

        AcademicSession::create($data);

        return redirect()->back()->with('success', 'Session created successfully.');
    }

    public function setPreferred(Request $request)
    {
        auth()->user()->update([
            'preferred_academic_session_id' => $request->session_id ?: null
        ]);
        return back()->with('success', 'Session preference updated!');
    }
    
    public function setGlobalCurrent(AcademicSession $session)
    {
        // Turn off all others first
        AcademicSession::query()->update(['is_current' => false]);

        // Then activate this one
        $session->update(['is_current' => true]);

        return redirect()->back()->with('success', 'Global current session updated.');
    }
}
