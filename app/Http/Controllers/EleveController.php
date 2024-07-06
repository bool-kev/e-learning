<?php

namespace App\Http\Controllers;

use App\Events\EmailCheckEvent;
use App\Http\Requests\EleveFormRequest;
use App\Mail\OTPMail;
use App\Models\Eleve;
use App\Models\Niveau;
use App\Models\User;
use App\View\Components\session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EleveController extends Controller
{
    public function registerForm():View{
        return view('user.register',['niveaux'=>Niveau::all(),'eleve'=>new Eleve()]);
    }

    public function register(EleveFormRequest $request){
        $data=$request->validated();
        $user=User::create($data);
        $eleve=Eleve::create([
            "niveau_id" =>$data['niveau'],
            "user_id" =>$user->id
        ]);
        event(new EmailCheckEvent($user));
        Auth::login($user);
        return to_route('user.otp.form')->with('success','Inscription reussi!Verifier votre mail');
    }
    public function loginForm():View{
        $user=User::find(1);
        dd($user->eleve->niveau->matieres[0]->pivot->chapitres);
        return view('user.login');
    }

    public function login(Request $request){
        
        $credentials=$request->validate([
            "email"=>['email','required'],
            "password"=>['string','required']
        ]);
        if(Auth::attempt($credentials)){
            session()->regenerate();
            $user=Auth::user();
            if ( $user->eleve->token !=='verified') {
                event(new EmailCheckEvent($user));
                return to_route('user.otp.form');
            }
            elseif(! $user->eleve->is_active) dd('payement requis');
            else dd('dashboard');
        }
        return back()->with('error','Identifiants incorrects');
    }

    public function otpCheckForm(){
        return view('user.otp');
    }

    public function otpCheck(Request $request){
        // dd(Auth::user());
        $regles=['required','digits:1'];
        $otp=$request->validate([
            'field1'=>$regles,
            'field2'=>$regles,
            'field3'=>$regles,
            'field4'=>$regles,
            'field5'=>$regles,
            'field6'=>$regles
        ]);
        $user=Auth::user();

        if ( implode($otp)!==$user->eleve->token){
            return back()->withInput($otp)->with('error','OTP invalidd');
        }elseif($user->eleve->updated_at->diffInMinutes(now())>1) {
            event(new EmailCheckEvent($user));
            return back()->with('error','OTP expire un nouveau a ete genere ');
        }
            
        $user->eleve->update(['token'=>'verified']);
        return to_route('user.login')->with('success','votre mail a ete confirme veuillez vous connecter');
        
    }

    public function index()
    {
        $eleve=Eleve::with('user','niveau')->get();
        return view('admin.users.eleve.index',['eleves'=>$eleve]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eleve $eleve)
    {
        return view('user.register',['eleve'=>$eleve]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EleveFormRequest $request, Eleve $eleve)
    {
        $data=$request->validated();
        $eleve->user->update($data);
        $eleve->update($data);
        return to_route('admin.eleve.index')->with('success','eleve mofifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleve $eleve)
    {
        $eleve->user->delete();
        return to_route('admin.eleve.index')->with('success','compte eleve supprimer avec success');
    }
}
