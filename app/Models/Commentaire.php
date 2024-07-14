<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $table = 'commentaires';
    protected $fillable=['cours_id','user_id','reponse','content'];

    public function reponses(){
        return $this->hasMany(Commentaire::class,'reponse');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
