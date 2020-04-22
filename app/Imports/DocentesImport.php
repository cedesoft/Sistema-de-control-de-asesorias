<?php

namespace App\Imports;

use App\Docentes;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class DocentesImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Docentes([
            "nombre" => $row['nombre'],
            "correo" => $row['correo'],
            "contraseña" => $row['pass'],
            "imagen" => $row['imagen'],
            "id_carrera" => $row['carrera'],
        ]);
    }
}
