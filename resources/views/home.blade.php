@extends('layouts.plantilla')

@section('content')
<!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">DashBoard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">DashBoard</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="mdi mdi-buffer"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">{{$articulos}}</h3>
                                        <h5 class="text-muted m-b-0">Articulos</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="mdi mdi-account-multiple"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">{{$clientes}}</h3>
                                        <h5 class="text-muted m-b-0">Clientes</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="mdi mdi-cart"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">{{$ventas}}</h3>
                                        <h5 class="text-muted m-b-0">Ventas Realizadas</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="mdi mdi-clipboard-text"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">{{$ingresos}}</h3>
                                        <h5 class="text-muted m-b-0">Ingresos de mercaderia</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                
                <!-- Column -->
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Disponibilidad de productos</h4>
                                <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                    <div class="d-flex">
                                        <div class="ml-auto">
                                            <div class="form-group">
                                                <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th data-sort-initial="true" data-toggle="true">Imagen</th>
                                            <th>Nombre, Descripcion y codigo</th>
                                            <th data-hide="phone, tablet">Cantidad </th>
                                            <th data-hide="phone, tablet">Precio</th>
                                            <th data-hide="phone, tablet">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listado as $list)
                                            <tr>
                                                <td>
                                                    <a class="image-popup-no-margins" href="{{asset('imagenes/articulos/'.$list -> imagen)}}" title="{{$list -> nombre}}">
                                                        <img src="{{asset('imagenes/articulos/'.$list -> imagen)}}" alt="{{$list -> nombre}}" height="50px" width="50px" class="img-thumbnail" class="img-responsive" >
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6><a href="javascript:void(0)" class="link">{{$list->nombre}}, {{$list->descripcion}}</a></h6><small class="text-muted">Codigo del producto :  {{$list->codigo}} </small>
                                                </td>

                                                
                                                <td>
                                                    @if($list->stock < 20 && $list->estado == "Inactivo")
                                                        <h5> 
                                                            <a data-toggle="tooltip" title="Este articulo se esta agotando y se encuentra Inactivo para su venta">
                                                                <i class="ti-arrow-down text-danger"></i> &nbsp; {{$list->stock}}
                                                            </a>
                                                        </h5>

                                                        @else
                                                            @if($list->stock > 20 && $list->estado == "Activo")
                                                            <h5> 
                                                                <a data-toggle="tooltip" title="Este producto aún esta disponible y se encuentra Activo para la venta">
                                                                    <i class="ti-arrow-up text-success"></i> &nbsp; {{$list->stock}}
                                                                </a>
                                                            </h5>
                                                            @else
                                                                @if($list->stock > 20 && $list->estado == "Inactivo")
                                                                <h5> 
                                                                    <a data-toggle="tooltip" title="Este producto aún esta disponible, pero se encuentra Inactivo para su venta">
                                                                        <i class="ti-arrow-up text-success"></i> &nbsp; {{$list->stock}}
                                                                    </a>
                                                                </h5>
                                                                @else
                                                                    @if($list->stock < 20 && $list->estado == "Activo")
                                                                    <h5> 
                                                                        <a data-toggle="tooltip" title="Este producto se esta agotando, pero aun esta activo para su venta">
                                                                            <i class="ti-arrow-down text-danger"></i> &nbsp; {{$list->stock}}
                                                                        </a>
                                                                    </h5>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    <h5>S/. {{$list->precio_venta}}.00</h5>
                                                </td>

                                                @if($list->estado == "Activo")
                                                <td>
                                                    <span class="label label-table label-success">{{$list->estado}}</span> 
                                                </td>
                                                @else
                                                <td>
                                                    <span class="label label-table label-danger">{{$list->estado}}</span> 
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-right">
                                                    <ul class="pagination">

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

@endsection
