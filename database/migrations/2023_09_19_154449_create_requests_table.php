<?php

use App\Enums\Request\StatusEnum;
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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('author_id')->nullable();
            $table->unsignedBigInteger('guild_id')->nullable();
            $table->foreign('guild_id')->references('id')->on('guilds')->cascadeOnDelete();
            $table->string('type'); //ban, kick, timeout, role
            $table->unsignedBigInteger('object_id');
            $table->foreign('object_id')->references('id')->on('members')->cascadeOnDelete();//istekten etkilenen kişi (nesne)
            $table->string('reason')->nullable();
            $table->string('status')->nullable();//istekten etkilenen kişi (nesne)
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
