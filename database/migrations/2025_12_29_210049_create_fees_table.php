<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Tuition Fee, PTA Levy
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2);
            $table->foreignId('academic_session_id')->constrained('academic_sessions');
            $table->foreignId('school_class_id')->constrained('school_classes');
            $table->boolean('is_mandatory')->default(true);
            $table->timestamps();

            $table->unique(['name', 'academic_session_id', 'school_class_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
