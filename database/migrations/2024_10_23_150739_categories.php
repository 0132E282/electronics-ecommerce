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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->boolean('display')->default(true)->nullable();
            $table->integer('outstanding')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
