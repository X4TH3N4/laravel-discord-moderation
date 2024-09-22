<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); //KATEGORI KANALI ID
            $table->string('discord_id')->nullable();
            $table->string('category_mod_role_id')->nullable();
            $table->string('category_user_role_id')->nullable();
            $table->string('name')->nullable();
            $table->string('guild_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('type')->default(4); //KATEGORI OLDUGUNUN OLAYI
            $table->integer('position')->nullable(); //KANALIN BİR KATEGORİDEKİ YA DA GENEL POZİSYONU
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
