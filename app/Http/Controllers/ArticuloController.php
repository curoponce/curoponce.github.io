<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Articulo;
use Illuminate\Support\Facades\Session;
use DB;

class ArticuloController extends Controller
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
        //obtener las categorias activas
        $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
        //obtener las categorias
        $articulos = DB::table('articulos as a') 
        -> join('categorias as c', 'a.id_categoria', '=', 'c.id_categoria')
        -> select('a.id_articulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.precio_venta','c.nombre as categoria', 'a.descripcion', 'a.imagen', 'a.estado')->get();
        
        return view('almacen.articulo.index', ["articulos" => $articulos, "searchText" => $querry, "categorias" => $categorias]);
      }
    }

    /*
    //create (mostra la vista de crear)
    public function create()
    {
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();
    	return view('almacen.articulo.index', ["categorias" => $categorias]);
    }
    */

    //show (mostrar la vista de show)
    public function show($id)
    {
    	return view ('almacen.articulo.show', ['articulo' => Articulo::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {

      $articulo = Articulo::findOrFail($id);
      $categorias = DB::table('categorias') -> where('status', '=', '1') -> get();

    	return view ('almacen.articulo.edit', ['articulo' => $articulo, 'categorias' => $categorias]);
    }

    //store(insertar un registro)
    public function store(ArticuloFormRequest $request)
    {
    	//creamos un objeto del tipo categoria
    	$articulo = new Articulo;
    	$articulo -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
    	$articulo -> codigo = $request -> get('codigo');
      $articulo -> nombre = $request -> get('nombre');
      $articulo -> stock = $request -> get('stock');
      $articulo -> precio_venta = $request -> get('precio_venta');
      $articulo -> descripcion = $request -> get('descripcion');
    	$articulo -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/articulos', $file -> getClientOriginalName());
        $articulo -> imagen = $file -> getClientOriginalName();
      }

    	$articulo -> save();
      Session::flash('crear','Se ha creado al articulo correctamente');
    	return Redirect::to('almacen/articulo');
    }

    //update (actualizar un registro)
   	public function update(ArticuloFormRequest $request, $id)
   	{
   	
   		$articulo = Articulo::findOrFail($id);
   		$articulo -> id_categoria = $request -> get('id_categoria');//este valor es el que se encuentra en el formulario
      $articulo -> codigo = $request -> get('codigo');
      $articulo -> nombre = $request -> get('nombre');
      $articulo -> stock = $request -> get('stock');
      $articulo -> precio_venta = $request -> get('precio_venta');
      $articulo -> descripcion = $request -> get('descripcion');
      $articulo -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/articulos', $file -> getClientOriginalName());
        $articulo -> imagen = $file -> getClientOriginalName();
      }
   		$articulo -> update();
      Session::flash('actualizar','Se ha actualizado el articulo correctamente');
   		return Redirect::to('almacen/articulo');
   	}

   	//destroy (eliminar logicamente un registro)
   	public function destroy($id)
   	{
   		$articulo = Articulo::findOrFail($id);
   		$articulo -> estado = 'Inactivo';
   		$articulo -> update();
      Session::flash('borrar','Se ha eliminado el articulo');
   		return Redirect::to('almacen/articulo');
   	}

    

}
