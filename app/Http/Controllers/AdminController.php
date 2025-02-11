<?php

namespace App\Http\Controllers;

use App\Models\Faculte;
use App\Models\Matiere;
use App\Models\Niveau;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    use Authorizable;
    function indexFaculte(Faculte $faculte){
        $level=$faculte->classes()->first();
        // $matiere=$faculte->matiere($level);
        return to_route('admin.index',['faculte'=>$faculte,'niveau'=>$level??0]);
        return view('admin.index',['current'=>$faculte,'current_level'=>$faculte->classes->first()]);
    }
    function index(Faculte $faculte,Niveau $niveau){
        $matiere=$faculte->matiere($niveau->id);
        if (! $matiere) throw new NotFoundHttpException('Cette faculte n\'est pas enseigner la-bas');
        return view('admin.index',['matiere'=>$matiere]);
    }

    function login(){
        
    }
}
