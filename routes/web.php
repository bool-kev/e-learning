<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Mail\OTPMail;
use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::prefix('user/')->controller(EleveController::class)->name('user.')->group(function (){
    Route::get('register/','registerForm')->name('registerForm');
    Route::post('register/','register')->name('register');
    Route::get('login/','loginForm')->name('login.form');
    Route::post('login/','login')->name('login');
    Route::post('logout/{user}/','logout')->name('logout');
    Route::get('otp_verification/','otpCheckForm')->name('otp.form');
    Route::post('otp_verification/','otpCheck')->name('otp');
    Route::get('pricing/','pricing')->name('pricing');
    Route::post('pricing/','subscribe')->name('subscribe');
});

Route::prefix('admin/')->name('admin.')->controller(AdminController::class)->group(function (){
    Route::get('/',function (){
        $faculte=Faculte::first();
        return redirect("/admin/{$faculte->id}");
    })->name('root');
    
    Route::prefix('chapitre/')->name('chapitre.')->controller(ChapitreController::class)->group(function (){
        Route::get('create/{matiere}/','create')->name('create');
        Route::post('create/{matiere}/','store')->name('store');
        Route::get('edit/{chapitre}/','edit')->name('edit');
        Route::post('edit/{chapitre}/','update')->name('update');
        Route::delete('destroy/{chapitre}/','destroy')->name('delete');
    });
    Route::prefix('cours/')->controller(CoursController::class)->name('cours.')->group(function (){
        Route::get('create/{chapitre}/','create')->name('create');
        Route::post('create/{chapitre}/','store')->name('store');
        Route::get('edit/{cours}/','edit')->name('edit');
        Route::post('edit/{cours}/','update')->name('update');
        Route::delete('destroy/{cours}/','destroy')->name('delete');
        Route::post('removeCover/{cours}/','removeCover')->name('cover.delete');
        Route::post('removeFile/{file}/','removeFile')->name('file.delete');
        Route::get('{slug}/{chapitre}/','index')->name('index');
    });
    Route::prefix('eval/')->controller(EvaluationController::class)->name('eval.')->group(function(){
        Route::get('eval','index')->name('index');
        Route::get('create/{matiere}','create')->name('create');
        Route::post('create/','store')->name('store');
        Route::get('edit/{eval}','edit')->name('edit');
        Route::post('edit/{eval)','update')->name('update');
        Route::get('show/{eval}','show')->name('show');
        Route::delete('destroy/{eval}/','destroy')->name('delete');

    });
    Route::prefix('question/')->controller(QuestionController::class)->name('question.')->group(function(){
        Route::post('create/','store')->name('store');
        Route::get('edit/{question}/','edit')->name('edit');
        Route::post('edit/{question}/','update')->name('update');
        Route::delete('destroy/{question}/','destroy')->name('delete');
    });
    Route::prefix('enseignant/')->controller(EnseignantController::class)->name('enseignant.')->group(function(){
        Route::get('list/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('create','store')->name('store');
        Route::get('edit/{user}','edit')->name('edit');
        Route::post('edit/{user}','update')->name('update');
        Route::delete('delete/{user}','destroy')->name('delete');
        Route::post('logout/','logout')->name('logout');

    });
    Route::prefix('eleve/')->controller(EleveController::class)->name('eleve.')->group(function(){
        Route::get('list/','index')->name('index');
        Route::get('edit/{eleve}','edit')->name('edit');
        Route::post('edit/{eleve}','update')->name('update');
        Route::delete('delete/{eleve}','destroy')->name('delete');
    });
    Route::get('{faculte}/','indexFaculte')->name('faculte.index');
    Route::get('{faculte}/{niveau}','index')->name('index');
});
Route::get('/',function(){
    return view('user.home');
    $faculte=Faculte::find(1);
    dd($faculte->matiere(1));
    $user=User::all()->last();
    $matieres=Matiere::with(['faculte','niveau'])->get();
    $niveaux=Niveau::with('matieres')->get();
    // dd($user->eleve->updated_at->diffInMinutes(now()));
    Mail::to($user->email)->send(new OTPMail($user));
    dd($niveaux[0]->matieres);
    
});
Route::get('cours/{cours}',function(Cours $cours){
    $cours->load('files');
    return view('cours',['cours'=>$cours]);
});