<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants=User::where('statut','enseignant')->get();
        return view('admin.users.teach.index',['enseignants'=>$enseignants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.teach.form',['user'=>new User()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'matricule'=>['required','alpha_num','min:4','unique:users,matricule'],
            'nom'=>['string','min:2'],
            'prenom'=>['string','min:2'],
            'email'=>['email','required','unique:users,id'],
            'password'=>['required','confirmed','min:4']
        ]);
        $user=new User($data);
        $user->statut='enseignant';
        $user->save();
        return to_route('admin.enseignant.index')->with('success','enseignant ajoute avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.teach.form',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data=$request->validate([
            'matricule'=>['required','alpha_num','min:4',"unique:users,matricule,$user->id"],
            'nom'=>['string','min:2'],
            'prenom'=>['string','min:2'],
            'email'=>['email','required','unique:users,id'],
        ]);
        $user->update($data);
        return to_route('admin.enseignant.index')->with('success','enseignant mofifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.enseignant.index')->with('success','compte enseignant avec success');
    }

    public function loginForm(Request $request)
    {
        return view('admin.users.teach.login');
    }

    public function login2(Request $request){
        $data=$request->validate([
            "matricule"=>['alpha_num','required'],
            "password"=>['string','required'],
            'remember'=>['nullable']
        ]);
        $remember=$credentials['remember']??false;
        unset($credentials['remember']);
        $data['statut']='enseignant';
        if (Auth::attempt($data,$remember)) {
            session()->regenerate();
            $user=Auth::user();
            $route=session('target')??route('admin.root');
            Session::forget('target');
            return redirect($route);
        }
        return back()->with('error','identifiants incorrect');
    }
}
