@extends('adminlte.dashboard')  
@section('content')
@include('errors.mensajeError')       
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header"> 
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/egreso')}}">Transaccciones</a></li>
    <li class="active">Listado de Egresos</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-minus-square"></i></strong> Listado de Egresos </h3>
        @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
        <a class="btn btn_temp btn-sm pull-right" href="{{url('egreso/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
      @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
          <div class="table-responsive">
           <table id='datatables' class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center tab_temp txt">N°</th>
                <th class="text-center tab_temp txt">Nro. Factura</th>
                <th class="text-center tab_temp txt">Concepto Pago</th>
                <th class="text-center tab_temp txt">Cantidad</th>
                <th class="text-center tab_temp txt">Costo Unidad</th>
                <th class="text-center tab_temp txt">Costo Total</th>
                <th class="text-center tab_temp txt">Fecha</th>
                <th class="text-center tab_temp txt">Observaciones</th>
                @if(Auth::user()->id_rol==1)
                    <th class="text-center tab_temp txt"></th>
                @endif
                @if(Auth::user()->id_rol==1  || Auth::user()->id_rol==2)
                    <th class="text-center tab_temp txt"></th>
                @endif
              </tr>
            </thead>
            <tbody>
             @if($data)
               @foreach($data as $key=>$value)
               <tr>
                  <td class="text-center  txt">{{$key+1}}</td>
                  <td class="text-justify txt">{{$value->nro_factura}}</td>
                  <td class="text-justify txt">{{$value->concepto_pago}}</td>
                  <td class="text-justify txt">{{$value->cantidad}}</td>
                  <td class="text-justify txt">{{$value->costo_unidad}}</td>
                  <td class="text-justify txt">{{$value->costo_total}}</td>
                  <td class="text-justify txt">{{$value->fecha_e}}</td>
                  <td class="text-justify txt">{{$value->observacion}}</td>

                  <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('EgresoController@edit', Crypt::encrypt($value->id_egreso))}}">
                     <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                  </td>
                  @if(Auth::user()->id_rol==1)
                  <td class="text-center">
                    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#darBaja{{$value->id_egreso}}" href="{{'deleteEgreso/'.Crypt::encrypt($value->id_egreso)}}" role="button">
                    <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                  </td>
                  @endif
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

      </div>
    </div>

  </div>
  <!-- /.box -->

</div>
</div>
</section>
<!-- /.col -->

@foreach ($data as $value) 
  <div class="modal fade modal-danger" id="darBaja{{$value->id_egreso}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
 @include('errors.mensajeInfo')
@endsection