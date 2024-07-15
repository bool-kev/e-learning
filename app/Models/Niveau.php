<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $fillable=['libelle'];
    
    
    public function eleves(){
        return $this->hasMany(Eleve::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class,'niveau_id')->whereHas('chapitres');
    }

    
}
