<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = "coordinador";
    protected $fillable = ['id','nombre','correo','contraseña','imagen','id_carrera','state'];
}
