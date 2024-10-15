<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('categories')->insert([
       [ 'name'=>'日用品'],
       [ 'name'=>'衣類'],
       ['name'=>'電子機器'],
       ['name'=>'家電'],
       ['name'=>'家具'],
       ['name'=>'おもちゃ・ゲーム機器'],
       ['name'=>'キッチン用品'],
       ['name'=>'食品'],
       ['name'=>'化粧品'],
       ['name'=>'その他'],

     ]);   
    }
}
