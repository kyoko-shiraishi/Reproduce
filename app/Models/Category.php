<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 保存するデータ
    protected $fillable = ['name']; 
    

    /**
     * 製品とのリレーション
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
        // 'category_id' は、Product テーブル内の外部キーのカラム名です。このカラムは、どの Category に属しているかを示します
    }
}
