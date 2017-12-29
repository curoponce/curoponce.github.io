<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Illuminate\Support\Facades\Session;

class ProveedorController extends Controller
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
        -> where('tipo_persona','=','Proveedor')->get();
        
        return view('compras.proveedor.index', ["personas" => $personas, "searchText" => $querry]);
      }
    }
    
    //create (mostra la vista de crear)
    public function create()
    {
      return view('compras.proveedor.create');
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
      return view ('compras.proveedor.show', ['persona' => Persona::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('compras.proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(PersonaFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $persona = new Persona;
      $persona -> tipo_persona = 'Proveedor';
      $persona -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $persona -> a_paterno = $request -> get('a_paterno');
      $persona -> a_materno = $request -> get('a_materno');
      $persona -> tipo_documento = $request -> get('tipo_documento');
      $persona -> num_documento = $request -> get('num_documento');
      $persona -> direccion = $request -> get('direccion');
      $persona -> telefono = $request -> get('telefono');
      $persona -> email = $request -> get('email');
      $persona -> save();
       Session::flash('crear','Se ha creado al nuevo proveedor correctamente');
      return Redirect::to('compras/proveedor');
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
       Session::flash('actualizar','Se ha actualizado los datos del proveedor correctamente');
      return Redirect::to('compras/proveedor');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $persona = Persona::findOrFail($id);
      $persona -> tipo_persona = 'Inactivo'; 
      $persona -> update();
       Session::flash('borrar','Se ha eliminado al proveedor ');
      return Redirect::to('compras/proveedor');
    }

}
