<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny_user");

        $usuarios = User::with('roles')->paginate(10);
        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create_user");

        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required"
        ]);
        // guardar
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        // responder
        return response()->json(["mensaje" => "Usuario registrado"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize("show_user");

        $usuario = User::find($id);
        return response()->json($usuario, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->authorize("update_user");
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email,$id",
            "password" => "required"
        ]);
        // modificar
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->update();
        // responder
        return response()->json(["mensaje" => "Usuario modificado"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("delete_user");

        $usuario = User::find($id);
        $usuario->delete();

        return response()->json(["mensaje" => "Usuario eliminado"], 200);
    }

    public function asignarRol(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        return response()->json(["mensaje" => "Rol Asignado"], 200);
    }

    public function quitarRol(Request $request)
    {
        $user = User::find($request->user_id);
        $user->removeRole($request->role);

        return response()->json(["mensaje" => "Rol Quitado"], 200);
    }
    
}
