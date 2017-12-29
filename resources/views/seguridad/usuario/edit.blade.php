 @extends('layouts.plantilla')
 @section('content')
 <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Usuario</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Editar usuario</li>
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
                                      <h3>Editar Usuario: {{$usuario -> name}}</h3>
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
                              {{Form::model($usuario, ['method' => 'PATCH', 'route' => ['usuario.update', $usuario -> id]])}}
                              {{Form::token()}}
                              <div class="row">
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="name">Nombre:</label>
                                      <input type="text" class="form-control" name="name" placeholder="Nombre..." required value="{{$usuario -> name}}">            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="email">E-mail:</label>
                                      <input type="email" class="form-control" name="email" placeholder="E-mail..." required value="{{$usuario -> email}}">            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="password">Password:</label>
                                      <input type="password" class="form-control" name="password" placeholder="Ingrese su nueva contraseña..." required >            
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">            
                                     <label for="password">Password Confirmation:</label>
                                      <input type="password" class="form-control" name="password_confirmation" placeholder="ingrese nuevamente la contraseña..." required >            
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