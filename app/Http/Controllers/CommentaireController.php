<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Events\Validated;
use App\Models\Commentaire;
use App\Models\Eleve;

class CommentaireController
{

    public function store(Request $request){
        $data=$request->validate([
            'cours_id' => 'required|exists:cours,id',
            'content'=>'required|string',
            'reponse'=>'exists:commentaires,id|nullable',
        ]);
        $data['user_id']=$request->user()->id;
        Commentaire::create($data);
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }
}
