<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // public function scopeOrdered($query)
    // {
    //     return $query->orderByRaw("
    //         CASE section
    //             WHEN 'Nursery' THEN 1
    //             WHEN 'Primary' THEN 2
    //             WHEN 'Secondary' THEN 3
    //         END
    //     ")
    //     ->orderBy('order')
    //     ->orderBy('name')
    //     ->orderBy('group');
    // }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id')
            ->withPivot('academic_session_id', 'enrolled_at')
            ->withTimestamps();
    }
}
