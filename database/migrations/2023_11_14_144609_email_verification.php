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
        Schema::create("email_verification", function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("md5");
            $table->string("code");
            $table->dateTime("time")->default(now());
            $table->enum("status", ["true", "false"])->default("false");
            $table->dateTime("deadline")->default(now()->addDay());
            $table->timestamps();
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
