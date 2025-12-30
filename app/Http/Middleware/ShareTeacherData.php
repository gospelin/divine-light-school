<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShareTeacherData
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole('teacher')) {
            $teacher = Auth::user()->teacher;

            if ($teacher) {
                $currentSessionId = AcademicSession::current()?->id;

                if ($currentSessionId) {
                    $teacher->load([
                        'classes' => fn($q) => $q->wherePivot('academic_session_id', $currentSessionId)
                    ]);
                }

                view()->share('teacherClasses', $teacher->classes ?? collect());
            } else {
                view()->share('teacherClasses', collect());
            }
        } else {
            view()->share('teacherClasses', collect());
        }

        return $next($request);
    }
}