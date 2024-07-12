<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Faculte;
use App\Models\Matiere;
use App\Models\Niveau;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    use Authorizable;
    function indexFaculte(Faculte $faculte){
        $level=$faculte->classes()->first();
        // $matiere=$faculte->matiere($level);
        return to_route('admin.index',['faculte'=>$faculte,'niveau'=>$level??0]);
    }
    function index(Faculte $faculte,Niveau $niveau){
        $matiere=$faculte->matiere($niveau->id);
        if (! $matiere) throw new NotFoundHttpException('Cette faculte n\'est pas enseigner la-bas');
        return view('admin.index',['matiere'=>$matiere]);
    }

    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data=$request->validate([
            'email'=>['required','email'],
            'password'=>'required',
            'remember'=>['nullable']
            ]
        );
        $remember=$data['remember']??false;
        unset($data['remember']);
        $data['statut']='admin';
        $route=session('target')??route('admin.root');
        Session::forget('target');
        if (Auth::attempt($data,$remember)) {
            session()->regenerate();
            $user=Auth::user();
            return redirect($route);
        }
        return back()->with('error','identifiants incorrect');
    }

}
