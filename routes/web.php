<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\UserController;
use App\Mail\OTPMail;
use App\Models\Faculte;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::prefix('user/')->controller(EleveController::class)->name('user.')->group(function (){
    Route::get('register','registerForm')->name('registerForm');
    Route::post('register','register')->name('register');
    Route::get('login','loginForm')->name('login.form');
    Route::post('login','login')->name('login');
    Route::get('otp_verification','otpCheckForm')->name('otp.form');
    Route::post('otp_verification','otpCheck')->name('otp');
    
});

Route::prefix('admin/')->name('admin.')->controller(AdminController::class)->group(function (){
    Route::get('/',function (){
        $faculte=Faculte::first();
        $niveau=$faculte->classes->first();
        return redirect("/admin/".Str::slug($faculte->libelle).'-'.$faculte->id.'/'.Str::slug($niveau->libelle).'-'.$niveau->id);
    });
    Route::get('/{slug}-{faculte}/{slug2}-{niveau}','index')->name('index');
    Route::resource('chapitre',ChapitreController::class)->except(['index']);
});
Route::get('/',function(){
    $user=User::all()->last();
    $matieres=Matiere::with(['faculte','niveau'])->get();
    $niveaux=Niveau::with('matieres')->get();
    // dd($user->eleve->updated_at->diffInMinutes(now()));
    Mail::to($user->email)->send(new OTPMail($user));
    dd($niveaux[0]->matieres);
    
});