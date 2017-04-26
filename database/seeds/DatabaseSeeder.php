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
            for ($i = 0; $i < rand(1, 6); $i++) {
                $user->contacts()->save(factory('App\Contact')->make());
            }
        });
    }

}
