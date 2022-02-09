<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asitencia extends Model
{
    use HasFactory;

    protected $table = "asitencias";

    protected $fillable = [
        'user_id',
        'hora_salida',
        'hora_entrada',
        'fecha',
        'asistio',
        'description',
        'description_salida',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
