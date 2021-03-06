 @extends('layouts.plantilla')
 @section('content')
<!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Ingreso</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">crear nuevo ingreso</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
				<div class="row">
				    <div class="col-12">
				        <div class="card">
				            <div class="card-block">
				                <div class="row">
							    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							        <h3>Nuevo ingreso</h3>
							        @if (count($errors) > 0)
							        <div class="alert alert-danger">
								        <ul>
								            @foreach($errors -> all() as $error)
								                <li>{{$error}}</li>
								            @endforeach
								        </ul>
							        </div>
							        @endif
							    </div>
							</div>
						    <form action=" {{ url('compras/ingreso') }}" method="POST" class="form-material m-t-40">
                            {{ csrf_field() }}
						    <div class="row">
						        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						             <div class="form-group">            
						               <label for="nombre">Proveedor:</label>
						               <select name="id_proveedor" id="id_proveedor" class="form-control">
						                   @foreach($personas as $persona)
						                       <option value="{{$persona -> id_persona}}">{{$persona -> nombre}} {{$persona -> a_paterno}}</option>
						                   @endforeach
						               </select>
						            </div>
						        </div>
						          
						        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						             <div class="form-group">            
						               <label for="nombre">Tipo de comprobante:</label>
						               <select name="tipo_comprobante" id="" class="form-control">                  
						                   <option value="Boleta">Boleta</option> 
						                   <option value="Factura">Factura</option>
						                   <option value="Ticket">Ticket</option>
						               </select>
						        	</div>
						        </div>
						        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						            <div class="form-group">            
						               <label for="codigo">Serie del comprobante:</label>
						                <input type="text" class="form-control" name="serie_comprobante" placeholder="Serie del comprobante..."  value="{{old('serie_comprobante')}}">            
						            </div>
						        </div>
						        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						            <div class="form-group">            
						               <label for="codigo">Numero del comprobante:</label>
						                <input type="text" class="form-control" name="num_comprobante" placeholder="Numero del comprobante..."  required value="{{old('num_comprobante')}}">            
						            </div>
						        </div>
							</div>
							<hr>
						    <div class="row">
						               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						                    <div class="form-group">
						                        <label for="">Articulo</label>
						                        <select class="form-control" name="pid_articulo" id="pid_articulo">
						                            @foreach($articulos as $articulo)
						                                <option value="{{$articulo -> id_articulo}}">{{$articulo -> articulo}}</option>
						                            @endforeach
						                        </select>
						                    </div>
						               </div>
						               <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						                    <div class="form-group">            
						                       <label for="cantidad">Cantidad:</label>
						                        <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="cantidad">            
						                    </div>
						                </div>
						                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						                    <div class="form-group">            
						                       <label for="cantidad">Precio de compra:</label>
						                        <input type="number" class="form-control" name="pprecio_compra" id="pprecio_compra" placeholder="P.compra">            
						                    </div>
						                </div>
						                
						                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						                    <div class="form-group">
						                    <br>            
						                       <button type="button" id="bt_add" class="btn btn-ms btn-primary">Agregar</button>
						                    </div>
						                </div>
						                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						                        <thead style="background-color: #A9D0F5">
						                            <th>Opciones</th>
						                            <th>Artículo</th>
						                            <th>Cantidad</th>
						                            <th>Precio compra</th>
						                            <th>Precio venta</th>
						                            <th>Subtotal</th>
						                        </thead>
						                        <tfoot>
						                            <th>TOTAL</th>
						                            <th></th>
						                            <th></th>
						                            <th></th>
						                            <th></th>
						                            <th><h4 id="total">S/. 0.00</h4></th>
						                        </tfoot>
						                        <tbody>
						                            
						                        </tbody>
						                    </table>
						                </div>
						           </div>
						       </div>
						        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="guardar">
						          <div class="form-group">
						              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
						            <button class="btn btn-danger" type="reset">Cancelar</button>
						            <button class="btn btn-primary" type="submit">Guardar <i class="fa fa-handshake-o"></i></button>
						            </div>  
						        </div>
						    </div>                
						    </form>
						   </div>
						</div>

        
@push('scripts')
<script>
    $(document).ready(function(){
        
        $('#bt_add').click(function(){
            agregar();
        })
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    
    function agregar(){
        id_articulo = $('#pid_articulo').val();
        articulo = $('#pid_articulo option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_compra = $('#pprecio_compra').val();
        
        
        
        if(id_articulo != "" && cantidad != "" && cantidad > 0 && precio_compra != "" )
        {
            subtotal[cont] = (cantidad * precio_compra);
            total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-warning" type"button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td>'+subtotal[cont]+'</td></tr>';
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                      
            //indicar el subtotal
            $('#total').html('s/. '+total);
            
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
        }
        else
        {
            alert('Error al ingresar el detalle del ingreso, revise los datos del articulo');    
        }
        
    }
    
    
    function limpiar(){
        $('#pcantidad').val('');
        $('#pprecio_compra').val('');
        
    }
    
    function evaluar(){
        if (total > 0)
        {
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }
    
    function eliminar(index){
        total = total- subtotal[index];
        $('#total').html('s/. '+total);
        $('#fila' + index).remove();
        evaluar();
    }
</script>
@endpush       

@endsection
