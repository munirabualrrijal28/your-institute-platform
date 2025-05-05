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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->text('course_description')->nullable();


            $table->unsignedBigInteger('category_id_fk');
            $table->unsignedBigInteger( 'institute_id_fk');

            $table->foreign('institute_id_fk')->references('id')->on('institutes')->onDelete('cascade');

            $table->foreign('category_id_fk')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_advs');
    }

};
