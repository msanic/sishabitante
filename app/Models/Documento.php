<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'Id_documento';
    public $timestamps = false;
    protected $fillable = ['Nombre_doc', 'Fechadocumento', 'Descripcion', 'Archivo','id_usuario'];
}