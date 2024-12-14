<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;
    protected $fillable = ['generation_id'];
    public $timestamps = false;
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
