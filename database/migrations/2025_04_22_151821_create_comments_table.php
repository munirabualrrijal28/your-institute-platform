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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id_fk');
            $table->unsignedBigInteger('commentable_id'); // Polymorphic target
            $table->string('commentable_type' , 100); // 	E.g. App\Models\Advertisement
            $table->string('content' ); //
            $table->unsignedBigInteger('parent_id')->nullable(); // ✅ <-- here
            //For threaded ( nested ) replies; enforce max depth in code.





            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('cascade');

 // Composite index for polymorphic relation
 $table->index(['commentable_type', 'commentable_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
