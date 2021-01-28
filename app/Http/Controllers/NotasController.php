<?php

namespace App\Http\Controllers;

use App\Notas;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function __construct(){
        //con el middleware se limita el acceso a las Notas si no estas loggueado
        $this->middleware('auth');
    }

    
    public function index(){
        //condicion que muestra las notas solo del usuario loggueado
        return view('notas.todas.index', ['notas' => Notas::all()->where('user_id', auth()->id())]);
    }


    public function edit($id){

        return view('notas.todas.edit', ['nota' => Notas::findOrFail($id)]);
    }


    public function update(Request $request, $id){

        $nota = Notas::findOrFail($id);

        $nota->titulo = $request->get('tituloN');
        $nota->texto = $request->get('textoN');

        $nota->update();

        return redirect('/notas/todas');
    
    }


    public function store(Request $request){
        $nota = new Notas();
        
        $nota->titulo = request('titulo');
        $nota->texto = request('texto');
        // en las notas guarda el id con el usuario loggueado en la pagina:
        $nota->user_id = auth()->id();

        $nota->save();

        return redirect('notas/todas');
    }


    public function destroy($id){

        $nota = Notas::findOrFail($id);
        $nota->delete();

        return redirect('/notas/todas');
    }


    public function favoritas(){

        return view('notas.favoritas');
    }


    public function archivadas(){

        return view('notas.archivadas');
    }


}
