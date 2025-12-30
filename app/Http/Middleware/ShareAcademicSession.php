<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Symfony\Component\HttpFoundation\Response;

class ShareAcademicSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $globalCurrent = AcademicSession::current(); // One query

        $preferredId = $user?->preferred_academic_session_id;

        $currentSession = $preferredId
            ? AcademicSession::find($preferredId) // One query max
            : $globalCurrent;

        if (!$currentSession) {
            $currentSession = $globalCurrent ?? AcademicSession::latest('start_year')->first();
        }

        // ONLY STRINGS — NO MODELS!
        view()->share('currentSessionName', $currentSession?->name ?? 'Not set');
        view()->share('globalSessionName', $globalCurrent?->name ?? 'Not set');
        view()->share('isPersonalSessionView', 
            $currentSession && $globalCurrent && $currentSession->id !== $globalCurrent->id
        );

        return $next($request);
    }
}
