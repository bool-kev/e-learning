<?php

namespace App\Http\Controllers;

use App\Models\Faculte;
use App\Models\Matiere;
use App\Models\Niveau;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use Authorizable;
    function index(string $slug,Faculte $faculte,string $slug2,Niveau $niveau){
        // dd(Faculte::find(1)->classes[0]->matieres);
        // $facultes=Faculte::with('classes')->get();
        // $cible=Matiere::where('niveau_id',1)->where('faculte_id',1)->first();
        // dd($facultes[0]->matiere(1));

        return view('admin.index',['facultes'=>Faculte::all(),'current'=>$faculte,'current_level'=>$niveau]);
    }

    function login(){
        
    }
}
