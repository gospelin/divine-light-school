<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_term_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('academic_session_id')->constrained('academic_sessions')->onDelete('cascade');
            $table->enum('term', ['First', 'Second', 'Third']);
            $table->integer('total_subjects')->default(0);
            $table->integer('total_score')->default(0);
            $table->decimal('average', 5, 2)->nullable();
            $table->integer('position_in_class')->nullable();
            $table->date('school_closes')->nullable();
            $table->date('school_reopens')->nullable();
            $table->text('class_teacher_comment')->nullable();
            $table->text('principal_comment')->nullable();
            $table->text('director_comment')->nullable();
            $table->enum('promotion_status', ['Promoted', 'Repeat'])->nullable(); 
            $table->boolean('is_published')->default(false); 
            $table->timestamps();

            $table->unique([
                'student_id',
                'school_class_id',
                'academic_session_id',
                'term'
            ], 'student_term_summary_unique_entry');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_term_summaries');
    }
};