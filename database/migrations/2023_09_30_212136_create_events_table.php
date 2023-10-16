<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->date('deadline_application');
            $table->date('event_date');
            $table->string('category');
            $table->string('venue');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete("CASCADE");
            $table->string('address');
            $table->integer('age_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
