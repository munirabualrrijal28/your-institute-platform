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

            
            $table->unsignedBigInteger( 'user_id');
            $table->unsignedBigInteger( 'user_type');
            $table->unsignedBigInteger( 'institute_id_fk');
            $table->text( 'content')->nullable();






            $table->foreign('institute_id_fk')->references('id')->on('institutes')->onDelete('cascade');




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
