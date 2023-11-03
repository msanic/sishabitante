<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;
    
    protected $table = 'comites';
    protected $primaryKey = 'Id_comite';

    protected $fillable = [
        'Nombre_comite','id_usuario',
    ];
    public function proyectos()
{
    return $this->hasMany('App\Models\Proyecto', 'Id_comite', 'Id_comite');
}

}
