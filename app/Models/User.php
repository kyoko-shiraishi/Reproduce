<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prefecture',
        'age',
        'gender',
        'generation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function prefecture()
    {
        return $this->belongsTo(prefecture::class, 'prefectures_id');
    }
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function thread_likes()
    {
        return $this->hasMany(ThreadLike::class);
    }
    public function post_likes()
    {
        return $this->hasMany(PostLike::class);
    }
    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }
}
