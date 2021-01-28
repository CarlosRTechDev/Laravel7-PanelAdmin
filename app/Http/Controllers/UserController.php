<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserEditFormRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //gracias al middleware muestra la pestaña/seccion de usuario solo si estas loggueado
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(Request $request){
        if($request){
            $query = trim($request->get('search'));

            $users = User::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(5);

            return view('usuarios.index', ['users' => $users, 'search' => $query]);
        }

    }

    
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', ['roles' => $roles]);
    }

    
    public function store(UserFormRequest $request)
    {
        $usuario = new User();
        // ->name viene del campo de la base de datos
        // 'name', 'email' vienen de la plantilla create.blade.php
        $usuario->name = request('name');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));
        if ($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path() . '/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();
        }

        $usuario->save();
        //aqui le asigna un rol al usuario:
        $usuario->asignarRol($request->get('userRol'));

        return redirect('/usuarios');
    }

    
    public function show($id)
    {
        return view('usuarios.show', ['user' => User::findOrFail($id)]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('usuarios.edit', ['user' => $user, 'roles' => $roles]);
    }

   
    // UserFormRequest es una clase para validaciones
    public function update(UserEditFormRequest $request, $id)
    {
        $this->validate(request(), ['email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id]]);
        $usuario = User::findOrFail($id);
       
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        //imagen
        if($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path() . '/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();
        }

        //guarda la contraseña en $pass para validar
        $pass = $request->get('password');
        //si quiere actualizar la contraseña... Guarda la contraseña
        if ($pass != null){
            $usuario->password = bcrypt($request->get('password'));
        } else {
            unset($usuario->password);
        }

        //modificamos esta parte para que actualice roles de usuarios
        //si tiene rol actualizamos el rol
        // si no tiene rol le asignamos un rol
        $role = $usuario->roles;
        if (count($role) > 0){
            $role_id = $role[0]->id;
            User::find($id)->roles()->updateExistingPivot($role_id, ['role_id' => $request->get('userRol')]);
        } else {
            $usuario->asignarRol($request->get('userRol'));
        }


        $usuario->update();

        return redirect('/usuarios');
    }

   
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->delete();

        return redirect('/usuarios');
    }
}
