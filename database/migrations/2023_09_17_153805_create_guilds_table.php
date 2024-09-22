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
        Schema::create('guilds', function (Blueprint $table) {
            $table->id();
            $table->string('discord_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_hash')->nullable();
            $table->string('splash')->nullable();
            $table->string('discovery_splash')->nullable();
            $table->boolean('owner')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('region')->nullable();
            $table->unsignedBigInteger('afk_channel_id')->nullable();
            $table->bigInteger('afk_timeout')->nullable();
            $table->boolean('widget_enabled')->nullable();
            $table->unsignedBigInteger('widget_channel_id')->nullable();
            $table->integer('verification_level')->nullable();
            $table->unsignedBigInteger('default_message_notifications')->nullable();
            $table->bigInteger('explicit_content_filter')->nullable();
            $table->json('roles')->nullable();
            $table->json('emojis')->nullable();
            $table->json('features')->nullable();
            $table->bigInteger('mfa_level')->nullable();
            $table->unsignedBigInteger('application_id')->nullable();
            $table->unsignedBigInteger('system_channel_id')->nullable();
            $table->bigInteger('system_channel_flags')->nullable();
            $table->unsignedBigInteger('rules_channel_id')->nullable();
            $table->bigInteger('max_presences')->nullable();
            $table->bigInteger('max_members')->nullable();
            $table->string('vanity_url_code')->nullable();
            $table->string('banner')->nullable();
            $table->integer('premium_tier')->nullable();
            $table->bigInteger('premium_subscription_count')->nullable();
            $table->string('preferred_locale')->nullable();
            $table->unsignedBigInteger('public_updates_channel_id')->nullable();
            $table->bigInteger('max_video_channel_users')->nullable();
            $table->bigInteger('max_stage_video_channel_users')->nullable();
            $table->bigInteger('approximate_member_count')->nullable();
            $table->bigInteger('approximate_presence_count')->nullable();
            $table->json('welcome_screen')->nullable();
            $table->integer('nsfw_level')->nullable();
            $table->json('stickers')->nullable();
            $table->boolean('premium_progress_bar_enabled')->nullable();
            $table->unsignedBigInteger('safety_alerts_channel_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guilds');
    }
};
