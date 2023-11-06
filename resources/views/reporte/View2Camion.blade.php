@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repCamion')}}">Reportes</a></li>
    <li class="active">Camiones</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Camiones </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('camionPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 txt">
              <select name="camion" id="camion" class="form-control camion txt select2">
                  <option value="TODO" class="txt">TODOS los Camiones</option> 
                  @foreach($data as $val)
                  <option value="{{$val->id_camion}}">{{$val->matricula}} {{$val->marca}} {{$val->modelo}}</option>
                  @endforeach
              </select>
            <br><br>
            </div>
           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th class="text-center tab_temp txt">N°</th>
                      <th class="text-center tab_temp txt">Matrícula</th>
                      <th class="text-center tab_temp txt">Marca</th>
                      <th class="text-center tab_temp txt">Modelo</th>
                      <th class="text-center tab_temp txt">Descripción</th>
                      <th class="text-center tab_temp txt">Tipo de Vehículo</th>
                      <th class="text-center tab_temp txt">Fech Registro</th>
                  </tr>
              </thead>
              <tbody class="tbody">
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-center txt">{{$value->matricula}}</td>
                      <td class="text-center txt">{{$value->marca}}</td>
                      <td class="text-justify txt">{{$value->modelo}}</td>
                      <td class="text-justify txt">{{$value->descripcion_cam}}</td>
                      <td class="text-center txt">{{$value->tipo_vehiculo}}</td>
                      <td class="text-center txt">Z:{{$value->fecha_registro}}</td>
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