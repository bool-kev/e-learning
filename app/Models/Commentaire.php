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

    public function getUser(User $user)
    {
        return $user->id===$this->user->id?'moi':$this->user->full_name();
    }
    
}
