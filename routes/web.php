<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/bobot',[BobotController::class,'index'])->name('bobot');
    Route::post('/bobot',[BobotController::class,'generate'])->name('bobot');


    
    Route::get('/pegawai',[PegawaiController::class,'index'])->name('pegawai');
    Route::post('/pegawai',[PegawaiController::class,'add'])->name('pegawai');
    Route::get('/pegawai/edit/{pegawaiid}',[PegawaiController::class,'show_edit'])->name('pegawai.edit');
    Route::post('/pegawai/edit/{pegawaiid}',[PegawaiController::class,'save'])->name('pegawai.edit');
    Route::get('/pegawai/delete/{pegawaiid}',[PegawaiController::class,'delete'])->name('pegawai.delete');


    Route::get('/nilai',[NilaiController::class,'index'])->name('nilai');
    Route::post('/nilai',[NilaiController::class,'save'])->name('nilai');
});


Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');
