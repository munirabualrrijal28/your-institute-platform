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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id_fk');
            $table->unsignedBigInteger('notifiable_id'); // Polymorphic target
            $table->string('notifiable_type');
            $table->string('type'); // e.g. new_follower, course_enrolled
            $table->json('data')->nullable(); // Payload (IDs, messages)
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Composite index for polymorphic relation
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
