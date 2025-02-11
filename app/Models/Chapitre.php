<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'matiere_id'
    ] ;

    public function cours(){
        return $this->hasMany(Cours::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }
}
