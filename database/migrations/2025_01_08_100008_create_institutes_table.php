<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_fk');
            $table->string('ins_name');
            $table->text('ins_description')->nullable();
            // license_photo for verfication
            $table->string('ins_profile_photo')->nullable();
            $table->string('ins_lic_photo')->nullable();
            $table->boolean('ins_is_verified');
            $table->boolean('ins_lic_photo_approved')->default(false);


            $table->boolean('is_restricted')->default(false); // For admin restriction

            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
