<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $table = 'alumnos';
    protected $fillable = ['id','nombre','correo','contraseña','imagen','id_carrera','state'];
    protected $guarded = [];
}
