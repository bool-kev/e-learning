<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Eleve;
use App\Models\Niveau;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\EmailCheckEvent;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EleveFormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EleveController extends Controller
{
    private function route(User $user)
    {
        if($user){
            $route=session('target')??route('user.cours.root');
            Session::forget('target');
            if($user->eleve){
                if ( $user->eleve->token !=='verified') {

                    event(new EmailCheckEvent($user));
                    return to_route('user.otp.form')->with('error','Votre compte a ete creer,Veuillez confirmer votre email');
                }
                elseif(! $user->eleve->is_active) return to_route('user.pricing');
                elseif ($user->eleve->is_active) return redirect($route);
            }
        }
    }
    public function registerForm():View{
        return view('frontend.user.form',['niveaux'=>Niveau::all(),'eleve'=>new Eleve()]);
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
    public function loginForm(){
        $user=Auth::user();
        if ($user?->eleve) return $this->route($user);
        return view('frontend.user.form',['niveaux'=>Niveau::all(),'eleve'=>new Eleve()]);
    }

    public function login(Request $request){
        
        $credentials=$request->validate([
            "email"=>['email','nullable'],
            'telephone'=>['digits:8','numeric','nullable'],
            "password"=>['string','required'],
        ]);
        $credentials=array_filter($credentials,function ($elt) {return $elt;});
        if(count($credentials)<2) return back()->withErrors(['fields'=>'Renseignez au moins un email ou un numero de telephone']);
        $remember=$request->boolean('remember',false);
        $credentials['statut']="etudiant";
        if(Auth::attempt($credentials,$remember)){
            session()->regenerate();
            $user=Auth::user();
            // dd('connecetd');
            $this->route($user);
        }
        return back()->with('error','Identifiants incorrects');
    }

    public function otpCheckForm(){
        $user=Auth::user();
        if($user->eleve?->token==='verified') abort(403,'cette page vous est interdite');
        return view('frontend.user.otp');
    }

    public function otpCheck(Request $request){
        $user=Auth::user();
        $regles=['required','digits:1'];
        $data=$request->validate([
            'fields'=>['required','array','min:6','max:6'],
            'fields.*'=>['required','digits:1']
        ]);
        $user=Auth::user();
        $otp=implode($data['fields']);
        if($user->eleve->updated_at->diffInMinutes(now())>5) {
            event(new EmailCheckEvent($user));
            return back()->with('error','OTP expire un nouveau vous a ete envoye');
        }elseif ( $otp!==$user->eleve->token){
            return back()->with('error','OTP invalid!Ressayez');
        }
            
        $user->eleve->update(['token'=>'verified']);
        return to_route('user.login')->with('success','votre mail a ete confirme veuillez vous connecter');
        
    }
    public function dispatch(Request $request)
    {
        if ($request->user()?->eleve?->token!=='verified') event(new EmailCheckEvent($request->user()));
        return back()->with('success','un nouveau otp a ete generer');
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
        return view('frontend.user.register',['eleve'=>$eleve]);
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

    public function logout(){
        Auth::logout();
        return to_route('home')->with('info','vous avez ete deconnecter');
    }

    public function profileEdit()
    {
        return view('frontend.user.profile');
    }

    public function profile(Request $request)
    {
        $user=$request->user();
        $data=$request->validate([
            'photo'=>['image','nullable','max:3072'],
            'nom'=>['min:2','string','nullable'],
            'prenom'=>['min:2','string','nullable'],
            'telephone'=>['required',"unique:users,telephone,$user->id"],
        ]);
        if($request->input('current_password')){
            $credentials=$request->validate([
                'current_password'=>['required','current_password'],
                'password'=>['required','confirmed']
            ]);
            $data=array_merge($data,$credentials);
        }
        if($data['photo']??false)
        {
            if($user->photo) Storage::disk('public')->delete($user->photo);
            $data['photo']=$data['photo']->store('Avatar','public');
        }
        $user->update($data);
        return back()->with('success','Profils mis a jour');

    }

    //password reset
    public function sendRequest(Request $request)
    {
        $data=$request->validate([
            'email'=>['required','email','max:240']
        ]);
        if($user=User::where('email',$data['email'])->first())
        {
            $token=Str::random(64);
            DB::table('password_reset_tokens')->upsert([
                'email'=> $data['email'],
                'token'=> $token,
                'created_at'=>Carbon::now()
            ],['email'],['token','created_at']);
            Mail::to($data['email'])->send(new PasswordResetMail($token,$user));
        }
        return back()->with('success','un email de renitialisation vous a ete envoye');
    }

    public function checkToken(string $token)
    {
        if($row=DB::table('password_reset_tokens')->where('token',$token)->first())
        {
            if($user=User::where('email',$row->email)->first()){
                Auth::login($user);
                session()->regenerate();
                DB::table('password_reset_tokens')->where('email',$user->email)->delete();
                return to_route('user.newPassword');
            }
        }
        return back()->with('error','le token est invalide');
    }

    public function newPassword(Request $request)
    {
        if($request->isMethod('POST')){
            $user=$request->user();
            $data=$request->validate([
                'password'=>['required','min:4','confirmed']
            ]);
            $user->update($data);
            return to_route('user.cours.root');
        }
        return view('frontend.user.newPassword');
    }

    public function pricing()
    {
        return view('frontend.user.pricing');
    }

    private function getTransID()
    {
        return "TransId".date('Ymd-His').rand(1,10000);
    }

    public function subscribe(Request $request)
    {
        $prix=[
            'standard'=>100,
            'premium'=>150
        ];
        $plan=$request->validate([
            'plan'=>['required','in:standard,premium']
        ]);
        $plan=$request->input('plan');
        $user=Auth::user();
        $transId=$this->getTransID();
        // dd($plan,$this->getTransID());

        $HEADERS=[
            'Apikey'=>env('LIGDICASH_API_KEY'),
            'Authorization'=>'Bearer '.env('LIGDICASH_TOKEN'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        // dd($HEADERS);
        $payload = [
            "commande" => [
                "invoice" => [
                    "items" => [
                        [
                            "name" => "Abonnement annuel",
                            "description" => "Abonnent a l'offre $plan",
                            "quantity" => 1,
                            "unit_price" => $prix[$plan],
                            "total_price" => $prix[$plan]
                        ]
                    ],
                    "total_amount" => $prix[$plan],
                    "devise" => "XOF",
                    "description" => "abonnement annuel a l'offre $plan",
                    "customer" => "$user->telephone", // Format : 22676275726 or 22997761182
                    "customer_firstname" => "$user->nom",
                    "customer_lastname" => "$user->prenom",
                    "customer_email" => "$user->email",
                    "external_id" => "",
                    "otp" => "" // Laisser vide si non applicable
                ],
                "store" => [
                    "name" => "SENSEI E-SCHOOL",
                    "website_url" => "http://127.0.0.1:8000/"
                ],
                "actions" => [
                    "cancel_url" => route('user.trans.callback'),
                    "return_url" => route('user.trans.return'),
                    "callback_url" => route('user.trans.callback2')
                ],
                "custom_data" => [
                    "transaction_id" => "$transId"
                ]
            ]
        ];
        // /** @var  Response*/
        $response=Http::withHeaders($HEADERS)->asJson()->post(env('LIGDICASH_PAY_IN_ENDPOINT'),$payload);
        if($response->successful()){
            $data=$response->json();
            if ($data['response_code']==='00'){
                // dd($data);
                Transaction::create([
                    'transid'=>$transId,
                    'token'=> $data['token'],
                    'plan'=>$plan,
                    'user_id'=>$user->id
                ]);
                return redirect($data['response_text']);
            }
        }
        return back()->with('error','Une erreur s\'est produite');
    }
}
