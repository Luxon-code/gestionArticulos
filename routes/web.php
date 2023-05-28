<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
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

Route::get('gestionarCategoria', function () {
    return view('gestionarCategoria');
});

Route::get('gestionArticulos',function () {
    return view('gestionarArticulo');
});
Route::get('/',function () {
    return view('inicioSesion');
});
Route::get('registrarUsuario',function () {
    return view('registrarUsuario');
});
Route::resource('categorias',CategoriaController::class,['index','store','show','update','destroy']);

Route::resource('articulos',ArticuloController::class,['index','store','show','update','destroy']);

Route::resource('usuarios',UsuarioController::class,['index','store','show','update','destroy']);

Route::get('iniciarSesion/{usuNombre}/{usuContraseña}',[UsuarioController::class,'inciarSesion']);