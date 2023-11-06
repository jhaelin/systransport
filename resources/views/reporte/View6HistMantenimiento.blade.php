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
    <li class="active">Historial de Mantenimiento de Camiones</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content"> 

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Historial de Mantenimiento de Camiones </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('histmantenimientoPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
              <div class="row clearfix">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 txt">
                    <select name="idcamion" id="idcamion" class="form-control idcamion txt select2">
                        <option value="TODO" class="txt">Seleccione Camión</option> 
                        @foreach($camion as $val)
                        <option value="{{$val->id_camion}}">{{$val->matricula}} {{$val->marca}} {{$val->modelo}}</option>
                        @endforeach
                    </select>
                  </div><br><br>
              </div>
              
          <div id="datos">
           <table id='datocamion' class="table table-bordered table-striped">
           </table>

           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">Mantenimiento</th>
                    <th class="text-center tab_temp txt">Observaciones</th>
                    <th class="text-center tab_temp txt">Fecha Registro</th>
                    <th class="text-center tab_temp txt">Fecha Próxima Revisión</th>
                  </tr>
              </thead>
              <tbody class="tbody">
          </tbody>
        </table>
        </div>

      </div>
      <!-- /.box-body -->
    </div>

    <div class="box-footer">
      <div class="pull-right">
        <div class="col-md-6" id="mensaje_almacen" style="display:none"></div>
        <div class="col-md-6" id="boton" style="display:none"></div>
        @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
          <button class="btn btn_temp btn-sm waves-effect" id="btnhist" style="display:none" type="submit"><i class="fa fa-fw fa-file-pdf-o"></i> Descargar</button>              
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