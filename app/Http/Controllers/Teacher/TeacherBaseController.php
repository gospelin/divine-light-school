<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\Auth;

class TeacherBaseController extends Controller
{
    protected function getCurrentSession()
    {
        return AcademicSession::current() ?? abort(400, 'No current academic session is set.');
    }

    protected function calculateGrade($total)
    {
        if ($total === null || $total < 0)
            return null;

        return match (true) {
            $total >= 95 => 'A+',
            $total >= 80 => 'A',
            $total >= 70 => 'B',
            $total >= 65 => 'C+',
            $total >= 50 => 'C',
            $total >= 40 => 'D',
            $total >= 30 => 'E',
            default => 'F',
        };
    }

    protected function generateRemark($total)
    {
        if ($total === null || $total < 0)
            return null;

        return match (true) {
            $total >= 95 => 'Outstanding',
            $total >= 80 => 'Excellent',
            $total >= 70 => 'Very Good',
            $total >= 65 => 'Good',
            $total >= 60 => 'Credit',
            $total >= 50 => 'Pass',
            $total >= 40 => 'Poor',
            $total >= 30 => 'Very Poor',
            default => 'Failed',
        };
    }

    /**
     * Principal Remark - Culturally relevant, warm, and encouraging
     */
    protected function generatePrincipalRemark(?float $average, $student = null): string
    {
        if ($average === null)
            return '';

        $first_name = $student?->first_name ?? 'Student';

        return match (true) {
            $average >= 80 => "Excellent performance, {$first_name}! You have made us very proud. Keep soaring higher!",
            $average >= 70 => "Very impressive result, {$first_name}. Well done! Continue to work hard and shine.",
            $average >= 60 => "Good effort, {$first_name}. You are doing well. Keep it up and aim even higher next term.",
            $average >= 50 => "Satisfactory performance, {$first_name}. You can do better with more dedication. We believe in you.",
            $average >= 40 => "Fair result, {$first_name}. More serious effort is needed. Put in extra work and you'll improve greatly.",
            default => "Dear {$first_name}, your performance needs attention. Let's work together with more focus next term.",
        };
    }

    /**
     * Teacher Remark - Personal, warm, and culturally familiar
     */
    protected function generateTeacherRemark(?float $average, $student = null): string
    {
        if ($average === null)
            return '';

        $first_name = $student?->first_name ?? 'Student';

        return match (true) {
            $average >= 80 => "Brilliant work, {$first_name}! You're a star. Keep making me proud!",
            $average >= 70 => "Excellent job, {$first_name}! Very well done. Keep up the good work.",
            $average >= 60 => "Good one, {$first_name}! You're improving nicely. Continue like this.",
            $average >= 50 => "Not bad, {$first_name}. You tried. Just put in a little more effort next time.",
            $average >= 40 => "Fair effort, {$first_name}. You can do much better. Let's work harder together.",
            default => "My dear {$first_name}, more effort is needed. I'm here to help you improve. Don't give up!",
        };
    }
}