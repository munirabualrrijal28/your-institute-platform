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
        
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mediable_id'); // Polymorphic target

            $table->string('mediable_type'); // 	E.g. App\Models\Advertisement
            $table->string('url'); // File location
            $table->string('type'); // E.g. image, video, document
            $table->timestamps();

            // Composite index for polymorphic relation
            $table->index(['mediable_type', 'mediable_id']);









        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
