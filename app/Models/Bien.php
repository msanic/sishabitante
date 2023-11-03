<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $table = 'bienes';
    protected $primaryKey = 'Id_bien';
    public $timestamps = false;
    protected $fillable = ['Nombre_bien', 'Descripcion_bien', 'Fecha_ingreso', 'Valor_bien'];
}