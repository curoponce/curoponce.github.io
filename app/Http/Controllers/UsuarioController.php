<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;
use App\User;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }

    //index 
    public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $usuarios = DB::table('users')->get();
        /*
        -> where('name','LIKE','%'.$querry.'%') 
        -> orderBy('id', 'asc')
        -> paginate(7);
        */
        return view('seguridad.usuario.index', ["usuarios" => $usuarios, "searchText" => $querry]);
      }
    }


     //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('seguridad.usuario.edit', ['usuario' => User::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(UsuarioFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $usuario = new User;     
      $usuario -> name = $request -> get('name');//este valor es el que se encuentra en el formulario
      $usuario -> email = $request -> get('email');
      $usuario -> password = bcrypt($request -> get('password'));           
      $usuario -> save();
      Session::flash('crear','Se ha creado al nuevo usuario correctamente');
      return Redirect::to('seguridad/usuario');
    }

    //update (actualizar un registro)
    public function update(UsuarioFormRequest $request, $id)
    {
      $usuario = User::findOrFail($id);         
      $usuario -> name = $request -> get('name');//este valor es el que se encuentra en el formulario
      $usuario -> email = $request -> get('email');
      $usuario -> password = bcrypt($request -> get('password'));
      $usuario -> update();
      Session::flash('actualizar','Se ha actualizado los datos del usuario correctamente');
      return Redirect::to('seguridad/usuario');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $usuario = DB::table('users') -> where('id', '=', $id) -> delete();
      Session::flash('borrar','Se ha elimanado al usuario');
      return Redirect::to('seguridad/usuario');
    }

}
