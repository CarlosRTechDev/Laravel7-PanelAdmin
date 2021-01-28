<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Notas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //con el middleware se limita el acceso a la vista Home/principal si no estas loggueado
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //cuenta los registros que hay en la BD para User, Role, Notas
        $count_users = User::count();
        $count_roles = Role::count();
        $count_notas = Notas::count();

        return view('home', compact('count_users', 'count_roles', 'count_notas'));
    }
}
