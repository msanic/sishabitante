<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCuota extends Model
{
    use HasFactory;

    protected $table = 'tipocuota'; // Aquí está el nombre correcto de la tabla
    protected $primaryKey = 'Id_tipo_cuota';

    protected $fillable = [
        'Descripcion',
    ];

    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'Id_tipo_cuota');
    }
}
