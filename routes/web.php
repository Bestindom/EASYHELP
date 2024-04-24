<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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


Route::get('/', function () {
    return view('landing');
});

Route::get('/registro', function() {
    return view('register');
});

Route::get('/login', [UsuarioController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::group(["middleware" => "type:1"], function () {
        Route::get('administracion', function () { return view('Users.users'); });
    });
    
    Route::get('/providers', function() { return view('users/providers'); });
    Route::get('/map', function () { return view('map'); })->name('map');
    Route::get('/riders', function() { return view('riders'); });
    Route::get('/getUser', [App\Http\Controllers\Api\UsuarioController::class, 'getUser']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/riders', function() {
        $user = Auth::user();
    
        return view('riders');
    } );
});

Route::middleware(['auth'])->group(function () {
    Route::get('/map', function () {
        $user = Auth::user();

        return view('map');
    })->name('map');
});

Route::get('/registro', function() {
    return view('register');
});

Route::get('/proveedor', function() {
    return view('proveedor');

Route::middleware(['auth'])->group(function () {
    Route::get('/providers', function () {
        $user = Auth::user();

        return view('users/providers');
    })->name('providers');
});