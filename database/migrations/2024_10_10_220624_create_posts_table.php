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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('content'); // コメントの内容
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->unsignedBigInteger('thread_id'); // スレッドID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // 外部キー制約
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade'); // 外部キー制約
            $table->timestamps(); // 作成・更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['thread_id']);
            $table->dropForeign(['user_id']);
        });

        // テーブルを削除
        Schema::dropIfExists('posts');
    }
};
