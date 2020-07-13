<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ofertas extends Model
{
    protected $fillable = ['nombre_oferta','precio_oferta','descripcion','id_img'];
}
