<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_subject_id',
        'student_id',
        'term',
        'ca_score',
        'exam_score',
        'grade',
        'remark',
        'academic_session_id'
    ];

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function classSubject(): BelongsTo
    {
        return $this->belongsTo(ClassSubject::class, 'class_subject_id');
    }

    // Accessors using relationships (cleaner than raw joins)
    public function getSubjectNameAttribute(): string
    {
        return $this->classSubject?->subject?->name ?? '';
    }

    public function getClassNameAttribute(): string
    {
        return $this->classSubject?->schoolClass?->display_name ?? '';
    }

    // Calculated total — never stored in DB
    public function getTotalAttribute(): int
    {
        return ($this->ca_score ?? 0) + ($this->exam_score ?? 0);
    }

    // Scope for current term
    // public function scopeCurrentTerm($query, $term = null)
    // {
    //     $term = $term ?? AcademicSession::current()?->current_term ?? 'First';
    //     return $query->where('term', $term);
    // }
}