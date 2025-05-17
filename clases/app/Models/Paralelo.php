<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← AÑADE ESTA LÍNEA
use Illuminate\Database\Eloquent\Model;

class Paralelo extends Model
{
    use HasFactory; 
    protected $table = 'paralelos';
    protected $fillable = ['nombre'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
