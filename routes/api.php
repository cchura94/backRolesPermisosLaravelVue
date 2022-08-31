<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// authentiación
Route::group(["prefix" => "v1/auth"], function(){
    //  /v1/auth/login
    Route::post("login", [AuthController::class, "login"]);
    Route::post("registro", [AuthController::class, "registrarse"]);

    Route::group(["middleware" => "auth:sanctum"], function(){
        //  /v1/auth/logout
        Route::post("logout", [AuthController::class, "logout"]);
        //  /v1/auth/perfil
        Route::post("perfil", [AuthController::class, "miPerfil"]);
    });
});

// roles
Route::group(["prefix" => "v1", "middleware" => "auth:sanctum"], function(){
    
    Route::apiResource("permiso", PermisoController::class);
    Route::apiResource("role", RoleController::class);
    Route::apiResource("usuario", UsuarioController::class);
});

