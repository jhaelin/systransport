@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')       
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header"> 
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/ingreso')}}">Transaccciones</a></li>
    <li class="active">Listado de Ingresos</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash')  
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-plus-square"></i></strong> Listado de Ingresos </h3>
        @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
        <a class="btn btn_temp btn-sm pull-right" href="{{url('ingreso/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
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
                <th class="text-center tab_temp txt">Nro. Transporte</th>
                <th class="text-center tab_temp txt">Fecha</th>
                <th class="text-center tab_temp txt">Código</th>
                <th class="text-center tab_temp txt">N° Hoja de Entrada</th>
                <th class="text-center tab_temp txt">Doc. Compra</th>
                <th class="text-center tab_temp txt">Transportadora</th>
                <th class="text-center tab_temp txt">Placa</th>
                <th class="text-center tab_temp txt">N° Gasto</th>
                <th class="text-center tab_temp txt">Ruta</th>
                <th class="text-center tab_temp txt">Cliente</th>
                <th class="text-center tab_temp txt">Total Costo Flete</th>
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
                  <td class="text-justify txt">{{$value->nro_transporte}}</td>
                  <td class="text-justify txt">{{$value->fecha_ing}}</td>
                  <td class="text-justify txt">{{$value->codigo_ing}}</td>
                  <td class="text-justify txt">{{$value->nro_hoja_entrada}}</td>
                  <td class="text-justify txt">{{$value->doc_compra}}</td>
                  <td class="text-justify txt">{{$value->nombre_empresa}}</td>
                  <td class="text-justify txt">{{$value->matricula}}</td>
                  <td class="text-justify txt">{{$value->nro_gasto}}</td>
                  <td class="text-justify txt">{{$value->nombre_ruta}}</td>
                  <td class="text-justify txt">{{$value->razon_social}}</td>
                  <td class="text-justify txt">{{$value->total_costo_flete}}</td>

                  <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('IngresoController@edit', Crypt::encrypt($value->id_ingreso))}}">
                     <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                  </td>
                  @if(Auth::user()->id_rol==1)
                  <td class="text-center">
                    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#darBaja{{$value->id_ingreso}}" href="{{'deleteIngreso/'.Crypt::encrypt($value->id_ingreso)}}" role="button">
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
  <div class="modal fade modal-danger" id="darBaja{{$value->id_ingreso}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
 @include('errors.mensajeInfo')
@endsection