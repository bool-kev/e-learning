<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    private function giveServices(string $token)
    {   
        
        $trans=Transaction::where("token", $token)->first();
        $eleve=$trans->user->eleve;
        if($trans->plan==='standard') $eleve->is_active=1;
        elseif($trans->plan==='premium'){
            $eleve->is_active=1;
            $eleve->is_admin=1;
        };
        $eleve->save();
    }
    public function cancel_url(Request $request)
    {
        $user=Auth::user();
        $trans=$user->transactions->last();
        if ($trans->statut!=='valider') $trans->update(['statut'=>'anuller']);
        return back()->with('error','Vous avez annuler la transaction');
    }

    public function return_url(Request $request)
    {
        $user=Auth::user();
        $trans=$user->transactions->last();
        $HEADERS=[
            'Apikey'=>env('LIGDICASH_API_KEY'),
            'Authorization'=>'Bearer '.env('LIGDICASH_TOKEN'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        // dd(env('LIGDICASH_VERIF_ENDPOINT').$trans->token);
        if( $trans?->statut !=='valider')
        {
            $response=Http::withHeaders($HEADERS)->get(env('LIGDICASH_VERIF_ENDPOINT').$trans->token);
            if($response->successful()){
                $data=$response->json();
                if ($data['response_code']==='00')
                {
                    $trans->update([
                        'statut'=>'valider'
                    ]);
                    $this->giveServices($trans->token);
                } else return to_route('user.pricing')->with('error','une erreur s\'est produite');
            }else return to_route('user.pricing')->with('error','une erreur s\'est produite');
        }
        return to_route('admin.root');
        
    }

    public function callback_url(Request $request)
    {
        dd('callback');
        $payload = $request->getContent();
        $event = json_decode($payload);
 
        $token = $event->token;
        $transaction_id = $event->transaction_id;
        $status = $event->status;
 
        $transaction = Transaction::where('token', $token)->first(); // Ou avec le transaction_id ou tout autre identifiant unique
 
        if ($transaction->status === "en attente" && $status === "completed") {
            // Mettre à jour le statut de la transaction dans la base de données
            $transaction->status = "valider";
            $transaction->save();
            // Livrer le produit ou valider la commande
            $this->giveServices($transaction);
        }
    }
}
