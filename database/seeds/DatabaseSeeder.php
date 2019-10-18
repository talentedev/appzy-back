<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TagsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
    }
}
