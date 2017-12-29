<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
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
        $categorias = DB::table('categorias') 
        -> where('nombre','LIKE','%'.$querry.'%') 
        -> where('status','=','1')
        -> orderBy('id_categoria', 'asc')->get();
        
        return view('almacen.categoria.index', ["categorias" => $categorias, "searchText" => $querry]);
      }
    }
    

    //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('almacen.categoria.edit', ['categoria' => Categoria::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(CategoriaFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $categoria = new Categoria;
      $categoria -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $categoria -> descripcion = $request -> get('descripcion');
      $categoria -> status = 1;
      $categoria -> save();
       Session::flash('crear','Se ha creado la categoria correctamente');      
      return Redirect::to('almacen/categoria');
    }

    //update (actualizar un registro)
    public function update(CategoriaFormRequest $request, $id)
    {
      $categoria = Categoria::findOrFail($id);
      $categoria -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $categoria -> descripcion = $request -> get('descripcion');
      $categoria -> update();
       Session::flash('actualizar','Se ha actualizado la categoria correctamente');
      return Redirect::to('almacen/categoria');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $categoria = Categoria::findOrFail($id);
      $categoria -> status = 0;
      $categoria -> update();
       Session::flash('borrar','Se ha elimanado la categoria ');
      return Redirect::to('almacen/categoria');
    }

}
