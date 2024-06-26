<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cours extends Model
{
    use HasFactory;
    protected $guarded=["id",'vues'];
    public function files(){
        return $this->hasMany(Fichier::class);
    }

    public function getCover(){
        return Storage::url($this->cover);
    }

    public function chapitre(){
        return $this->belongsTo(Chapitre::class);
    }
}
