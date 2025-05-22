<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Incapacidades\IncapacidadesController;
use App\Http\Controllers\API\UserApiController;

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\FeedController;

use App\Http\Controllers\Auth\UserImportController;


use App\Exports\PermisoRemuneradoExport;


use Maatwebsite\Excel\Facades\Excel;

//COLOCAR ESTE COMANDO PARA CARGAR EL BACKEND A UNA URL CON EL IP DEL PC 
//php artisan serve --host=192.168.1.148 --port=8000


// Rutas sin middleware

Route::get('/feeds/{id}/download-images', [FeedController::class, 'downloadImages']);

Route::post('password/forgot', [UserApiController::class, 'sendResetPin']); //Enviar pin de reseteo de contraseña
Route::post('password/reset', [UserApiController::class, 'resetPasswordWithPin']); //Resetear contraseña

Route::post('login', [AuthenticationController::class, 'login']); //Iniciar sesion
Route::post('register', [AuthenticationController::class, 'register']); //Registrarse Usuarios
Route::post('registeradmin', [AuthenticationController::class, 'registerAdmin']); //Registro Administrador
Route::get('/categoria/{codigo}', [IncapacidadesController::class, 'consultarCodigoCategoria']);


   // EndPoints Feed (publicacion)
   Route::apiResource('feeds', FeedController::class);
   Route::post('feeds', [FeedController::class, 'store']);
   Route::get('feeds', [FeedController::class, 'index']);
   
   




Route::get('/test', function () {
    return response(['message' => 'Api is working'], 200);
});
Route::get('/Excel', function () {
    return view('Excel');
});



// Rutas con middleware 'auth:api'
Route::middleware('auth:api')->group(function () {

    //endpoints Usuarios
    Route::post('/import-users', [UserImportController::class, 'import']); //Importacion de  Users
    Route::apiResource('user', UserApiController::class); //Apiresource como pa asegurar
    Route::get('/users', [UserApiController::class, 'index']);
    Route::post('/users/{id}/activate', [UserApiController::class, 'activate']); //desactivar usuario
    Route::post('/users/{id}/deactivate', [UserApiController::class, 'deactivate']); //activar usuario
    Route::get('/get/user', [UserApiController::class, 'indexUser']);
    Route::put('/user', [UserApiController::class, 'update']);


    Route::get('logout', [AuthController::class, "logout"]);//Cerrar sesion


    // EndPoints Incapacidades
    Route::apiResource('incapacidades', IncapacidadesController::class); // Apiresource (pa que no se despapaye)
    Route::get('/incapacidadesall', [IncapacidadesController::class, 'indexAll']); //get all incapacidades
    Route::get('incapacidades/{id}/documentos', [IncapacidadesController::class, 'downloadDocument']); //Descargar documentos incapacidades
    Route::get('/incapacidades/{id}/download-images', [IncapacidadesController::class, 'downloadImages']); //Descargar imagenes incapacidades


  

    Route::get('permisos-exportar', function () {
        return Excel::download(new PermisoRemuneradoExport, 'permisos.xlsx');
    });

   
    // En routes/api.php
    //consultar si existe el codigo en la base de datos

 
    
    Route::middleware('auth:sanctum')->get('/incapacidades/user', [IncapacidadesController::class, 'userIncapacidades'])->name('incapacidades.user');
    

   

    //Route::get('authorizedCesantia/download-zip/{uuid}', [CesantiasController::class, 'downloadZipAutorized']);

 
 
  
    


});