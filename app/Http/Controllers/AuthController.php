<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validando
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // verificando
        if(!Auth::attempt($credenciales)){
            return response()->json(["mensaje" => "Unauthorized"], 401);                        
        }
        
        // generar token
        $usuario = $request->user();
        $tokenResult = $usuario->createToken('Token Login');
        $token = $tokenResult->plainTextToken;

        // respuesta token -usuario
        return response()->json([
            "accessToken" => $token,
            "token_type" => "Bearer",
            "usuario" => $usuario,
            "expira" => 60
        ], 201);
    }

    public function registrarse(Request $request)
    {
        
    }

    public function miPerfil()
    {
        $usuario = Auth::user();

        return response()->json($usuario, 200);
        
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(["mensaje" => "Salió"], 200);

    }
}
