<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $table = 'gastos';
    protected $primaryKey = 'Id_gastos';
    
    protected $fillable = [
        'Fecha_gastos',
        'Descripcion_gastos',
        'Monto_gastos',
        'id_usuario',
    ];

    public $timestamps = false;
}
