<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = DB::table('articulos')->count();
        //dd($productos = DB::table('Productos')->count());
        $ventas = DB::table('ventas')->count();
        $ingresos = DB::table('ingresos')->count();
        $clientes = DB::table('personas')->count();
        $listado = DB::table('articulos as a')->select('a.nombre', 'a.descripcion', 'a.codigo', 'a.stock', 'a.precio_venta', 'a.imagen', 'a.estado')->get();
        return view('home', compact('articulos', 'clientes', 'ventas', 'ingresos', 'listado'));
    }
}
