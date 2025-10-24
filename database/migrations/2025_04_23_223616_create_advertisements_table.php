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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();

            $table->string( 'title')->default('')->nullable();

            $table->unsignedBigInteger( 'user_id');
            $table->string( 'user_type');
            $table->unsignedBigInteger( 'institute_id_fk')->nullable();
            $table->text( 'content')->nullable();






            $table->foreign('institute_id_fk')->references('id')->on('institutes')->onDelete('cascade');


            $table->index(['user_type', 'user_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
