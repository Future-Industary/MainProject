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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->enum('status', ['active', 'inactive', 'on_article'])->default('inactive');
            $table->timestamp('last_login')->nullable();
            $table->integer('teaching_experience')->default(0);
            $table->boolean('confirmation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
