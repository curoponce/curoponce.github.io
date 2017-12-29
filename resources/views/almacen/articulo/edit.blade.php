 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Articulo</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Editar Articulo</li>
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
                                      <h3>Editar Articulo: {{$articulo -> nombre}}</h3>
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
        
                              {{Form::model($articulo, ['method' => 'PATCH', 'route' => ['articulo.update', $articulo -> id_articulo], 'files' => 'true'])}}
                              {{Form::token()}}
                              <div class="row">
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="nombre">Nombre:</label>
                                      <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{$articulo -> nombre}}">            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="nombre">Categoria:</label>
                                     <select name="id_categoria" id="" class="form-control">
                                        @foreach($categorias as $cat)
                                            @if($cat ->id_categoria == $articulo -> id_categoria)
                                                 <option value="{{$cat -> id_categoria}}" selected>{{$cat -> nombre}}</option>
                                          @else
                                                  <option value="{{$cat -> id_categoria}}" >{{$cat -> nombre}}</option>
                                          @endif
                                         @endforeach
                                     </select>
                              </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                  <div class="form-group">            
                                     <label for="codigo">Codigo:</label>
                                      <input type="text" class="form-control" name="codigo"  required value="{{$articulo->codigo}}">            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="stock">Stock:</label>
                                      <input type="text" class="form-control" name="stock"  required value="{{$articulo->stock}}">          
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="stock">Precio de venta:</label>
                                      <input type="text" class="form-control" name="precio_venta"  required value="{{$articulo->precio_venta}}">          
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="descripcion">Descripcion:</label>
                                     <textarea name="descripcion" id="textarea" class="form-control"  placeholder="ingrese la descripcion">{{$articulo->descripcion}}</textarea>        
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">               
                                      <input type="file" class="form-control" name="imagen">            
                                      @if(($articulo-> imagen) != "")
                                          <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="imagen" style="height: 150px; width:200px; background-size: contain;">
                                      @endif
                                  </div>
                              </div>
                              <br><br><br>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                  <button class="btn btn-lg btn-outline-primary btn-rounded" type="submit">Reset</button>
                                  <button class="btn btn-lg btn-outline-success btn-rounded" type="submit">Actualizar</button>
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