<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $contents=[
            ['user_id' => 1, 'product_id'=>1,'company_id'=>1,'content'=>'とっても使いやすかった。また買いたい。'],
           
        ];
        DB::table('threads')->insert($contents);
    }
}
