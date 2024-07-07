<?php

namespace App\Http\Controllers;

use App\Events\EmailCheckEvent;
use App\Http\Requests\EleveFormRequest;
use App\Mail\OTPMail;
use App\Models\Eleve;
use App\Models\Niveau;
use App\Models\Transaction;
use App\Models\User;
use App\View\Components\session;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class EleveController extends Controller
{
    public function registerForm():View{
        return view('user.form',['niveaux'=>Niveau::all(),'eleve'=>new Eleve()]);
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
        return view('user.form',['niveaux'=>Niveau::all(),'eleve'=>new Eleve()]);
    }

    public function login(Request $request){
        
        $credentials=$request->validate([
            "email"=>['email','nullable'],
            'telephone'=>['digits:8','numeric','nullable'],
            "password"=>['string','required'],
            'remember'=>['nullable']
        ]);
        $credentials=array_filter($credentials,function ($elt) {return $elt;});
        if(count($credentials)<2) return back()->withErrors(['fields'=>'Renseignez au moins un email ou un numero de telephone']);
        $remember=$credentials['remember']??false;
        unset($credentials['remember']);
        $credentials['statut']="etudiant";
        // dd($credentials,$remember);
        if(Auth::attempt($credentials,$remember)){
            session()->regenerate();
            $user=Auth::user();
            if($user->eleve){
                if ( $user->eleve->token !=='verified') {
                    event(new EmailCheckEvent($user));
                    return to_route('user.otp.form')->with('error','Votre compte a ete creer,Veuillez confirmer votre email');
                }
                elseif(! $user->eleve->is_active) return to_route('user.pricing');
                else dd('dashboard');
            }else{
                dd($user);
            }
        }
        return back()->with('error','Identifiants incorrects');
    }

    public function otpCheckForm(){
        $user=Auth::user();
        return view('user.otp',$user);
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
        if($user->eleve->updated_at->diffInMinutes(now())>1) {
            event(new EmailCheckEvent($user));
            return back()->with('error','OTP expire un nouveau vous a ete envoye');
        }elseif ( $otp!==$user->eleve->token){
            return back()->with('error','OTP invalid!Ressayez');
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

    public function logout(User $user){
        Auth::logout();
        return to_route('user.login.form')->with('info','vous avez ete deconnecter');
    }

    public function pricing()
    {
        return view('user.pricing');
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
        $user=User::find(1);
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
                    "customer" => "22676275726", // Format : 22676275726 or 22997761182
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
                    "cancel_url" => env('LIGDICASH_CANCEL_URL'),
                    "return_url" => env('LIGDICASH_RETURN_URL'),
                    "callback_url" => env('LIGDICASH_CALLBACK_URL')
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
