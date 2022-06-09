<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public function cargaAcademica (){
        return $this->hasMany(CargaAcademica::class, 'id_alumno');
    }
}
