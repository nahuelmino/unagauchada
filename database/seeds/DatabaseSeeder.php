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

        factory('App\Gauchada', 15)->create();

        $calificaciones = [
            'Buena' => 2,
            'Neutra' => 0,
            'Mala' => -1
        ];

        foreach($calificaciones as $name => $score) {
            \App\Calificacion::create([
                'name' => $name,
                'score' => $score
            ]);
        }

        $rangos = [
            'Mala Persona' => -1,
            'Observador' => 0,
            'Buena Persona' => 1
        ];

        foreach($rangos as $nombre => $valor) {
            \App\Rango::create([
                'nombre' => $nombre,
                'valor' => $valor
            ]);
        }
    }
}
