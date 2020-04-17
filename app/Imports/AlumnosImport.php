<?php

namespace App\Imports;

use App\Alumnos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnosImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumnos([
            "id" => $row['id'],
            "nombre" => $row['nombre'],
            "correo" => $row['correo'],
            "contraseña" => $row['pass'],
            "imagen" => $row['imagen'],
            "id_carrera" => $row['carrera'],
        ]);
    }
}
