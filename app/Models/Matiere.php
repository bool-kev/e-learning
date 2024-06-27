<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Matiere extends Pivot
{
    use HasFactory;
    protected $table='matieres';

    public function faculte(){
        return $this->belongsTo(Faculte::class);
    }
    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function chapitres():HasMany{
        return $this->hasMany(Chapitre::class,'matiere_id');
    }

    public function evaluations():HasMany{
        return $this->hasMany(Evaluation::class,'matiere_id');
    }
}
