<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTermSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'school_class_id',
        'academic_session_id',
        'term',                     
        'total_subjects',
        'total_score',
        'average',
        'position_in_class',
        'school_closes',
        'school_reopens',
        'class_teacher_comment',
        'principal_comment',
        'promotion_status',
        'is_published',
    ];

    protected $casts = [
        'school_closes' => 'date',
        'school_reopens' => 'date',
        'average' => 'decimal:2',
        'is_published' => 'boolean',
        'term' => 'string',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function getPositionSuffixAttribute()
    {
        if (!$this->position_in_class)
            return '';
        $pos = $this->position_in_class;
        if ($pos % 100 >= 11 && $pos % 100 <= 13)
            return $pos . 'th';
        return match ($pos % 10) {
            1 => $pos . 'st',
            2 => $pos . 'nd',
            3 => $pos . 'rd',
            default => $pos . 'th',
        };
    }
}