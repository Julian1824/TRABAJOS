<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LibroController;
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

Route::get('/', function(){
    return view('auth.login');
});
 
Route::get('empleado/pdf', [EmpleadoController::class, 'pdf'])->name('empleado.pdf');
Route::get('libro/pdf', [LibroController::class, 'pdf'])->name('libro.pdf');
/*
Route::get('/empleado', function(){
    return view('empleado.index');
});

Route::get('empleado/create',[EmpleadoController::class,'create']);

Para poder haceder a todas las rutas 'register'=>false*/
Route::resource('empleado',EmpleadoController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
    
Route::resource('/libros', App\Http\Controllers\LibroController::class);
Route::resource('/categorias', App\Http\Controllers\CategoriaController::class);  
});
