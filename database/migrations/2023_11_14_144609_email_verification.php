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
        Schema::table("email_verification", function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("md5");
            $table->dateTime("time")->default(now());
            $table->dateTime("deadline")->default(now()->addDay());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("email_verification");
    }
};
