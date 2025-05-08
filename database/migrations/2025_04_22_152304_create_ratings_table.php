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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('user_id_fk');
            $table->unsignedBigInteger('rated_id'); // Polymorphic target
            $table->string('type', 100); // E.g. CourseAdv, Institute


            $table->tinyInteger('rating'); // Constrain 1–5 in application or DB check constraint
            $table->string('review')->nullable(); // 	Optional user comment


            $table->foreign(columns: 'user_id_fk')->references('id')->on('users')->onDelete('cascade');


            // Prevent double-rating
            $table->unique(['user_id_fk', 'type', 'rated_id']);



            $table->timestamps();

            // code down here : To prevent multiple ratings from one student to the same item:
            // $table->unique(['student_id_fk', 'institute_id_fk']); // For institute
            // $table->unique(['student_id_fk', 'course_adv_id_fk']); // For course

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
