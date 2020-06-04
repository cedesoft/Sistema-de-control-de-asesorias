<?php

namespace App\Imports;

use App\Materias;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class MateriasImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Materias([
            "id" => $row['id'],
            "nombre" => $row['nombre'],
            "descripcion" => $row['descripcion'],
            "creditos" => $row['creditos'],
            "horas" => $row['horas'],
            "semestre" => $row['semestre'],
            "id_carrera" => $row['carrera'],
            "id_docente" => $row['docente'],
        ]);
    }
}
