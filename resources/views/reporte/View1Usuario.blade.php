@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repUsuario')}}">Reportes</a></li>
    <li class="active">Usuarios</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Usuarios </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('usuarioPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 txt">
              <select name="tipo" id="tipo" class="form-control tipo txt">
                  <option value="TODO" class="txt">TODOS</option> 
                  @foreach($tipo as $t)
                  @if($t->tipo_usuario!='MAESTRO')
                  <option value="{{$t->tipo_usuario}}">{{$t->tipo_usuario}}</option>
                  @endif
                  @endforeach
              </select>
            <br>
            </div>
           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th class="text-center tab_temp txt">N°</th>
                      <th class="text-center tab_temp txt">Código Usuario</th>
                      <th class="text-center tab_temp txt">Nombre</th>                      
                      <th class="text-center tab_temp txt">Apellido Paterno</th>
                      <th class="text-center tab_temp txt">Apellido Materno</th>
                      <th class="text-center tab_temp txt">Dirección</th>
                      <th class="text-center tab_temp txt">Email</th>
                      <th class="text-center tab_temp txt">Teléfono/Celular</th>
                      <th class="text-center tab_temp txt">Tipo de<font class="col">_</font>Usuario</th>
                  </tr>
              </thead>
              <tbody class="tbody">
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->codigo_usuario}}</td>
                      <td class="text-justify txt">{{$value->nombre}}</td>
                      <td class="text-justify txt">{{$value->paterno}}</td>
                      <td class="text-justify txt">{{$value->materno}}</td>
                      <td class="text-justify txt">Z:{{$value->zona}} C/{{$value->calle}} N° {{$value->numero}}</td>
                      <td class="text-justify txt">{{$value->email}}</td>
                      <td class="text-justify txt">{{$value->telefono}}/{{$value->celular}}</td>
                      <td class="text-justify txt">{{$value->tipo_usuario}}</td>
                    </tr>
                  @endforeach
                @endif
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>

    <div class="box-footer">
      <div class="pull-right">
        <div class="col-md-6" id="mensaje_almacen" style="display:none"></div>
        <div class="col-md-6" id="boton" style="display:none"></div>
        @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
          <button class="btn btn_temp btn-sm waves-effect" type="submit"><i class="fa fa-fw fa-file-pdf-o"></i> Descargar</button>              
        @endif
      </div>
    </div>
  </div>

    </form>
  <!-- /.box -->

</div>
</div>
</section>
<!-- /.col -->
@endsection