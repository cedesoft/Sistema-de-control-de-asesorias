<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agregados extends Model
{
    protected $table = "alumnos_agregados";
    protected $fillable = ['num_control'];
}
