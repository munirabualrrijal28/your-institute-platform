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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id_fk')->constrained('students')->onDelete('cascade');
            $table->foreignId('institute_id_fk')->constrained('institutes')->onDelete('cascade');




            $table->unique(['student_id_fk', 'institute_id_fk']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
