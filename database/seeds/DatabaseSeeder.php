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
        $this->call('KeywordsSeeder');
        $this->call('ChampionsSeeder');
        $this->call('FollowersSeeder');
        $this->call('SpellsSeeder');
    }
}
