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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable();
            $table->string('bot_id')->nullable();
            $table->string('guild_id')->nullable(); //target guild id
            $table->string('public_guild_id')->nullable(); //
            $table->string('message_channel_id')->nullable();
            $table->string('login_logout_channel_id')->nullable();
            $table->string('bot_ready_channel_id')->nullable();
            $table->string('role_channel_id')->nullable();
            $table->string('voice_activity_channel_id')->nullable();
            $table->string('ban_channel_id')->nullable();
            $table->string('kick_channel_id')->nullable();
            $table->string('vip_role_id')->nullable();
            $table->string('unregistered_role_id')->nullable();
            $table->string('timeout_channel_id')->nullable();
            $table->string('mute_channel_id')->nullable();
            $table->string('announcement_channel_id')->nullable();
            $table->string('rule_channel_id')->nullable();
            $table->string('log_category_channel_id')->nullable();  //  LOG KATEGORİSİNİN IDSİ
            $table->string('management_category_channel_id')->nullable();   //  YÖNETİM KATEGORİSİNİN IDSİ
            $table->string('members_role_id')->nullable();
            $table->string('bots_role_id')->nullable();
            $table->boolean('private')->nullable();
            $table->boolean('private2')->nullable();
            $table->boolean('public1')->nullable();
            $table->boolean('public2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
