<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    protected $fillable = ['name','path'];

    protected $primaryKey = 'id';
    public $incrementing = true;
}
