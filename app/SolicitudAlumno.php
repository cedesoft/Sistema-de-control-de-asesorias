<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAlumno extends Model
{
    protected $table = "solicitud_alumnos";
    protected $fillable = ['id','status','fechaSolicitud','tema','unidad','situacion_academica','id_docente','id_materia','id_alumno','state'];
}
