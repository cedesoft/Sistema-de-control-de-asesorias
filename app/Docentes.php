<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    protected $table = "docentes";
    protected $fillable = ['id','nombre','correo','contraseña','imagen','id_carrera','state'];
    protected $guarded = [];
}
