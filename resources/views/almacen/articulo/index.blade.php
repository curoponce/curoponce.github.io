 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Articulos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista de articulos</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Listado de Articulos <button class="btn btn-outline-primary btn-rounded" data-toggle="modal" data-target="#modalcrear"><i class="fa fa-check"></i>Nuevo</button></h4>
                                <hr>
                                @if(Session::has('crear'))
                                <div class="alert alert-success alert-rounded"> <i class="fa fa-check"></i> <strong>Felicidades</strong> {{Session::get('crear')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                @if(Session::has('actualizar'))
                                <div class="alert alert-info alert-rounded"> <i class="fa fa-update"></i> <strong>Felicidades</strong> {{Session::get('actualizar')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                @if(Session::has('borrar'))
                                <div class="alert alert-danger alert-rounded"> <i class="fa fa-warning"></i> <strong>Ops!</strong> {{Session::get('borrar')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Codigo</th>
                                                <th>Categoria</th>
                                                <th>Stock</th>
                                                <th>Precio de venta</th>
                                                <th>Imagen</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Codigo</th>
                                                <th>Categoria</th>
                                                <th>Stock</th>
                                                <th>Precio de venta</th>
                                                <th>Imagen</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($articulos as $art)
                                            <tr>
                                                <td>{{$art -> id_articulo}}</td>
                                                <td>{{$art -> nombre}}</td>
                                                <td>{{$art -> codigo}}</td>
                                                <td>{{$art -> categoria}}</td>
                                                <td>{{$art -> stock}}</td>
                                                <td>S/. {{$art -> precio_venta}}.00</td>
                                                <td>
                                                    <img src="{{asset('imagenes/articulos/'.$art -> imagen)}}" alt="{{$art -> nombre}}" height="50px" width="50px" class="img-thumbnail">                    
                                                </td>
                                                <td>{{$art -> estado}}</td>
                                                <td>
                                                    
                                                    <a data-toggle="tooltip" title="Editar Articulo" href="{{URL::action('ArticuloController@edit', $art -> id_articulo)}}">
                                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil" data-toggle="modal" data-target="#modalEditar"></i> </button>
                                                    </a>
                                                    <a data-toggle="tooltip" title="Eliminar Articulo">
                                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#modalEliminar-{{$art -> id_articulo}}"><i class="fa fa-times"></i> </button>
                                                    </a>
                                                </td>
                                            </tr>

                                            
                                            <!-- Modal Eliminar -->
                                                <!-- ============================================================== -->
                                                <div class="col-md-4">
                                                    <!-- sample modal content -->
                                                    <div id="modalEliminar-{{$art -> id_articulo}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Eliminar Articulo {{$art->nombre}}</h4>
                                                                </div>
                                                                <hr>
                                                                {{Form::open(array('action' => array('ArticuloController@destroy', $art -> id_articulo), 'method' => 'delete'))}}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                             <div class="form-group">            
                                                                               <center><p>¿estas seguro que desea eliminar este producto?</p></center>          
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                                                                    
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">Eliminar</button>
                                                                </div>
                                                                {{Form::close()}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ============================================================== -->
                                                <!-- End modal Content --> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->



                <!-- Model Nuevo Articulo -->
                <!-- ============================================================== -->
                <div class="col-md-4">
                                <!-- sample modal content -->
                                <div id="modalcrear" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Crear nuevo articulo</h4>
                                            </div>
                                            @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors -> all() as $error)
                                                        <li>{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <form action=" {{ url('almacen/articulo') }}" method="POST" enctype="multipart/form-data" class="form-material m-t-40">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                         <div class="form-group">            
                                                           <label for="nombre">Nombre:</label>
                                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{old('nombre')}}">            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                         <div class="form-group">            
                                                           <label for="nombre">Categoria:</label>
                                                           <select name="id_categoria" id="" class="form-control">
                                                              @foreach($categorias as $cat)
                                                               <option value="{{$cat -> id_categoria}}">{{$cat -> nombre}}</option>
                                                               @endforeach
                                                           </select>
                                                    </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                        <div class="form-group">            
                                                           <label for="codigo">Codigo:</label>
                                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo..." required value="{{old('codigo')}}">            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                         <div class="form-group">            
                                                           <label for="stock">Stock:</label>
                                                            <input type="text" class="form-control" name="stock" placeholder="Stock..." required value="{{old('stock')}}">            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                         <div class="form-group">            
                                                           <label for="stock">Precio de venta:</label>
                                                            <input type="text" class="form-control" name="precio_venta" placeholder="Precio venta..." required value="{{old('precio_venta')}}">            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                         <div class="form-group">            
                                                           <label for="imagen">Imagen:</label>                
                                                            <input type="file" class="form-control" name="imagen">            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                         <div class="form-group">            
                                                           <label for="descripcion">Descripcion:</label>
                                                           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion..."  value="{{old('descripcion')}}"></textarea>            
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <!-- ============================================================== -->
                <!-- End modal Content -->

@endsection