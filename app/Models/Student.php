<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_number',
        'first_name',
        'last_name',
        'other_names',
        'date_of_birth',
        'gender',
        'parent_phone',
        'address',

        // Parent & Guardian fields
        'father_name',
        'father_occupation',
        'father_office_phone',
        'father_place_of_employment',
        'mother_name',
        'mother_occupation',
        'mother_office_phone',
        'mother_place_of_employment',
        'guardian_name',
        'guardian_occupation',
        'guardian_office_phone',
        'guardian_place_of_employment',

        // Other info
        'childhood_history',
        'last_school_attended',
        'languages_spoken_at_home',
        'medical_history',

        // Admission session
        'admission_session_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get full name of student
     */
    public function fullName(): string
    {
        return trim("{$this->first_name} {$this->other_names} {$this->last_name}");
    }

    /**
     * Relationship: Session when student joined the school
     */
    public function admissionSession()
    {
        return $this->belongsTo(AcademicSession::class, 'admission_session_id');
    }

    /**
     * Many-to-many: All classes the student has been in across sessions
     */
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_student', 'student_id', 'class_id')
            ->withPivot('academic_session_id', 'enrolled_at')
            ->withTimestamps();
    }

    /**
     * Accessor: Get the student's current class in the current academic session
     *
     * Usage in Blade: $student->current_class?->display_name
     */
    public function getCurrentClassAttribute()
    {
        $currentSessionId = \App\Models\AcademicSession::current()?->id;

        if (!$currentSessionId) {
            return null;
        }

        return $this->classes()
            ->wherePivot('academic_session_id', $currentSessionId)
            ->first();
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function termSummaries()
    {
        return $this->hasMany(StudentTermSummary::class);
    }
}