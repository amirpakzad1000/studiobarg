<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use studiobarg\Course\Models\Course;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('title');
            $table->string('slug');
            $table->float('priority')->nullable();
            $table->string('price',10);
            $table->string('percent',5);
            $table->enum('type',Course::$types);
            $table->enum('status',Course::$statuses);
            $table->enum('confirmation_status',Course::$confirmationStatuses);
            $table->longText('description')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
