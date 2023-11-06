@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repEgreso')}}">Reportes</a></li>
    <li class="active">Egresos Económicos</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content"> 

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Egresos Económicos </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('egresoPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 txt">
                  <div class="form-group">
                      <div class="">
                          <input type="checkbox" id="md_checkbox_35" name="f1" value="TODO" class="buscar" checked>
                          <label for="md_checkbox_35"> TODOS</label>
                          <input type="hidden" id="md_checkbox_35" name="f2" value="TODO" class="buscar" checked>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f1" id="f1" class="form-control fech buscar" disabled>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">  
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f2" id="f2"class="form-control fech buscar" disabled>
                    </div>
                  </div>
                  <div class="col-lg-1"></div>
              </div>

           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">Nro. Factura</th>
                    <th class="text-center tab_temp txt">Concepto Pago</th>
                    <th class="text-center tab_temp txt">Cantidad</th>
                    <th class="text-center tab_temp txt">Costo Unidad</th>
                    <th class="text-center tab_temp txt">Costo Total</th>
                    <th class="text-center tab_temp txt">Observaciones</th>
                    <th class="text-center tab_temp txt">Fecha</th>
                  </tr>
              </thead>
              <tbody class="tbody"><?php $cantidad=0; $costo_unidad=0;$costo_total=0;?>
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->nro_factura}}</td>
                      <td class="text-justify txt">{{$value->concepto_pago}}</td>
                      <td class="text-center txt">{{$value->cantidad}}</td>
                      <td class="text-right txt">{{$value->costo_unidad}}</td>
                      <td class="text-right txt">{{$value->costo_total}}</td>
                      <td class="text-justify txt">{{$value->observacion}}</td>
                      <td class="text-justify txt">{{$value->fecha_e}}</td>
                    </tr>
                    <?php $cantidad=$cantidad+$value->cantidad; 
                          $costo_unidad=$costo_unidad+$value->costo_unidad;
                          $costo_total=$costo_total+$value->costo_total;?>
                  @endforeach                                                         
                    <tr>
                      <td class="text-right  txt" colspan="3"><b>TOTAL</b></td>
                      <td class="text-center txt"><b>{{$cantidad}}</b></td>
                      <td class="text-right txt"><b>{{$costo_unidad}}</b></td>
                      <td class="text-right txt"><b>{{$costo_total}}</b></td>
                      <td class="text-justify txt"><b>BOLIVIANOS</b></td>
                      <td class="text-justify txt"></td>
                    </tr>
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