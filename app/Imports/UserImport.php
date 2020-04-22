<?php

namespace App\Imports;

use App\User;
use App\Roles;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            "name" => $row['nombre'],
            "email" => $row['correo'],
            "password" => Hash::make($row['pass']),
        ]);

        $user->roles()->attach(Roles::where('nombre', $row['rol'])->first());

        return $user;
    }
}
