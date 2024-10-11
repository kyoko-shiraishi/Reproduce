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
        'age'=>'22',
        'gender'=>'female',
        'email_verified_at' => now(),
        'password' => Hash::make('password123'),
       ]);
    }
}
