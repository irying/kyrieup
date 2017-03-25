<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('tags')->truncate();
        // $this->call(UsersTableSeeder::class);
         $this->call(TagsTableSeeder::class);
    }
}
