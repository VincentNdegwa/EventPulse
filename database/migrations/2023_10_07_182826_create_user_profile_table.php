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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_profile_id");
            $table->foreign("user_profile_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("phone_name")->nullable();
            $table->string("country")->nullable();
            $table->string("state")->nullable();
            $table->string("profile_image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
