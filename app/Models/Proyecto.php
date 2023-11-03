<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $primaryKey = 'Id_proyecto';

    protected $fillable = [
        'Nombre_proyecto',
        'Id_comite',
        'Descripcion_proyecto',
        'Fecha_autorizacion',
        'Fecha_inicio',
        'Fecha_fin',
        'id_usuario',
        ''
    ];
    
    protected $casts = [
        'Fecha_autorizacion' => 'datetime:d-m-Y',
        'Fecha_inicio' => 'datetime:d-m-Y',
        'Fecha_fin' => 'datetime:d-m-Y',
    ];

    public $timestamps = false;

    public function comite()
    {
        return $this->belongsTo(Comite::class, 'Id_comite', 'Id_comite');
    }
}
