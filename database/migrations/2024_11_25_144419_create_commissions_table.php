<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->string('room');
            $table->string('schedule');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('professor_id')->constrained('professors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
