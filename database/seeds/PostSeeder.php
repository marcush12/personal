<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['user_id' => 1, 'title' => 'Post One', 'content' => 'Post content one'],
            ['user_id' => 1, 'title' => 'Post Two', 'content' => 'Post content two'],
            ['user_id' => 1, 'title' => 'Post Three', 'content' => 'Post content three']
        ]);
    }
}
