<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateThreadLikesForeignKey extends Migration
{
    public function up()
    {
        Schema::table('thread_likes', function (Blueprint $table) {
            // 既存の外部キー制約を削除
            $table->dropForeign(['thread_id']);
            
            // 新しい外部キー制約を追加 (ON DELETE CASCADE)
            $table->foreign('thread_id')
                  ->references('id')->on('threads')
                  ->onDelete('cascade'); // ここで連鎖削除を設定
        });
    }

    public function down()
    {
        Schema::table('thread_likes', function (Blueprint $table) {
            // 外部キー制約を削除する際はまず制約を削除
            $table->dropForeign(['thread_id']);
            
            // ここでは元の状態に戻すために再設定することも可能ですが、必要に応じて
            // 再設定しない場合は、単に削除するだけで良い
        });
    }
}
