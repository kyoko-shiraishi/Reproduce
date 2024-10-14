<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ThreadLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thread_likes=[
            ['thread_id'=>1,'user_id'=>1,],
        ];
     DB::table('thread_likes')->insert($thread_likes);   
    }
}
