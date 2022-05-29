<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NoticiaController;
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

/* podemos borrar estos archivos
Route::get('/', function () {
    return view('welcome');
});

Route::get('prueba', function () {
    return view('prueba');
});

Route::get('america', function () {
    return view('prueba2');
});
*/


//Front-end
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('noticias', [AppController::class, 'noticias'])->name('noticias');
Route::get('noticia/{slug}', [AppController::class, 'noticia'])->name('noticia');
Route::get('acerca-de', [AppController::class, 'acercade'])->name('acerca-de');

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/usuarios', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/usuarios/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/usuarios/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/usuarios/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::get('admin/usuarios/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/usuarios/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/noticias', [NoticiaController::class, 'index'])->middleware('role:noticias');
Route::get('admin/noticias/crear', [NoticiaController::class, 'crear'])->middleware('role:noticias');
Route::post('admin/noticias/guardar', [NoticiaController::class, 'guardar'])->middleware('role:noticias');
Route::get('admin/noticias/editar/{id}', [NoticiaController::class, 'editar'])->middleware('role:noticias');
Route::post('admin/noticias/actualizar/{id}', [NoticiaController::class, 'actualizar'])->middleware('role:noticias');
Route::get('admin/noticias/activar/{id}', [NoticiaController::class, 'activar'])->middleware('role:noticias');
Route::get('admin/noticias/home/{id}', [NoticiaController::class, 'home'])->middleware('role:noticias');
Route::get('admin/noticias/borrar/{id}', [NoticiaController::class, 'borrar'])->middleware('role:noticias');


//Auth
Route::get('acceder', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');

//API Noticias
Route::get('mostrar', [AppController::class, 'mostrar'])->name('mostrar');
Route::get('leer', [AppController::class, 'leer'])->name('leer');

//Back-end ,este ya no
//Route::get('/', [AppController::class, 'index'])->name('home');
//Ruta por defecto (si no encuentra otra antes)
Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
