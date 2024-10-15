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
        Schema::create('thread_likes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thread_likes', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['thread_id']);
            $table->dropForeign(['user_id']);
        });

        // テーブルを削除
        Schema::dropIfExists('thread_likes');
    }
};
