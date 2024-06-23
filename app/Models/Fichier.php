<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Fichier extends Model
{
    use HasFactory;
    protected $fillable=[
        'path',
        'type',
        'cours_id'
    ];
    public function getUrl(){
        return Storage::url($this->path);
    }
}
