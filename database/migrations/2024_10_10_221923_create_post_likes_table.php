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
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('count')->default(0);
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // 外部キー制約にON DELETE CASCADEを追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // 外部キー制約にON DELETE CASCADEを追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_likes', function (Blueprint $table) { // Schema::tableを使用して既存のテーブルを操作
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('post_likes');
    }
};
