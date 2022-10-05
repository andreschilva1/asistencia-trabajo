<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//users
Route::get('users/', [App\Http\Controllers\UsersController::class, 'index'])->middleware('can:Gestionar Usuarios')->name('users.index');
Route::get('users/crear', [App\Http\Controllers\UsersController::class, 'create'])->middleware('can:Gestionar Usuarios')->name('users.crear');
Route::post('users/insertar', [App\Http\Controllers\UsersController::class, 'insertar'])->middleware('can:Gestionar Usuarios')->name('users.insertar');
Route::get('users/{user}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->middleware('can:Gestionar Usuarios')->name('users.edit');
Route::put('users/{user}/update', [App\Http\Controllers\UsersController::class, 'update'])->middleware('can:Gestionar Usuarios')->name('users.update');
Route::delete('users/{usuario}', [\App\Http\Controllers\UsersController::class,'destroy'])->middleware('can:Gestionar Usuarios')->name('users.delete');

//trabajos
Route::get('trabajos/', [App\Http\Controllers\TrabajoController::class, 'index'])->middleware('can:Gestionar Trabajos')->name('trabajos.index');
Route::get('trabajos/crear', [App\Http\Controllers\TrabajoController::class, 'create'])->middleware('can:Gestionar Trabajos')->name('trabajos.crear');
Route::post('trabajos/insertar', [App\Http\Controllers\TrabajoController::class, 'insertar'])->middleware('can:Gestionar Trabajos')->name('trabajos.insertar');
Route::get('trabajos/{trabajo}/edit', [App\Http\Controllers\TrabajoController::class, 'edit'])->middleware('can:Gestionar Trabajos')->name('trabajos.edit');
Route::put('trabajos/{trabajo}/update', [App\Http\Controllers\TrabajoController::class, 'update'])->middleware('can:Gestionar Trabajos')->name('trabajos.update');
Route::delete('trabajos/{trabajo}',[\App\Http\Controllers\TrabajoController::class,'destroy'])->middleware('can:Gestionar Trabajos')->name('trabajos.destroy');

//trabajos asignados
Route::get('trabajos_asignados/', [App\Http\Controllers\TrabajosAsignadoController::class, 'index'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.index');
Route::get('trabajos_asignados/crear', [App\Http\Controllers\TrabajosAsignadoController::class, 'create'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.crear');
Route::post('trabajos_asignados/insertar', [App\Http\Controllers\TrabajosAsignadoController::class, 'insertar'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.insertar');
Route::get('trabajos_asignados/{trabajo_asignado}/edit', [App\Http\Controllers\TrabajosAsignadoController::class, 'edit'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.edit');
Route::put('trabajos_asignados/{trabajo_asignado}/update', [App\Http\Controllers\TrabajosAsignadoController::class, 'update'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.update');
Route::delete('trabajos_asignados/{trabajo_asignado}',[\App\Http\Controllers\TrabajosAsignadoController::class,'destroy'])->middleware('can:Gestionar Asignar Trabajos')->name('trabajos_asignados.destroy');

//trabajos asignados de los tecnicos
Route::get('trabajos_asignados_tecnicos/', [App\Http\Controllers\TrabajoAsignadoClienteController::class, 'index'])->middleware('can:Gestionar Mis Trabajos Asignados')->name('trabajos_asignados_tecnicos.index');
Route::get('trabajos_asignados_tecnicos/{trabajo_asignado}/show', [App\Http\Controllers\TrabajoAsignadoClienteController::class, 'show'])->middleware('can:Gestionar Mis Trabajos Asignados')->name('trabajos_asignados_tecnicos.show');

//control de asistencia 
Route::post('control_asistencias/{trabajo_asignado}/create',[App\Http\Controllers\ControlAsistenciaController::class,'create'])->name('control_asistencias.create');



//perfil
Route::get('perfil/', [App\Http\Controllers\PerfilController::class, 'index'])->middleware('can:Gestionar Perfil')->name('perfil.index');
Route::put('perfil/{user}/update', [App\Http\Controllers\PerfilController::class, 'update'])->middleware('can:Gestionar Perfil')->name('perfil.update');

//notificaciones
Route::get('notificaciones/', [App\Http\Controllers\notificacionController::class, 'index'])->middleware('can:Gestionar Notificaciones')->name('notificaciones.index');
Route::get('markAsRead', [App\Http\Controllers\notificacionController::class, 'marcarTodasLeidas'])->middleware('can:Gestionar Notificaciones')->name('notificaciones.markAsRead');

//trabajos completados
Route::get('trabajos_completados/',[App\Http\Controllers\trabajosCompletadosController::class,'index'])->middleware('can:Gestionar Trabajos Completados')->name('trabajos_completados.index');
Route::get('trabajos_completados/{trabajo_completado}/show', [App\Http\Controllers\trabajosCompletadosController::class, 'show'])->middleware('can:Gestionar Trabajos Completados')->name('trabajos_completados.show');

//trabajos completados tecnicos
Route::get('trabajos_completados_tecnicos/',[App\Http\Controllers\trabajoCompletadoTecnicoController::class,'index'])->middleware('can:Gestionar Mis Trabajos Completados')->name('trabajos_completados_tecnicos.index');
Route::get('trabajos_completados_tecnicos/{trabajo_completado}/show', [App\Http\Controllers\trabajoCompletadoTecnicoController::class, 'show'])->middleware('can:Gestionar Mis Trabajos Completados')->name('trabajos_completados_tecnicos.show');

//horas
Route::get('horas/', [App\Http\Controllers\HoraController::class, 'index'])->middleware('can:Gestionar Horas')->name('horas.index');
Route::get('horas/crear', [App\Http\Controllers\HoraController::class, 'create'])->middleware('can:Gestionar Horas')->name('horas.crear');
Route::post('horas/insertar', [App\Http\Controllers\HoraController::class, 'insertar'])->middleware('can:Gestionar Horas')->name('horas.insertar');
Route::get('horas/{hora}/edit', [App\Http\Controllers\HoraController::class, 'edit'])->middleware('can:Gestionar Horas')->name('horas.edit');
Route::put('horas/{hora}/update', [App\Http\Controllers\HoraController::class, 'update'])->middleware('can:Gestionar Horas')->name('horas.update');
Route::delete('horas/{hora}', [\App\Http\Controllers\HoraController::class,'destroy'])->middleware('can:Gestionar Horas')->name('horas.delete');

//categorias
Route::get('categorias/', [App\Http\Controllers\CategoriaController::class, 'index'])->middleware('can:Gestionar Categorias')->name('categorias.index');
Route::get('categorias/crear', [App\Http\Controllers\CategoriaController::class, 'create'])->middleware('can:Gestionar Categorias')->name('categorias.crear');
Route::post('categorias/insertar', [App\Http\Controllers\CategoriaController::class, 'insertar'])->middleware('can:Gestionar Categorias')->name('categorias.insertar');
Route::get('categorias/{categoria}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->middleware('can:Gestionar Categorias')->name('categorias.edit');
Route::put('categorias/{categoria}/update', [App\Http\Controllers\CategoriaController::class, 'update'])->middleware('can:Gestionar Categorias')->name('categorias.update');
Route::delete('categorias/{categoria}', [\App\Http\Controllers\CategoriaController::class,'destroy'])->middleware('can:Gestionar Categorias')->name('categorias.delete');