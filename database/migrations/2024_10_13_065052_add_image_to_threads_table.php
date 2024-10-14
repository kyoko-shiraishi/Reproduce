<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('threads', function (Blueprint $table) {
        $table->string('image')->nullable(); // 画像のパスを保存するカラム
    });
}

public function down()
{
    Schema::table('threads', function (Blueprint $table) {
        $table->dropColumn('image'); // ロールバック時に削除
    });
}

};
