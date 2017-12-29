<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
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
        $personas = DB::table('personas') 
        -> where('nombre','LIKE','%'.$querry.'%') 
        -> where('tipo_persona','=','Cliente')->get();
        
        return view('ventas.cliente.index', ["personas" => $personas, "searchText" => $querry]);
      }
    }
    
    //create (mostra la vista de crear)
    public function create()
    {
      return view('ventas.cliente.create');
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
      return view ('ventas.cliente.show', ['persona' => Persona::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('ventas.cliente.edit', ['persona' => Persona::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(PersonaFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $persona = new Persona;
      $persona -> tipo_persona = 'Cliente';
      $persona -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $persona -> a_paterno = $request -> get('a_paterno');
      $persona -> a_materno = $request -> get('a_materno');
      $persona -> tipo_documento = $request -> get('tipo_documento');
      $persona -> num_documento = $request -> get('num_documento');
      $persona -> direccion = $request -> get('direccion');
      $persona -> telefono = $request -> get('telefono');
      $persona -> email = $request -> get('email');
      $persona -> save();
      Session::flash('crear','Se ha creado al cliente correctamente');
      return Redirect::to('ventas/cliente');
    }

    //update (actualizar un registro)
    public function update(PersonaFormRequest $request, $id)
    {
      $persona = Persona::findOrFail($id);         
      $persona -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $persona -> a_paterno = $request -> get('a_paterno');
      $persona -> a_materno = $request -> get('a_materno');
      $persona -> tipo_documento = $request -> get('tipo_documento');
      $persona -> num_documento = $request -> get('num_documento');
      $persona -> direccion = $request -> get('direccion');
      $persona -> telefono = $request -> get('telefono');
      $persona -> email = $request -> get('email');
      $persona -> update();
      Session::flash('actualizar','Se ha actualizado los datos cliente correctamente');
      return Redirect::to('ventas/cliente');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $persona = Persona::findOrFail($id);
      $persona -> tipo_persona = 'Inactivo'; 
      $persona -> update();
      Session::flash('borrar','Se ha elimanado al cliente');
      return Redirect::to('ventas/cliente');
    }
}
