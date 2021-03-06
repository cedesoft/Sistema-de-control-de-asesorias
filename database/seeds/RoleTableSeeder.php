<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Roles();
        $role->nombre = 'admin';
        $role->descripcion = 'Administrator';
        $role->save();

        $role = new Roles();
        $role->nombre = 'user';
        $role->descripcion = 'usuario';
        $role->save();
    }
}
