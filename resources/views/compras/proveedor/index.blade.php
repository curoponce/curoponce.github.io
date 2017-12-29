 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Proveedores</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Proveedores</li>
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
                                <h4 class="card-title">Listado de Proveedores <button class="btn btn-outline-primary btn-rounded" data-toggle="modal" data-target="#modalcrear"><i class="fa fa-check"></i>Nuevo</button></h4>
                                <hr>
                                @if(Session::has('crear'))
                                <div class="alert alert-success alert-rounded"> <i class="fa fa-check"></i> <strong>Felicidades</strong> {{Session::get('crear')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                @if(Session::has('actualizar'))
                                <div class="alert alert-info alert-rounded"> <i class="fa fa-check"></i> <strong>Felicidades</strong> {{Session::get('actualizar')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                @if(Session::has('borrar'))
                                <div class="alert alert-danger alert-rounded"> <i class="fa fa-check"></i> <strong>Ops!</strong> {{Session::get('borrar')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Tipo de documento</th>
                                                <th># de documento</th>
                                                <th>telefono</th>
                                                <th>E-mail</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Tipo de documento</th>
                                                <th># de documento</th>
                                                <th>telefono</th>
                                                <th>E-mail</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($personas as $per)
                                            <tr>
                                                <td>{{$per -> id_persona}}</td>
                                                <td>{{$per -> nombre}}</td>
                                                <td>{{$per -> a_paterno}} {{$per -> a_materno}}</td>
                                                <td>{{$per -> tipo_documento}}</td>
                                                <td>{{$per -> num_documento}}</td>
                                                <td>{{$per -> telefono}}</td>
                                                <td>{{$per -> email}}</td>
                                                <td>
                                                    <a data-toggle="tooltip" title="Editar Proveedor" href="{{URL::action('ProveedorController@edit', $per -> id_persona)}}">
                                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil" data-toggle="modal" data-target="#modalEditar"></i> </button>
                                                    </a>
                                                    <a data-toggle="tooltip" title="Eliminar Proveedor">
                                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#modalEliminar-{{$per -> id_persona}}"><i class="fa fa-times"></i> </button>
                                                    </a>
                                                </td>
                                            </tr>

                                            
                                            <!-- Modal Eliminar -->
                                                <!-- ============================================================== -->
                                                <div class="col-md-4">
                                                    <!-- sample modal content -->
                                                    <div id="modalEliminar-{{$per -> id_persona}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Eliminar Proveedor {{$per->nombre}} {{$per->a_paterno}} {{$per->a_materno}}</h4>
                                                                </div>
                                                                <hr>
                                                                {{Form::open(array('action' => array('ProveedorController@destroy', $per -> id_persona), 'method' => 'delete'))}}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                             <div class="form-group">            
                                                                               <center><p>¿estas seguro que desea eliminar a este proveedor?</p></center>          
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
                                                <h4 class="modal-title">Crear nuevo Proveedor</h4>
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
                                            <form action="{{url('compras/proveedor')}}" method="POST" class="form-material m-t-40">
                                            {{csrf_field() }}
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
                                                       <label for="nombre">Apellido paterno:</label>
                                                        <input type="text" class="form-control" name="a_paterno" placeholder="Apellido paterno..." value="{{old('a_paterno')}}">            
                                                    </div>
                                                </div>
                                                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                     <div class="form-group">            
                                                       <label for="nombre">Apellido Materno:</label>
                                                        <input type="text" class="form-control" name="a_materno" placeholder="Apellido materno..."  value="{{old('a_materno')}}">            
                                                    </div>
                                                </div>
                                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                     <div class="form-group">            
                                                       <label for="nombre">Direccion:</label>
                                                        <input type="text" class="form-control" name="direccion" placeholder="Direccion..."  value="{{old('direccion')}}">            
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                     <div class="form-group">            
                                                       <label for="nombre">Documento:</label>
                                                       <select name="tipo_documento" id="" class="form-control">                  
                                                           <option value="RUC">RUC</option> 
                                                           <option value="DNI">DNI</option>
                                                           <option value="PASAPORTE">PASAPORTE</option>
                                                       </select>
                                                </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">            
                                                       <label for="codigo">Numero de cocumento:</label>
                                                        <input type="text" class="form-control" name="num_documento" placeholder="Numero de documento..."  value="{{old('num_documento')}}">            
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                     <div class="form-group">            
                                                       <label for="stock">Telefono:</label>
                                                        <input type="text" class="form-control" name="telefono" placeholder="Telefono..."  value="{{old('telefono')}}">            
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                     <div class="form-group">            
                                                       <label for="descripcion">email:</label>
                                                       <input type="email" class="form-control" name="email" placeholder="Email..."  value="{{old('email')}}">            
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <!-- ============================================================== -->
                <!-- End modal Content -->

@endsection