<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'duree',
        'date',
        'matiere_id'
    ];

    public function matiere(){
        return $this->belongsTo(Matiere::class,'matiere_id');
    }

    public function questions():HasMany
    {
        return $this->hasMany(Question::class);
    }
}
