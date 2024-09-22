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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('discord_id')->nullable();
            $table->string('nick')->nullable();
            $table->string('avatar')->nullable();
            $table->date('joined_at')->nullable(); // USERIN GUILDE KATILMA TARIHI
            $table->date('premium_since')->nullable(); // USERIN SUNUCUYU BOOSTLADIĞI TARİH
            $table->boolean('deaf')->nullable(); //USERIN KULAKLIĞI KAPALI MI?
            $table->boolean('mute')->nullable(); // USER SUSTURULU MU?
            $table->boolean('is_premium')->nullable();
            $table->boolean('is_banned')->nullable();
            $table->boolean('is_kicked')->nullable();
            $table->boolean('is_in_timeout')->nullable();
            $table->boolean('pending')->nullable(); // KULLANICI ÜYELİK ONAYINDA MI?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
