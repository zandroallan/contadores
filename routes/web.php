<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ContadorController;
// use App\Http\Controllers\SupervisorController;
// use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\FormatoController;


// URL::forceScheme('https');

// $proxy_url = getenv('PROXY_URL');
// $proxy_schema = getenv('PROXY_SCHEMA');

// if (!empty($proxy_url)) {
//    URL::forceRootUrl($proxy_url);
// }

// if (!empty($proxy_schema)) {
//    URL::forceSchema($proxy_schema);
// }

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('password', [HomeController::class, 'passwordUsers']);

Route::get('verificar/{id}/folio', [ContadorController::class, 'verificarFolio']);

Route::get('api/verificar/folio', [ContadorController::class, 'rtecs_api']);


/**
 * Sandro Alan Gomez Aceituno
 * 01 de Febrero del 2023
 * Lista de rutas para los usuarios logueados.
 * Middleware Begin v0.1
 * */

Route::group(['middleware' => ['auth']],
    function() {
    
        Route::get('formatos', 
            function() {
                return view('formatos.index');
            }
        )->name('formatos');

        Route::post('change/theme', [HomeController::class, 'changeTheme']);

        Route::get('home/{id_curso}/show', [HomeController::class, 'show']);

        Route::get('mi/perfil', [HomeController::class, 'mi_perfil']);

        Route::get('perfil/datos', [HomeController::class, 'perfil_datos']);

        Route::post('mis/datos/update', [HomeController::class, 'updateData']);

        Route::post('mi/password/update', [HomeController::class, 'updatePassword']);

        Route::resource('roles', RoleController::class);


        Route::delete('roles/{id}/eliminar', [RoleController::class, 'destroy']);

        Route::post('roles/actualizar', [RoleController::class, 'update']);



        Route::resource('permisos', PermissionController::class);

        Route::resource('usuarios', UserController::class);

        // Route::resource('especialidades', EspecialidadController::class);

        Route::resource('contadores', ContadorController::class);

        // Route::resource('supervisores', SupervisorController::class);

        Route::post('constancia/upload', [ContadorController::class, 'constanciaUpload']);

        Route::get('constancia/{id}/download', [ContadorController::class, 'constanciaDownload']);

        Route::get('qr', [ContadorController::class, 'generateQRCode']);

        Route::get('dowload/{id}/qr', [ContadorController::class, 'dowloadQRCode']);

        Route::get('reporte/colegios', [FormatoController::class, 'reporte_colegio']);



        /**
         * Listado de rutas API
         * */
        Route::get('api/tablero', [HomeController::class, 'tablero_api']);

        Route::get('api/usuarios', [UserController::class, 'usuarios_api']);

        Route::get('api/roles', [RoleController::class, 'roles_api']);

        Route::get('api/permisos', [PermissionController::class, 'permisos_api']);

        // Route::get('api/especialidades', [EspecialidadController::class, 'especialidades_api']);

        Route::get('api/contadores', [ContadorController::class, 'contadores_api']);

        // Route::get('api/cursos/estadisticas', [CursoController::class, 'cursos_estadisticas_api']);

        // Route::get('api/cursos/users', [CursoController::class, 'users_curso_api']);
    }
);

/**
 * Middleware End
 * */

