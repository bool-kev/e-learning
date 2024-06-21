<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faculte extends Model
{
    use HasFactory;
    protected $fillable=['libelle'];

    public function classes(){
        return $this->BelongsToMany(Niveau::class,'matieres')->as('matieres')->using(Matiere::class)->withTimestamps()->withPivot('id');
    }

   public function matiere(int $niveau){
    return $this->classes()->wherePivot('niveau_id',$niveau)->first()->matieres;
   }

    
}
