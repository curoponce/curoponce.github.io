 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Proveedor</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Editar Proveedor</li>
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
                                <div class="row">
                                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                      <h3>Editar Proveedor: {{$persona -> nombre}}</h3>
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
                              
                              {{Form::model($persona, ['method' => 'PATCH', 'route' => ['proveedor.update', $persona -> id_persona]])}}
                              {{Form::token()}}
                              <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="nombre">Nombre:</label>
                                              <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{$persona -> nombre}}">            
                                          </div>
                                      </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="nombre">Apellido paterno:</label>
                                              <input type="text" class="form-control" name="a_paterno" placeholder="Apellido paterno..." value="{{$persona -> a_paterno}}">            
                                          </div>
                                      </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="nombre">Apellido Materno:</label>
                                              <input type="text" class="form-control" name="a_materno" placeholder="Apellido materno..."  value="{{$persona -> a_materno}}">            
                                          </div>
                                      </div>
                                       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="nombre">Direccion:</label>
                                              <input type="text" class="form-control" name="direccion" placeholder="Direccion..."  value="{{$persona -> direccion}}">            
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="nombre">Documento:</label>
                                             <select name="tipo_documento" id="" class="form-control">
                                                @if($persona -> tipo_documento == 'RUC')                  
                                                 <option value="RUC" selected>RUC</option> 
                                                 <option value="DNI">DNI</option>
                                                 <option value="PASAPORTE">PASAPORTE</option>
                                                 @elseif($persona -> tipo_documento == 'DNI')    
                                                 <option value="RUC">RUC</option> 
                                                 <option value="DNI" selected>DNI</option>
                                                 <option value="PASAPORTE">PASAPORTE</option>
                                                  @elseif($persona -> tipo_documento == 'PASAPORTE')    
                                                 <option value="RUC">RUC</option> 
                                                 <option value="DNI">DNI</option>
                                                 <option value="PASAPORTE">PASAPORTE</option>
                                                 @endif
                                             </select>
                                      </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                          <div class="form-group">            
                                             <label for="codigo">Numero de cocumento:</label>
                                              <input type="text" class="form-control" name="num_documento" placeholder="Numero de documento..."  value="{{$persona -> num_documento}}">            
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="stock">Telefono:</label>
                                              <input type="text" class="form-control" name="telefono" placeholder="Telefono..."  value="{{$persona -> telefono}}">            
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                           <div class="form-group">            
                                             <label for="descripcion">email:</label>
                                             <input type="email" class="form-control" name="email" placeholder="Email..."  value="{{$persona -> email}}">            
                                          </div>
                                      </div>        
                            
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                  <button class="btn btn-primary" type="submit">Guardar</button>
                                  <button class="btn btn-danger" type="reset">Cancelar</button>
                                  </div>  
                              </div>
                          </div> 
                        {{Form::close()}}
                        </div>
                    </div>
                </div>
              </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->

@endsection