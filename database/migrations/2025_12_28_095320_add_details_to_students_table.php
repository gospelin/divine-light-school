<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Father
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_office_phone')->nullable();
            $table->string('father_place_of_employment')->nullable();

            // Mother
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_office_phone')->nullable();
            $table->string('mother_place_of_employment')->nullable();

            // Guardian (if different)
            $table->string('guardian_name')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_office_phone')->nullable();
            $table->string('guardian_place_of_employment')->nullable();

            // Other info
            $table->text('childhood_history')->nullable();
            $table->string('last_school_attended')->nullable();
            $table->string('languages_spoken_at_home')->nullable();
            $table->text('medical_history')->nullable();

            // Admission session (when student joined school)
            $table->foreignId('admission_session_id')
                  ->nullable()
                  ->constrained('academic_sessions')
                  ->onDelete('set null');

            // Make admission_number nullable temporarily (we'll auto-generate it)
            $table->string('admission_number')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'father_name', 'father_occupation', 'father_office_phone', 'father_place_of_employment',
                'mother_name', 'mother_occupation', 'mother_office_phone', 'mother_place_of_employment',
                'guardian_name', 'guardian_occupation', 'guardian_office_phone', 'guardian_place_of_employment',
                'childhood_history', 'last_school_attended', 'languages_spoken_at_home', 'medical_history',
                'admission_session_id'
            ]);
            $table->string('admission_number')->change();
        });
    }
};
