<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('class_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('academic_session_id')->nullable()->constrained('academic_sessions');
            $table->date('enrolled_at')->useCurrent();
            $table->timestamps();

            // One student can only be in one class per session
            $table->unique(['student_id', 'academic_session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_student');
    }
};