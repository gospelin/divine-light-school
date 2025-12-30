<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification',
        'specialization',
        'date_employed',
        'bio',
        'phone',
        'address'
    ];

    protected $casts = [
        'date_employed' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_teacher', 'teacher_id', 'school_class_id')
            ->withPivot('academic_session_id')
            ->withTimestamps();
    }

    public function currentClasses()
    {
        $currentSessionId = AcademicSession::current()?->id;

        return $this->classes()->wherePivot('academic_session_id', $currentSessionId);
    }
}