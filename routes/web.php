<?php

use App\Http\Controllers\AxtarController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\ElaqeController;
use App\Http\Controllers\HaqqimizdaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\MutexessisController;
use App\Http\Controllers\PasswordUnutmusamController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserElanController;
use App\Http\Controllers\VakansiyalarController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['isLogin'])->group(function(){ //Əgər giriş edibsə bizi göndərir index routuna
    Route::get('/giris-et',[LoginController::class,'index'])->name('login.index');
    Route::post('/giris-et/emeliyyat',[LoginController::class,'login'])->name('login.login');
    Route::get('/qeydiyyatdan-kec',[SignupController::class,'index'])->name('signup.index');
    Route::post('/qeydiyyatdan-kec/emeliyyat',[SignupController::class,'signup'])->name('signup.signup');

    Route::get('/sifre-unutmusam/email',[PasswordUnutmusamController::class,'index'])->name('unutmusam.email');
    Route::post('/sifre-unutmusam/link-gonder',[PasswordUnutmusamController::class,'linkGonder'])->name('unutmusam.linkGonder');
    Route::get('/sifre-unutmusam/link-ok/{token}',[PasswordUnutmusamController::class,'mailLinkOk'])->name('unutmusam.mailLinkOk');
    Route::post('/sifre-unutmusam/sifre-sifirla',[PasswordUnutmusamController::class,'resetPassword'])->name('unutmusam.resetPassword');
});

Route::middleware(['notLogin'])->group(function(){ //Əgər giriş etmiyibsə bizi göndərir index routuna
    Route::get('/logout',[LogOutController::class,'logout'])->name('logout');
});

Route::middleware(['CVnotLogin'])->group(function(){
    Route::get('/istifadeci/istifadeci-cv/cv-yerleshdir',[CVController::class,'index'])->name('cv.index');
    Route::post('/istifadeci/istifadeci-cv/cv-yerleshdir/emeliyyat',[CVController::class,'cv_yarat_post'])->name('cv.yarat');
    Route::get('/istifadeci/istifadeci-cv',[CVController::class,'user_cv'])->name('cv.user_cv');
    Route::get('/istifadeci/istifadeci-cv/yenile',[CVController::class,'cv_update_index'])->name('cv.update.index');
    Route::post('/istifadeci/istifadeci-cv/yenile/emiliyyat',[CVController::class,'cv_update'])->name('cv.update');
    Route::get('/istifadeci/istifadecis-cv/sil-emeliyyat',[CVController::class,'cv_user_delete'])->name('cv.user.delete');



    Route::get('/istifadeci/elanlar',[UserElanController::class,'user_elanlar_index'])->name('elan.user.index');//
    Route::get('/istifadeci/elanlar/{elan_id}',[UserElanController::class,'user_elan_detal'])->name('elan.user.detal');//
    Route::get('/istifadeci/elan-yerlesdir',[UserElanController::class,'elan_add_index'])->name('elan.add.index');//
    Route::post('/istifadeci/elan-yerlesdir/emeliyyat',[UserElanController::class,'elan_add_post'])->name('elan.add.post');//
    Route::get('/istifadeci/elanlar/yenile/{elan_id}',[UserElanController::class,'elan_update_index'])->name('elan.update.index');//
    Route::post('/istifadeci/elanlar/yenile/emeliyyat',[UserElanController::class,'elan_user_update'])->name('elan.user.update');//
    Route::get('/istifadeci/elanlar/sil/emeliyyat/{elan_id}',[UserElanController::class,'elan_user_delete'])->name('elan.user.delete');//

    Route::get('/profil',[ProfilController::class,'index'])->name('profil.index');//
    Route::get('/profil/yenile',[ProfilController::class,'profil_update_index'])->name('profil.update.index');//
    Route::post('/profil/yenile/emeliyyat',[ProfilController::class,'profil_update'])->name('profil.update');//

    Route::get('/elan-saxla/emeliyyat/{elan_id}',[SaveController::class,'save_elan'])->name('save.elan');//

    Route::get('/istifadeci/saxlanilan-elanlar',[SaveController::class,'save_list'])->name('save.list');//
});

    Route::get('/',[IndexController::class,'index'])->name('index');
    Route::get('/vakansiyalar',[VakansiyalarController::class,'index'])->name('vakansiyalar');
    Route::get('/mutexessisler',[MutexessisController::class,'index'])->name('mutexessisler');
    Route::get('/haqqimizda',[HaqqimizdaController::class,'index'])->name('haqqimizda');
    Route::get('/elaqe',[ElaqeController::class,'index'])->name('elaqe');
    Route::post('/elaqe/gonder',[ElaqeController::class,'mesajGonder'])->name('elaqe.mesajGonder');

    Route::get('/vakansiyalar/detal/{vakansiya_id}',[VakansiyalarController::class,'vakansiya_detal'])->name('vakansiya.detal');
    Route::get('/mutexessis/detal/{mutexessis_id}',[MutexessisController::class,'mutexessis_detal'])->name('mutexessis.detal');

    Route::post('/anamenu/axtar',[AxtarController::class,'index_page'])->name('axtar.index');
    Route::get('/anamenu/axtar/{kateqoriya_id}',[AxtarController::class,'index_page_kateqoriya'])->name('axtar.index.kateqoriya');
    Route::get('/anamenu/axtar/{kateqoriya_ad}',[AxtarController::class,'index_page_kateqoriya2'])->name('axtar.index.kateqoriya2');

    
    



    


    
    






