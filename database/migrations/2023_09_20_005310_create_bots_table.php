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
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->string('discord_id')->nullable();
            $table->string('token')->nullable();
            $table->string('name')->default('Laravel Discord')->nullable();
            $table->string('status')->default('online')->nullable(); //online,idle,invisible,dnd
            $table->string('activity_name')->nullable();
            $table->string('activity_url')->nullable(); //twitch veya youtube yayın linki
            $table->string('activity_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bots');
    }
};
