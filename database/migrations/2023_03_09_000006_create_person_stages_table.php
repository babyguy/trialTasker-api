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
        Schema::create('person_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_stage_person_id')->constrained('persons');
            $table->foreignId('person_stage_stage_id')->constrained('stages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_stages');
    }
};
