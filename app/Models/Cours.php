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
        return Storage::disk('public')->url($this->cover);
    }

    public function chapitre(){
        return $this->belongsTo(Chapitre::class);
    }

    public function commentaires(){
        return $this->hasMany(Commentaire::class)->where('reponse',null);
    }

    public function getFiles(string $type){
        return $this->files()->where('type','like',"%$type%")->get();
    }
}
