<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $fillable=['libelle'];
    public function matieres(){
        return $this->BelongsToMany(Faculte::class,'matieres')->as('matieres')->using(Matiere::class);
    }

    
}
