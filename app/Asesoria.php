<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    protected $fillable = ['status','fechaSolicitud','fechaRealizacion','fechaTerminacion','lugar','unidad','tema','id_docente','id_materia','id_alumno','observaciones','state'];
}
