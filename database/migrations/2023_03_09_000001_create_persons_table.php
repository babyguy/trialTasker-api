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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('per_name');
            $table->string('per_lastname')->nullable();
            $table->string('per_email')->nullable();
            $table->string('per_phone')->nullable();
            $table->string('per_address')->nullable();
            $table->string('per_nit')->nullable();
            $table->string('per_issue_nit')->nullable();
            $table->string('per_num_ministry')->nullable();
            $table->string('per_num_dispaych')->nullable();
            $table->string('per_radicated')->nullable();
            $table->string('per_authority')->nullable();
            $table->string('per_number')->nullable();
            $table->foreignId('per_type_person_id')->constrained('type_persons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
