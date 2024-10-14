<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; // Hashファサードのインポート

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert([
        'name'=>'響子',
        'email'=>'kyon0704@docomo.ne.jp',
        'prefecture_id'=>1,
        'age'=>22,
        // 'gender'=>'',
        'email_verified_at' => now(),
        'password' => Hash::make('password123'),
       ]);
       DB::table('users')->insert([
        'name'=>'ドラえもん',
        'email'=>'emon@dora',
        'prefecture_id'=>1,
        'age'=>10,
        // 'gender'=>'',
        'email_verified_at' => now(),
        'password' => Hash::make('21century'),
       ]);
    }
}
