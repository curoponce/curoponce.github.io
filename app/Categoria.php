<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categorias';
    
    protected $primaryKey= 'id_categoria';

    public $timestamps = false;

    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'status'
    ];

    protected $guarded = [

    	
    ];

}