<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitante extends Model
{
    use HasFactory;
    protected $table='habitantes';
    
    protected $primaryKey = 'Id_habitante';

    protected $fillable = [
        'Nombre_habitante',
        'Apellido_habitante',
        'Cui_habitante',
        'Genero_habitante',
        'Fechanac_habitante',
        'Paraje'
    ];
    public function quejas()
{
    return $this->hasMany(Queja::class, 'Habitante_queja', 'Id_habitante');
}
public function cuotas()
{
    return $this->hasMany(Cuota::class, 'Id_habitante');
}

}



