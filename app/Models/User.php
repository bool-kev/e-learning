<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'telephone',
        'matricule',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function eleve(){
        return $this->hasOne(Eleve::class);
    }

    public function is_staff():bool
    {
        return boolval($this->statut==="admin"||$this->statut==="enseignant");
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function full_name(){
        return $this->prenom.' '.$this->nom;
    }

    public function getAvatar(){
        return $this->photo?Storage::url($this->photo):asset('images/about-img.jpg');
    }
}
