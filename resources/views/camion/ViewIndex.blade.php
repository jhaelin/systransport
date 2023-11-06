@extends('adminlte.dashboard')  
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/camion')}}">Camiones</a></li>
    <li class="active">Listado de Camiones</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-truck"></i></strong> Listado de Camiones </h3>
        @if (Auth::user()->id_rol == 1  || Auth::user()->id_rol==2)
        <a class="btn btn_temp btn-sm pull-right" href="{{url('camion/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
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
                <th class="text-center tab_temp txt">Matrícula</th>
                <th class="text-center tab_temp txt">Marca</th>
                <th class="text-center tab_temp txt">Modelo</th>
                <th class="text-center tab_temp txt">Descripción</th>
                <th class="text-center tab_temp txt">Tipo de Vehículo</th>
                <th class="text-center tab_temp txt">Fech Registro</th>
                <th class="text-center tab_temp txt">Fotografía</th>
                @if(Auth::user()->id_rol==1  || Auth::user()->id_rol==2)
                    <th class="text-center tab_temp txt">Habilitación</th>
                    <th class="text-center tab_temp txt"></th>
                    <th class="text-center tab_temp txt"></th>
                @endif
              </tr>
            </thead>
            <tbody>
             @if($data)
               @foreach($data as $key=>$value)
               <tr>
                  <td class="text-center  txt">{{$key+1}}</td>
                  <td class="text-justify txt">{{$value->matricula}}</td>
                  <td class="text-justify txt">{{$value->marca}}</td>
                  <td class="text-justify txt">Z:{{$value->modelo}}</td>
                  <td class="text-justify txt">{{$value->descripcion_cam}}</td>
                  <td class="text-justify txt">{{$value->tipo_vehiculo}}</td>
                  <td class="text-justify txt">Z:{{$value->fecha_registro}}</td>
                  <td class="text-justify txt"><img src="{{url('uploads_files/'.$value->foto_cam)}}" style="height:50px; width:50px"></td>

                  @if(Auth::user()->id_rol==1  || Auth::user()->id_rol==2)
                      <?php $comprobar=0;?>
                      @foreach ($vf as $v)  
                         @if($v->id_camion==$value->id_camion)
                             <?php $comprobar=1;?>
                         @endif
                      @endforeach

                      @if($comprobar==1)
                          <td class="text-center txt">ACTIVO</td>
                          <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('CamionController@edit', Crypt::encrypt($value->id_camion))}}">
                             <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                          </td>
                          <td class="text-center">
                            <a class="btn btn-danger btn-xs" data-toggle="modal"  data-target="#mensaje"role="button">
                            <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                          </td>
                      @else
                          <td class="text-center txt">INACTIVO</td>
                          <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('CamionController@edit', Crypt::encrypt($value->id_camion))}}">
                             <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                          </td>
                          <td class="text-center">
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#darBaja{{$value->id_camion}}" href="{{'deleteCamion/'.Crypt::encrypt($value->id_camion)}}" role="button">
                            <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                          </td>
                      @endif
                  @endif

                <?php $comprobar=0;?>
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
  <div class="modal fade modal-danger" id="darBaja{{$value->id_camion}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
 @include('errors.mensajeInfo')
@endsection