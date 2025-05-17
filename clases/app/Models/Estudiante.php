<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $fillable = ['nombre', 'cedula', 'correo', 'paralelo_id'];

    // (opcional) Relación con paralelo
    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class);
    }
}
