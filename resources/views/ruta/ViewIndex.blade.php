@extends('adminlte.dashboard')  
@section('content') 
@include('errors.mensajeError')     
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header"> 
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/ruta')}}">Rutas</a></li>
    <li class="active">Listado de Rutas</li>
  </ol><br>
</section> 

<!-- Main content -->
<section class="content">
 @include('errors.mensaje_flash')
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-map-marker"></i> </strong> Listado de Rutas </h3>
        @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
         <a class="btn btn_temp btn-sm pull-right" href="{{url('ruta/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
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
                <th class="text-center tab_temp txt">Nombre Ruta</th>
                <th class="text-center tab_temp txt">Distancia Km</th>
                <th class="text-center tab_temp txt">Descripción Ruta</th>
                @if(Auth::user()->id_rol==1 || Auth::user()->id_rol == 2)
                    <th class="text-center tab_temp txt">Estado</th>
                    <th class="text-center tab_temp txt"></th>
                    <th class="text-center tab_temp txt"></th>
                @endif
              </tr>
            </thead>
            <tbody>
           @if($data)
           @foreach($data as $key=>$value)
            <tr>
              <td class="text-center txt">{{$key+1}}</td>
              <td class="text-justify txt">{{$value->nombre_ruta}}</td>
              <td class="text-justify txt">{{$value->distancia_km}}</td>
              <td class="text-justify txt">{{$value->descripcion_ruta}}</td>
              @if(Auth::user()->id_rol==1 || Auth::user()->id_rol == 2)
                  <?php $comprobar=0; $comp1=0;?>
                  @foreach ($vc as $v)  
                     @if($v->id_ruta==$value->id_ruta)
                         <?php $comprobar=1;?>
                     @endif
                  @endforeach

                  @if($comprobar==1 || $comp1==1)    
                     <td class="text-center txt">ACTIVO</td>
                      <td class="text-center"><a class="btn btn-info waves-effect btn-xs" href="{{action('RutaController@edit', Crypt::encrypt($value->id_ruta))}}">
                         <i class="fa fa-fw fa-pencil-square-o"></i> Edita</a>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-danger btn-xs waves-effect waves-float" data-toggle="modal"  data-target="#mensaje"role="button">
                        <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                      </td>
                  @else
                      <td class="text-center txt">INACTIVO</td>
                      <td class="text-center"><a class="btn btn-info waves-effect btn-xs" href="{{action('RutaController@edit', Crypt::encrypt($value->id_ruta))}}">
                         <i class="fa fa-fw fa-pencil-square-o"></i> Edita</a>
                      </td>
                      <td class="text-center">
                        <a class="btn bg-red waves-effect btn-xs" data-toggle="modal" data-target="#darBaja{{$value->id_ruta}}" href="{{'deleteRuta/'.Crypt::encrypt($value->id_ruta)}}" role="button">
                        <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                      </td>
                  @endif
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
  <div class="modal fade modal-danger" id="darBaja{{$value->id_ruta}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
@endsection
 @include('errors.mensajeInfo')