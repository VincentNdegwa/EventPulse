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
        Schema::table('user_profile', function (Blueprint $table) {
            $table->enum("email_status", ["active", "inactive"])->default("inactive");
            $table->enum("phone_status", ["active", "inactive"])->default("inactive");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropColumn("email_status");
            $table->dropColumn("phone_status");
        });
    }
};
