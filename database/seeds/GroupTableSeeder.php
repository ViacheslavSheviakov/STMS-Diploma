<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'short_title' => 'SSE 16-2',
            'full_title' => 'Software & Software Engeneering 2016 (2nd)',
        ]);

        DB::table('groups')->insert([
            'short_title' => 'PLG 13-1',
            'full_title' => 'Polygraphy 2013 (1st)',
        ]);

        DB::table('groups')->insert([
            'short_title' => 'ER 12-3',
            'full_title' => 'Electronics 2012 (3rd)',
        ]);
    }
}
