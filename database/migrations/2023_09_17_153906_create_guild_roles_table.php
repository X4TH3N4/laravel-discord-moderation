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
        Schema::create('guild_roles', function (Blueprint $table) {
            $table->id();

            //_id')->references('id')
            $table->string('discord_id')->nullable();
            $table->unsignedBigInteger('guild_id')->nullable();
            $table->foreign('guild_id')->references('id')->on('guilds')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->boolean('hoist')->nullable();
            $table->string('icon')->nullable();
            $table->string('unicode_emoji')->nullable();
            $table->integer('position')->nullable();
            $table->string('permissions')->nullable();
            $table->boolean('managed')->nullable();
            $table->boolean('mentionable')->nullable();
            $table->json('tags')->nullable();
            $table->bigInteger('flags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guild_roles');
    }
};
