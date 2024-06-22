<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CoursController;
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
    Route::prefix('chapitre/')->name('chapitre.')->controller(ChapitreController::class)->group(function (){
        Route::get('create/{matiere}','create')->name('create');
        Route::post('create/{matiere}','store')->name('store');
        Route::get('edit/{chapitre}','edit')->name('edit');
        Route::post('edit/{chapitre}','update')->name('update');
        Route::delete('destroy/{chapitre}','destroy')->name('delete');
    });
    Route::prefix('cours/')->controller(CoursController::class)->name('cours.')->group(function (){
        Route::get('create/{chapitre}/','create')->name('create');
        Route::post('create/{chapitre}/','store')->name('store');
        Route::get('edit/{cours}/','edit')->name('edit');
        Route::post('edit/{cours}/','update')->name('update');
        Route::delete('destroy/{cours}','destroy')->name('delete');
        Route::get('{slug}/{chapitre}/','index')->name('index');
    });
    Route::get('/{slug}-{faculte}/{slug2}-{niveau}','index')->name('index');
});
Route::get('/',function(){
    $user=User::all()->last();
    $matieres=Matiere::with(['faculte','niveau'])->get();
    $niveaux=Niveau::with('matieres')->get();
    // dd($user->eleve->updated_at->diffInMinutes(now()));
    Mail::to($user->email)->send(new OTPMail($user));
    dd($niveaux[0]->matieres);
    
});