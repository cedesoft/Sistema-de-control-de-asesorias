<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    protected $table = "materias";
    protected $fillable = ['id','nombre','descripcion','creditos','horas','semestre','id_carrera','id_docente','state'];
    protected $guarded = [];
}
