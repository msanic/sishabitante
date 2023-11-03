<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_cuota';

    protected $fillable = [
        'Id_habitante',
        'Id_tipo_cuota',
        'Fechacuota',
        'Monto_cuota',
        'Año_cuota',
        'id_usuario',
    ];

    public function habitante()
    {
        return $this->belongsTo(habitante::class, 'Id_habitante');
    }

    public function tipoCuota()
    {
        return $this->belongsTo(tipocuota::class, 'Id_tipo_cuota');
    }
    
}
