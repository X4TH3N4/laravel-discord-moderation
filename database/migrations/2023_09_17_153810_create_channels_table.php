<?php

use App\Models\Channel;
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
        Schema::create('channels', function (Blueprint $table) {
            $table->id(); //KANAL ID
            $table->string('discord_id')->nullable();
            $table->string('name')->default('general')->nullable();
            $table->bigInteger('type')->nullable(); //TEXT MI VOICE MI NE AMK
            $table->unsignedBigInteger('guild_id')->nullable();
            $table->foreign('guild_id')->references('id')->on('guilds')->cascadeOnDelete();
            $table->string('topic')->nullable(); //KANAL AÇIKLAMASI
            $table->boolean('nsfw')->nullable();
            $table->integer('bitrate')->nullable(); //EĞER VOICE İSE BİTRATE DEĞERİ
            $table->integer('user_limit')->nullable();
            $table->integer('cooldown')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->integer('position')->nullable(); //KANALIN BİR KATEGORİDEKİ YA DA GENEL POZİSYONU
            $table->unsignedBigInteger('category_id')->nullable(); //BAGLI İSE BAĞLI OLDUĞU KATEGORI IDSI parent_id
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete(); //BAGLI İSE BAĞLI OLDUĞU KATEGORI IDSI parent_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
