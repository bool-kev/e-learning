<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function is_composer(Evaluation $eval)
    {
        return $this->notes->where('evaluation_id',$eval->id)->first();
    }
}
