<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramites extends Model
{
    use HasFactory;

    protected $table = 'tramites';

    protected $fillable = [
        'id',
        'name',
        'apellidos',
        'dni',
        'email',
        'descriptcion_padre',
        'tramite_nombre',
        'telefono',
        'archivo_padre',
        'fecha',
        'tramite_estado',
        'archivo_descargar_admin',
        'visto',
        'descriptcion_recepcionista',
    ];
}
