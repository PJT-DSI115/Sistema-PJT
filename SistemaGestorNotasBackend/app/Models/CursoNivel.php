<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoNivel extends Model
{
    use HasFactory;


    public function curso() {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function nivel() {
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }


    public function registroDocenteCurso() {
        return $this->hasMany(RegistroDocenteCurso::class, 'id_nivel_curso');
    }

}
