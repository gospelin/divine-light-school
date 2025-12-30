<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_subject_id',
        'student_id',
        'ca_score',
        'exam_score',
        'grade',
        'remark',
        'academic_session_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    /**
     * Get the subject name via pivot
     */
    public function getSubjectNameAttribute()
    {
        return Subject::join('class_subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->where('class_subjects.id', $this->class_subject_id)
            ->value('subjects.name');
    }

    /**
     * Get the class display name via pivot
     */
    public function getClassNameAttribute()
    {
        return SchoolClass::join('class_subjects', 'school_classes.id', '=', 'class_subjects.school_class_id')
            ->where('class_subjects.id', $this->class_subject_id)
            ->value('school_classes.display_name');
    }

    /**
     * Auto-calculated total
     */
    public function getTotalAttribute(): int
    {
        return $this->ca_score + $this->exam_score;
    }
}