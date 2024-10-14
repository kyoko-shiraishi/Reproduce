<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post_likes=[
            [
            'post_id'=>1,
            'user_id'=>1]
        ];
        DB::table('post_likes')->insert($post_likes);
    }
}
