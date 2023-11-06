@extends('adminlte.dashboard')    
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) --> 
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repIngreso')}}">Reportes</a></li>
    <li class="active">Ingresos Económicos</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content"> 

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Ingresos Económicos </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('ingresoPdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 txt">
                  <div class="form-group">
                      <div class="">
                          <input type="checkbox" id="md_checkbox_35" name="f1" value="TODO" class="buscaringreso" checked>
                          <label for="md_checkbox_35"> TODOS</label>
                          <input type="hidden" id="md_checkbox_35" name="f2" value="TODO" class="buscaringreso" checked>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f1" id="f1" class="form-control fech buscaringreso" disabled>
                    </div>
                  </div>
                  <!-- <div class="col-lg-1"></div> -->
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 txt">  
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                      <input type="date" name="f2" id="f2"class="form-control fech buscaringreso" disabled>
                    </div>
                  </div>
                  <div class="col-lg-1"></div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 txt">
                    <select name="id_cliente" id="id_cliente" class="form-control buscaringreso txt select2">
                        <option value="TODO" class="txt">TODOS los Clientes</option>
                        @foreach($cliente as $cl)
                        <option value="{{$cl->id_cliente}}">{{$cl->nit}} - {{$cl->razon_social}}</option>
                        @endforeach
                    </select>
                  <br><br>
                  </div>
              </div>

           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">Nro. Transporte</th>
                    <th class="text-center tab_temp txt">Fecha</th>
                    <th class="text-center tab_temp txt">Código</th>
                    <th class="text-center tab_temp txt">N° Hoja de Entrada</th>
                    <th class="text-center tab_temp txt">Doc. Compra</th>
                    <th class="text-center tab_temp txt">Transportadora(Empresa)</th>
                    <th class="text-center tab_temp txt">Placa</th>
                    <th class="text-center tab_temp txt">N° Gasto</th>
                    <th class="text-center tab_temp txt">Hoja de Trabajo</th>
                    <th class="text-center tab_temp txt">Cliente</th>
                    <th class="text-center tab_temp txt">Tonelada(TN)</th>
                    <th class="text-center tab_temp txt">Precio Unidad</th>
                    <th class="text-center tab_temp txt">Total Costo Flete</th>
                    <th class="text-center tab_temp txt">Ruta</th>
                    <th class="text-center tab_temp txt">Nº Entrega, Nº Material/Nº Mercadería</th>
                    <th class="text-center tab_temp txt">Observaciones</th>
                    <th class="text-center tab_temp txt">Fecha Registro</th>
                  </tr>
              </thead>
              <tbody class="tbody"><?php $cantidad=0; $costo_unidad=0;$costo_total=0;?>
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->nro_transporte}}</td>
                      <td class="text-justify txt">{{$value->fecha_ing}}</td>
                      <td class="text-justify txt">{{$value->codigo_ing}}</td>
                      <td class="text-justify txt">{{$value->nro_hoja_entrada}}</td>
                      <td class="text-justify txt">{{$value->doc_compra}}</td>
                      <td class="text-justify txt">{{$value->nombre_empresa}}</td>
                      <td class="text-justify txt">{{$value->matricula}}</td>
                      <td class="text-justify txt">{{$value->nro_gasto}}</td>
                      <td class="text-justify txt">{{$value->hoja_trabajo}}</td>
                      <td class="text-justify txt">{{$value->razon_social}}</td>
                      <td class="text-center txt">{{$value->tonelada_tn}}</td>
                      <td class="text-right txt">{{$value->precio_unidad}}</td>
                      <td class="text-right txt">{{$value->total_costo_flete}}</td>
                      <td class="text-justify txt">{{$value->nombre_ruta}}</td>
                      <td class="text-justify txt">{{$value->nro_entrega}}, {{$value->nro_entrega}} </td>
                      <td class="text-justify txt">{{$value->nro_material_mercaderia}}</td>
                      <td class="text-justify txt">{{$value->fecha_registro_ing}}</td>
                    </tr>
                    <?php $cantidad=$cantidad+$value->tonelada_tn; 
                          $costo_unidad=$costo_unidad+$value->precio_unidad;
                          $costo_total=$costo_total+$value->total_costo_flete;?>
                  @endforeach                                                         
                    <tr>
                      <td class="text-right  txt" colspan="11"><b>TOTAL</b></td>
                      <td class="text-center txt"><b>{{$cantidad}}</b></td>
                      <td class="text-right txt"><b>{{$costo_unidad}}</b></td>
                      <td class="text-right txt"><b>{{$costo_total}}</b></td>
                      <td class="text-justify txt"><b>BOLIVIANOS</b></td>
                      <td class="text-justify txt" colspan="3"></td>
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