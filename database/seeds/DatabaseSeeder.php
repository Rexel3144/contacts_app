<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory('App\User', 5)->create()->each(function($user) {
                $user->contacts()->saveMany(factory('App\Contact',rand(1,10))->make());
        });
    }

}
