 @extends('layouts.plantilla')
 @section('content')
 
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Ingresos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista de ingresos</li>
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
                                <h4 class="card-title">Listado de Ingresos
                                    <a href="{{route('ingreso.create')}}"> 
                                        <button class="btn btn-outline-primary btn-rounded"><i class="fa fa-check"></i>Nuevo</button>
                                    </a>
                                </h4>
                                <hr>
                                @if(Session::has('crear'))
                                <div class="alert alert-success alert-rounded"> <i class="fa fa-check"></i> <strong>Felicidades</strong> {{Session::get('crear')}}
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
                                                <th>Fecha</th>
                                                <th>Proveedor</th>
                                                <th>Tipo, Serie y # de Comprobante</th>
                                                <th>Impuesto</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha y Hora</th>
                                                <th>Proveedor</th>
                                                <th>Tipo, Serie y # de Comprobante</th>
                                                <th>Impuesto</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($ingresos as $ing)
                                            <tr>
                                                <td>{{$ing -> id_ingreso}}</td>
                                                <td>{{$ing -> fecha_hora}}</td>
                                                <td>{{$ing -> nombre}} {{$ing -> a_paterno}}</td>
                                                <td>{{$ing -> tipo_comprobante}} : {{$ing -> serie_comprobante}} : {{$ing -> num_comprobante}}</td>
                                                <td>(I.G.V) {{$ing -> impuesto}}</td>
                                                <td>S/. {{$ing -> total}}</td>            
                                                <td>
                                                    @if($ing->estado == "Cancelado")
                                                    <span class="label label-table label-danger">{{$ing -> estado}}</span>
                                                    @else
                                                        @if($ing->estado == "Aceptado")
                                                        <span class="label label-table label-success">{{$ing -> estado}}</span>
                                                    @endif
                                                @endif 
                                                <td>
                                                    
                                                    <a data-toggle="tooltip" title="Detalles del ingreso" href="{{URL::action('IngresoController@show', $ing -> id_ingreso)}}">
                                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-link" data-toggle="modal" data-target="#modalEditar"></i> </button>
                                                    </a>
                                                    <a data-toggle="tooltip" title="Eliminar ingreso">
                                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#modalEliminar-{{$ing -> id_ingreso}}"><i class="fa fa-times"></i> </button>
                                                    </a>
                                                </td>
                                            </tr>

                                            
                                            <!-- Modal Eliminar -->
                                                <!-- ============================================================== -->
                                                <div class="col-md-4">
                                                    <!-- sample modal content -->
                                                    <div id="modalEliminar-{{$ing -> id_ingreso}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Cancelar ingreso</h4>
                                                                </div>
                                                                <hr>
                                                                {{Form::open(array('action' => array('IngresoController@destroy', $ing -> id_ingreso), 'method' => 'delete'))}}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                             <div class="form-group">            
                                                                               <center><p>¿estas seguro que desea cancelar ingreso?</p></center>          
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
@endsection