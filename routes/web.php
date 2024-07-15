<?php

use App\Models\User;
use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\TransactionController;


Route::prefix('user/')->controller(EleveController::class)->middleware('eleve','safe')->name('user.')->group(function (){
    Route::withoutMiddleware('safe')->group(function (){
        Route::withoutMiddleware('eleve')->group(function(){
            Route::get('register/','registerForm')->name('registerForm');
            Route::post('register/','register')->name('register');
            Route::get('login/','loginForm')->name('login.form');
            Route::post('login/','login')->name('login');
            Route::post('forgotPassword/','sendRequest')->name('request.send');
            Route::get('checkToken/{token}/','checkToken')->name('request.check');
        });
        Route::get('otp_verification/','otpCheckForm')->name('otp.form');
        Route::post('otp_verification/','otpCheck')->name('otp');
        Route::post('otp_generate/','dispatch')->name('otp.generate');
        Route::get('pricing/','pricing')->name('pricing');
        Route::post('pricing/','subscribe')->name('subscribe');
        Route::get('profile/edit/','profileEdit')->name('profile.edit');
        Route::post('profile/edit','profile')->name('profile.update');
        Route::match(['get','post'],'newPassword/','newPassword')->name('newPassword');
    });
    
    Route::prefix('transaction/')->controller(TransactionController::class)->name('trans.')->group(function(){
        Route::get('cancel/','cancel_url')->name('cancel');
        Route::post('cancel/','cancel_url')->name('cancel2');
        Route::get('return/','return_url')->name('return');
        Route::post('return/','return_url')->name('return2');
        Route::get('callback/','callback_url')->name('callback');
        Route::post('callback/','callback_url')->name('callback2');
    });
    Route::prefix('cours/')->controller(CoursController::class)->name('cours.')->group(function(){
        Route::get('','rootListing')->name('root');
        Route::get('show/{cours}/','show')->name('show');
        Route::post('comment/store',[CommentaireController::class,'store'])->withoutMiddleware(['eleve','safe'])->middleware('auth')->name('comment.store');
        Route::get('{chapitre}/','listing')->name('list');
    });
    Route::prefix('evaluation/')->controller(EvaluationController::class)->name('eval.')->group(function(){
        Route::post('submit/{eval}','submit')->name('submit');
        Route::get('correction/{eval}','solution')->name('solution');
        Route::get('{matiere}/','index')->name('index');
    });
});

Route::prefix('admin/')->name('admin.')->controller(AdminController::class)->middleware('staff')->group(function (){
    Route::get('/',function (){
        $faculte=Faculte::first();
        return redirect("/admin/{$faculte->id}");
    })->name('root');
    Route::withoutMiddleware('staff')->group(function(){
        Route::get('login/','loginForm')->name('login.form');
        Route::post('login/','login')->name('login');

    });
    
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
        Route::get('question/{cours}/','commentaires')->name('questions');
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
    Route::withoutMiddleware('staff')->middleware('admin')->group(function(){
        Route::prefix('enseignant/')->controller(EnseignantController::class)->name('enseignant.')->group(function(){
            Route::get('list/','index')->name('index');
            Route::get('create','create')->name('create');
            Route::post('create','store')->name('store');
            Route::get('edit/{user}','edit')->name('edit');
            Route::post('edit/{user}','update')->name('update');
            Route::delete('delete/{user}','destroy')->name('delete');
            Route::withoutMiddleware(['admin','staff'])->group(function(){
                Route::get('login/','loginForm')->name('login.form');
                Route::post('login/','login2')->name('login');
            });
    
        });
        Route::prefix('eleve/')->controller(EleveController::class)->name('eleve.')->group(function(){
            Route::get('list/','index')->name('index');
            Route::get('edit/{eleve}','edit')->name('edit');
            Route::post('edit/{eleve}','update')->name('update');
            Route::delete('delete/{eleve}','destroy')->name('delete');
        });
    });
    Route::get('{faculte}/','indexFaculte')->name('faculte.index');
    Route::get('{faculte}/{niveau}','index')->name('index');

});
Route::get('/',function(){
    return view('frontend.user.home');
})->name('home');
Route::get('enseignant/login/',[EnseignantController::class,'loginForm'])->name('login.form');
Route::post('enseignant/login/',[EnseignantController::class,'login2'])->name('login');
Route::post('logout/',[EleveController::class,'logout'])->middleware('auth')->name('logout');


