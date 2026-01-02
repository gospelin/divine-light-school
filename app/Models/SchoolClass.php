<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = ['section', 'name', 'group', 'order'];

    public function getDisplayNameAttribute(): string
    {
        return $this->group ? $this->name . $this->group : $this->name;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('section')
            ->orderBy('order')
            ->orderBy('group');
    }

    // Students enrolled in this class (across sessions)
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id')
            ->withPivot('academic_session_id', 'enrolled_at')
            ->withTimestamps();
    }

    // Subjects assigned to this class — now through ClassSubject
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subjects')
            ->using(ClassSubject::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    // Direct access to ClassSubject records
    public function classSubjects(): HasMany
    {
        return $this->hasMany(ClassSubject::class);
    }

    public function termSummaries(): HasMany
    {
        return $this->hasMany(StudentTermSummary::class);
    }
}