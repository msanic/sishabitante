<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matricula'; 
    protected $primaryKey = 'Id_matricula';

    protected $fillable = [
        'Id_habitante', 
        'Monto_matricula', 
        'Fechamatricula', 
        'Descripcion_matri',
        'id_usuario',
    ];

    public function habitante()
    {
        return $this->belongsTo(Habitante::class, 'Id_habitante', 'Id_habitante');
    }
}
