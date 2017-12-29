@extends('layouts.plantilla')
@section('content')
<!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Ingreso</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Detalles del ingreso</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-block printableArea">
                            <h3><b>{{$ingreso -> tipo_comprobante}}</b> <span class="pull-right">Serie: {{$ingreso -> serie_comprobante}} y #{{$ingreso -> num_comprobante}}</span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">Monster Admin</b></h3>
                                            <p class="text-muted m-l-5">Proveedor: {{$ingreso -> nombre}} {{$ingreso -> a_paterno}}</p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>Para,</h3>
                                            <h4 class="font-bold">Curo Motor's</h4>
                                            <p class="text-muted m-l-30">Av.Mariscal Benavides s/n,
                                                <br/> Referencia : Al costado de grifo castillo</p>
                                            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 23rd Jan 2017</p>
                                            <p><b>Due Date :</b> <i class="fa fa-calendar"></i> 25th Jan 2017</p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>Artículo</th>
                                                <th>Cantidad</th>
                                                <th>Precio compra</th>                            
                                                <th>Subtotal</th>
                                            </thead>
                                            <tbody>
                                                @foreach($detalles as  $det)
                                                    <tr>
                                                        <td>{{$det -> articulo}}</td>
                                                        <td>{{$det -> cantidad}}</td>
                                                        <td>{{$det -> precio_compra}}</td>                               
                                                        <td>{{$det -> cantidad * $det -> precio_compra}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <!--
                                        <p>Sub - Total amount: $13,848</p>
                                        <p>vat (10%) : $138 </p>
                                        -->
                                        <h3><b>Total : </b>S/.{{$ingreso -> total}}</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
@endsection