<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_escuela',
        'telefono_escuela',
        'facebook_esculea',
        'frase_escuela',
        'description',
    ];
}
