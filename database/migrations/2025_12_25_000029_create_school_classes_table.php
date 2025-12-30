<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['Nursery', 'Primary', 'Secondary']);
            $table->string('name'); // e.g., "JSS 1", "Nursery 1"
            $table->string('group')->nullable(); // "A", "B", null
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['section', 'name', 'group']);
            $table->index(['section', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};