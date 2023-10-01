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
        Schema::table("events", function (Blueprint $table) {
            $table->string("age_limit")->change();
            $table->string("meeting_link")->after("address");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("events", function (Blueprint $table) {
            $table->dropColumn("meeting_link");
            $table->integer("age_limit")->change();
        });
    }
};
