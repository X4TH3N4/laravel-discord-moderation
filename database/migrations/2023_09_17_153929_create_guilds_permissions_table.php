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
        Schema::create('guilds_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guild_id')->nullable();
            $table->unsignedBigInteger('guild_permission_id')->nullable();
            $table->foreign('guild_id')->references('id')->on('guilds')->cascadeOnDelete();
            $table->foreign('guild_permission_id')->references('id')->on('guild_permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guild_permissions');
    }
};
