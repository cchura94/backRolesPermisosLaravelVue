<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny_role");

        $roles = Role::with('permisos')->get();

        return response()->json($roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create_role");
        // validacion
        $request->validate([
            "nombre" => "required|unique:roles"
        ]);
        // guardamos
        $rol = new Role;
        $rol->nombre = $request->nombre;
        $rol->detalle = $request->detalle;
        $rol->save();
        // respuesta
        return response()->json(["mensaje" => "Role registrado"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize("view_role");
        $rol = Role::with('permisos')->find($id);
        return response()->json($rol, 200);
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
        $this->authorize("update_role");
         // validacion
        $request->validate([
            "nombre" => "required|unique:roles,nombre,$id"
        ]);

        $rol = Role::find($id);
        $rol->nombre = $request->nombre;
        $rol->detalle = $request->detalle;
        $rol->update();
        // respuesta
        return response()->json(["mensaje" => "Role actualizado"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("delete_role");
        $rol = Role::find($id);
        $rol->delete();
        // respuesta
        return response()->json(["mensaje" => "Role eliminado"], 200);
    }

    public function asignarPermiso(Request $request)
    {
        $rol = Role::find($request->role_id);
        $rol->permisos()->sync($request->permisos);

        return response()->json(["mensaje" => "Permisos Asignados"], 200);
    }


}
