<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paquetePersona extends Model
{
    protected $fillable = ['nombre_persona','nit','direccion','telefono','estado','id_paquete'];
}
