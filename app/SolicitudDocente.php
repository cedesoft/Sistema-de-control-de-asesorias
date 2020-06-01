<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudDocente extends Model
{
    protected $table = "solicitud_docentes";
    protected $fillable = ['id','status','fechaSolicitud','fecha_realizacion','fecha_terminacion','lugar','tema','unidad','situacion_academica','id_docente','id_materia','id_alumno','state'];
}
