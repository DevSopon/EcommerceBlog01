<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id'=>1, 'post_id'=>1, 'content'=>"This is post one comment"],
            ['user_id'=>2, 'post_id'=>2, 'content'=>"This is post two comment"],
            ['user_id'=>3, 'post_id'=>3, 'content'=>"This is post three comment"],
        ]);
    }
}
