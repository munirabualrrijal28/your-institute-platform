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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();


            //
            
            $table->unsignedBigInteger('user_id_fk'); // الشخص الذي أبلغ
            $table->unsignedBigInteger('reportable_id'); // الكائن المُبلّغ عنه
            $table->string('reportable_type'); // نوع الكائن المُبلّغ عنه (Course, Comment, Advertisement...)

            $table->string('reason'); // مثل: spam, abusive, scam, etc
            $table->text('description')->nullable(); // توضيح إضافي
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');


            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('cascade');
            $table->index(['reportable_type', 'reportable_id']);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
