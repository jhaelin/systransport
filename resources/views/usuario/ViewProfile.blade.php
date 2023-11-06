@extends('adminlte.dashboard')   
@section('content')

<div class="row">
<section class="content">

      <div class="row">
      <div class="col-md-5">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes  ecf0f5 -->

            <div class="widget-user-header bg-black" style="background: url('../img/photo1.png') center center;">
              <div class="widget-user-image">
                <img class="img-circle" src="{{url('uploads_files/'.$row->foto_)}}" alt="User Avatar">
              </div>
              <h3 class="widget-user-username">{{$row->nombre}} {{$row->paterno}} {{$row->materno}}</h3>
              <h5 class="widget-user-desc">{{$row->cargo}}</h5>
            </div>
            <div class="box-footer no-padding"style="background:#ecf0f5;">
              <ul class="nav nav-stacked">
                <li><a href="#">Cédula de Identidad <span class="pull-right badge">{{$row->ci}} &nbsp;{{$row->expedido}}</span></a></li>
                <li><a href="#">Dirección Zona <span class="pull-right badge">{{$row->zona}}</span></a></li>
                <li><a href="#">Dirección Calle <span class="pull-right badge">{{$row->calle}}</span></a></li>
                <li><a href="#">Dirección N° <span class="pull-right badge">{{$row->numero}}</span></a></li>
                <li><a href="#">Teléfono <span class="pull-right badge">{{$row->telefono}}</span></a></li>
                <li><a href="#">Celular <span class="pull-right badge">{{$row->celular}}</span></a></li>
                <li><a href="#">Email <span class="pull-right badge">{{$row->email}}</span></a></li>
              </ul>
            </div>
            <div class="widget-user-header" style="background:#ecf0f5;">
              <h6 class="widget-user-desc">Bienvenido ...</h6>
            </div>
          </div>
        </div>

        <!-- /.col -->
        <div class="col-md-7" style="background:#ecf0f5;">
          <div class="nav-tabs-custom" style="background:#ecf0f5;">
            <ul class="nav nav-tabs" style="background:#ecf0f5;">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true" style="background:#ecf0f5;">Actalizar Foto de Perfil</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false" style="background:#ecf0f5;">Actualizar Contraseña</a></li>
            </ul>
            <div class="tab-content" style="background:#ecf0f5;">

              <div class="tab-pane active" id="activity" style="background:#ecf0f5;">
    
                  <form id="formPerson" method="POST" novalidate="novalidate" action="{{url('UpdateFoto')}}"  enctype='multipart/form-data'>
                      {{csrf_field()}}
                      <div class="row">
                        <input name="id" type="hidden" value="{{Auth::user()->id}}">
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        <div class="col-md-4">
                             <center><img src="{{url('uploads_files/'.$row->foto_)}}" class="img-thumbnail" alt="Cinque Terre" style="height:330px; width:320px"></center>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12"></div>

                        <div class="col-md-4 col-sm-4 col-xs-12"></div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                             <input type="file" id="input-archivo" name="archivo" class="foto form-control has-feedback-left" placeholder="Foto">
                        </div>
                        
                        <div class="col-md-4 col-sm-4 col-xs-4">
                             <button class="btn btn_temp btn-ms waves-effect actualizarbtn" type="submit" style="display:none"><i class="fa fa-refresh"></i> Actualizar Foto</button>
                        </div>
                      </div>
                      <br>
                  </form>

              </div>


              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
                <form id="formPerson" method="POST" novalidate="novalidate" action="{{url('UpdatePass')}}"  enctype='multipart/form-data'>
                    {{csrf_field()}}
                    
                    <input name="id" type="hidden" value="{{Auth::user()->id}}">
                        <div class="row clearfix">
                            <h4 class="card-inside-title">&nbsp;&nbsp;&nbsp;&nbsp;Cuenta Actual</h4>
                            
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-fw fa-user"></i>
                                        </span>
                                        <div class="">
                                            <input class="form-control" value="{{Auth::user()->codigo_usuario}}" disabled>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            
                            <h4 class="card-inside-title">&nbsp;&nbsp;&nbsp;&nbsp;Contraseña Actual</h4>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lock"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="p_actual" id="p_actual" class="form-control" placeholder="Contraseña Actual">
                                            
                                        </div>
                                    </div>
                                    <div id="un"></div><br>
                            </div>


                            <h4 class="card-inside-title si" style="display:none">&nbsp;&nbsp;&nbsp;&nbsp;Nueva Contraseña </h4>
                                <div class="col-md-12 si" style="display:none">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-fw fa-unlock"></i></span>
                                        <div class="form-line">
                                            <input type="password" name="p_nuevo" id="p_nuevo" class="form-control" placeholder="Nueva Contraseña">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 si" style="display:none"><br>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-fw fa-unlock-alt"></i></span>
                                        <div class="form-line">
                                            <input type="password" name="confpassword" id="confpassword" class="form-control" placeholder="Confirmar Nueva Contraseña">
                                        </div>
                                    </div>

                                            <div class="col-sm-9"style="display:none;" id="incorrecto"><p class="text-red">Contraseñas no coinciden</div>
                                            <div class="col-sm-9"style="display:none;" id="correcto"><p class="text-green">Contraseñas si coinciden</div>
                                </div>
                            </div>
                            <button class="btn btn_temp btn-sm waves-effect sibtn" type="submit" style="display:none"><i class="fa fa-refresh"></i> Actualizar </button>

                        </form>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="submit" value="logout" style="display: none;">
                        </form>
              </div>
              <!-- /.tab-pane -->


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

</div>
@endsection