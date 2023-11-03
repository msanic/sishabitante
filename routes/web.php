<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\HabitantesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\QuejaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\GastoController;
use App\Exports\GastosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\InformeController;
use app\Exports\HabitantesExport;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas de Habitantes
Route::resource('habitantes', HabitantesController::class);
Route::get('habitantes/export', [HabitantesController::class, 'export'])->name('habitantes.export');
Route::get('/informe-habitantes',[InformeController::class, 'habitantesInforme'])->name('informe.habitantes');






// Rutas de Cuotas
Route::post('cuotas/export', [CuotaController::class, 'export'])->name('cuotas.export');
Route::get('cuotas/create', [CuotaController::class, 'create'])->name('cuotas.create');
Route::post('cuotas', [CuotaController::class, 'store'])->name('cuotas.store');
Route::get('cuotas', [CuotaController::class, 'index'])->name('cuotas.index');
route::get('/cuotas/historial', [CuotaController::class, 'historial'])->name('cuotas.historial');
Route::get('cuotas/comprobante/{id}', [CuotaController::class, 'comprobante'])->name('cuotas.comprobante');

Route::resource('cuotas', CuotaController::class)->except([
    'create', 'store', 'index'
]);




//quejas
Route::resource('quejas', QuejaController::class);
Route::get('quejas/historial', [QuejaController::class, 'historial'])->name('quejas.historial');
Route::get('quejas/historial/{id}', [QuejaController::class, 'historial'])->name('quejas.historial');
Route::get('/quejas/search', [QuejasController::class, 'search'])->name('quejas.search');
Route::get('habitantes/{id}/quejas/historial', [QuejaController::class, 'historial'])->name('quejas.historial');
Route::delete('quejas/{id}', [QuejaController::class, 'delete'])->name('quejas.delete');


//documentos
Route::get('documentos/create', [DocumentoController::class, 'create'])->name('documentos.create');
Route::post('documentos/store', [DocumentoController::class, 'store'])->name('documentos.store');
Route::get('gestion', [GestionController::class, 'index'])->name('gestion.index');
Route::resource('documentos', DocumentoController::class);
Route::get('documentos/{id}', [DocumentoController::class, 'show']);
Route::get('documentos/verArchivo/{id}', [DocumentoController::class, 'verArchivo'])->name('documentos.verArchivo');


Route::resource('bienes', BienController::class);
Route::get('gastos/export', [GastoController::class, 'export'])->name('gastos.export');


//gasto

Route::resource('gastos', GastoController::class);


//matricul
Route::post('matricula/export', [MatriculaController::class, 'export'])->name('matricula.export');

Route::get('/matricula/historial', [MatriculaController::class,'historial'])->name('matricula.historial');
Route::get('/matricula/search', [MatriculaController::class, 'search'])->name('matricula.search');
Route::get('/matricula', [MatriculaController::class, 'create'])->name('matricula.create');
Route::post('/matricula', [MatriculaController::class, 'store'])->name('matricula.store');
Route::resource('matricula', MatriculaController::class);

//proyecto

Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::post('proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::resource('comites', ComiteController::class);
Route::get('proyectos/reporte', [ProyectoController::class, 'reporte'])->name('proyectos.reporte');
Route::resource('proyectos', ProyectoController::class);
Route::delete('proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');






Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('dashboard', DashboardController::class);