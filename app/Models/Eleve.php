<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;
    protected $fillable=[
        'niveau_id',
        'user_id',
        'token'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }
}
