<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Classes this subject is taught in
    public function schoolClasses(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subjects')
            ->using(ClassSubject::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    // Alias for consistency
    public function classes(): BelongsToMany
    {
        return $this->schoolClasses();
    }

    // Direct access to assignments
    public function classSubjects(): HasMany
    {
        return $this->hasMany(ClassSubject::class);
    }
}