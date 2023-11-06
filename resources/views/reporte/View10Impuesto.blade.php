@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repImpuesto')}}">Reportes</a></li> 
    <li class="active">Cálculo de Impuestos</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content"> 

 @include('errors.mensaje_flash')  
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Cálculo de Impuestos </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('impuestoPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 txt">
                  <div class="form-group">
                      <div class="">
                          <input type="checkbox" id="md_checkbox_35" name="f1" value="TODO" class="buscarimp" checked>
                          <label for="md_checkbox_35"> TODOS</label>
                          <input type="hidden" id="md_checkbox_35" name="f2" value="TODO" class="buscarimp" checked>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f1" id="f1" class="form-control fech buscarimp" disabled>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">  
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f2" id="f2"class="form-control fech buscarimp" disabled>
                    </div>
                  </div>
                  <div class="col-lg-1"></div>
              </div>

           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">MONTO TOTAL DE INGRESOS ECONÓMICOS</th>
                    <th class="text-center tab_temp txt"></th>
                    <th class="text-center tab_temp txt">MONTO TOTAL DE EGRESOS ECONÓMICOS</th>
                  </tr>
              </thead>
              <tbody class="tbody"> 
                <?php $ing=0; $egr=0; $diferencia=0; $iva=0; $ing_iue=0; $iue=0; $impTotalPago=0; $impTotalPagar=0; $total=0; //var_dump($ing);?>                                   
                <tr>

                @if($ingr)
                  @foreach($ingr as $key=>$val)   
                      <td class="text-right txt">{{$val->total_ingreso}}</td>
                      <?php  $ingr=$val->total_ingreso; ?>
                  @endforeach
                @endif
                 <th class="text-center txt"></th>
                @if($egre)
                  @foreach($egre as $key=>$value)       
                      <td class="text-right txt">{{$value->total_egreso}}</td>
                  @endforeach
                  <?php $egre=$value->total_egreso; ?>
                @endif
              </tr>
              <?php 
                    $diferencia= $ingr-$egre;
                    $iva=$diferencia*(0.13);
                    $ing_iue=$ing*(0.03);
                    $impTotalPago=$iva+$ing_iue;

                    $iue=$diferencia*(0.25);
                    $impTotalPagar=$iue;

              ?>
              <tr>
                      <td class="text-right txt"><b>TOTAL PAGO IMPUESTO</b></td>
                      <td class="text-right txt"><b>{{$impTotalPago}}</b></td>
                      <th class="text-center txt"></th>
              </tr>
              <tr>
                      <td class="text-right txt"><b>TOTAL PAGAR IUE</b></td>
                      <td class="text-right txt"><b>{{$impTotalPagar}}</b></td>
                      <th class="text-center txt"></th>
              </tr>
              <?php $total=$impTotalPago+$impTotalPagar;?>

              <tr>
                      <td class="text-right txt"><b>TOTAL A PAGAR</b></td>
                      <td class="text-right txt"><b>{{$total}}</b></td>
                      <th class="text-left txt"> BOLIVIANOS</th>
              </tr>
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