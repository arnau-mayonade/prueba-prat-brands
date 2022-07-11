<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_municipio',
        'id_provincia',
        'cod_municipio',
        'dc',
        'nombre'
    ];
}
