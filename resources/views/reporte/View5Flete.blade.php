@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repFlete')}}">Reportes</a></li>
    <li class="active">Flete de Camiones</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content"> 

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Flete de Camiones </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('fletePdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 txt">
                  <div class="form-group">
                      <div class="">
                          <input type="checkbox" id="md_checkbox_35" name="f1" value="TODO" class="busc" checked>
                          <label for="md_checkbox_35"> TODOS</label>
                          <input type="hidden" id="md_checkbox_35" name="f2" value="TODO" class="busc" checked>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f1" id="f1" class="form-control fech busc" disabled>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">  
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f2" id="f2"class="form-control fech busc" disabled>
                    </div>
                  </div>
                  <div class="col-lg-1"></div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 txt">
                    <select name="estado" id="estado" class="form-control busc  select2">
                        <option value="TODO" class="txt">TODOS los Estados</option> 
                        <option value="HABILITADO" class="txt">HABILITADO</option> 
                        <option value="DESHABILITADO" class="txt">DESHABILITADO</option>
                    </select>
                  </div>
              </div>

           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">Camión</th>
                    <th class="text-center tab_temp txt">Conductor</th>
                    <th class="text-center tab_temp txt">Cliente</th>
                    <th class="text-center tab_temp txt">Ruta</th>
                    <th class="text-center tab_temp txt">Descripción</th>
                    <th class="text-center tab_temp txt">Fecha</th>
                    <th class="text-center tab_temp txt">Estado</th>
                  </tr>
              </thead>
              <tbody class="tbody">
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->matricula}} - {{$value->marca}} - {{$value->modelo}}</td>
                      <td class="text-justify txt">{{$value->nombre_con}} {{$value->paterno_con}} {{$value->materno_con}}</td>
                      <td class="text-justify txt">{{$value->nit}} - {{$value->razon_social}}</td>
                      <td class="text-justify txt">{{$value->nombre_ruta}}, km:{{$value->distancia_km}}</td>
                      <td class="text-justify txt">{{$value->descripcion_flete}}</td>
                      <td class="text-justify txt">{{$value->fecha_flete}}</td>
                      <td class="text-justify txt">{{$value->estado_flete}}</td>
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