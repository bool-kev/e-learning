<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getPublicUrl(){
        return Storage::disk('public')->url($this->path);
    }

    public function getPreview()
    {
        if (in_array($this->type, ['image/jpg','image/png'])) {
            return $this->getUrl();
        }elseif($this->type=="application/pdf") return Storage::url('Preview/text2.png');
        else return Storage::url('Preview/video.png');
    }

    public function is_type(string $type)
    {
        return Str::startsWith($this->type, $type);
    }
    
    public function commentaires(){
        return $this->hasMany(Commentaire::class);
    }
}
