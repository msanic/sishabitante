<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queja extends Model
{
    use HasFactory;
    protected $primaryKey = 'Id_queja';
  
public function habitante()
{
    return $this->belongsTo(Habitante::class, 'Habitante_queja', 'Id_habitante');
}
public function habitante_quejado()
{
    return $this->belongsTo(Habitante::class, 'Habitante_quejado', 'Id_habitante');
}

}

