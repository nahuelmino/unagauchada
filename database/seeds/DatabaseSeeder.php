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
        // $this->call(UsersTableSeeder::class);
        factory('App\User')->create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('unagauchada'),
            'is_admin' => 1
        ]);

        factory('App\User', 5)->create();

        factory('App\Categoria', 3)->create();
    }
}
