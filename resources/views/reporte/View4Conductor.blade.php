@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repConductor')}}">Reportes</a></li>
    <li class="active">Conductor</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Conductor </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('conductorPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 txt">
              <select name="conductor" id="conductor" class="form-control conductor txt select2">
                  <option value="TODO" class="txt">TODOS los Conductores</option> 
                  @foreach($data as $val)
                  <option value="{{$val->id_conductor}}">{{$val->nombre_con}} {{$val->paterno_con}} {{$val->materno_con}} CI: {{$val->ci_con}} {{$val->expedido_con}}</option>
                  @endforeach
              </select>
            <br><br>
            </div>
           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th class="text-center tab_temp txt">N°</th>
                      <th class="text-center tab_temp txt">Nombres</th>
                      <th class="text-center tab_temp txt">Ap. Paterno</th>
                      <th class="text-center tab_temp txt">Ap. Materno</th>
                      <th class="text-center tab_temp txt">Carnet</th>
                      <th class="text-center tab_temp txt">Categoria Licencia</th>
                      <th class="text-center tab_temp txt">Dirección</th>
                      <th class="text-center tab_temp txt">Teléfono/Celular</th>
                      <th class="text-center tab_temp txt">Fecha</th>
                  </tr>
              </thead>
              <tbody class="tbody">
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->nombre_con}}</td>
                      <td class="text-justify txt">{{$value->paterno_con}}</td>
                      <td class="text-justify txt">{{$value->materno_con}}</td>
                      <td class="text-justify txt">{{$value->ci_con}} {{$value->expedido_con}}</td>
                      <td class="text-justify txt">{{$value->categoria_licencia}}</td>
                      <td class="text-justify txt">{{$value->direccion_con}}</td>
                      <td class="text-justify txt">{{$value->telefono_con}} / {{$value->celular_con}}</td>
                      <td class="text-justify txt"></td>
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