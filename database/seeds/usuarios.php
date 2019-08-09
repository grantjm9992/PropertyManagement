<?php

use Illuminate\Database\Seeder;
use App\User;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     protected $table = "usuarios";
    public function run()
    {
        //

        User::create(array(
            'nombre' => 'Grant',
            'apellidos' => 'MacDonald',
            'correo_electronico' => 'grant.macdonald@avanzo.com',
            'password' => Hash::make('password')
        ));
    }
}
