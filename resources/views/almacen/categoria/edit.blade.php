 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Categoria</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Editar categoria</li>
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
                                      <h3>Editar Articulo: {{$categoria -> nombre}}</h3>
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
        
                              {{Form::model($categoria, ['method' => 'PATCH', 'route' => ['categoria.update', $categoria -> id_categoria], 'files' => 'true'])}}
                              {{Form::token()}}
                              <div class="row">
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="nombre">Nombre:</label>
                                      <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{$categoria -> nombre}}">            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="descripcion">Descripcion:</label>
                                     <textarea name="descripcion" id="textarea" class="form-control" required placeholder="ingrese la descripcion">{{$categoria->descripcion}}</textarea>        
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