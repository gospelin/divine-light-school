<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_subject_id')->constrained('class_subjects')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->enum('term', ['First', 'Second', 'Third']);
            $table->integer('ca_score')->nullable();
            $table->integer('exam_score')->nullable();
            $table->integer('total_score')->nullable();
            $table->string('grade')->nullable(); 
            $table->string('remark')->nullable();
            $table->foreignId('academic_session_id')->constrained('academic_sessions');
            $table->timestamps();

            // SAFE UNIQUE NAME (under 64 chars)
            $table->unique(
                ['class_subject_id', 'student_id', 'academic_session_id'],
                'results_unique_entry' // ← Short, safe name
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};