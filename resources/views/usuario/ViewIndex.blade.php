@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/persona')}}">Configuración</a></li>
    <li class="active">Listado de Usuario</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-group"></i></strong> Listado de Usuarios </h3>
        @if (Auth::user()->id_rol == 1)
        <a class="btn btn_temp btn-sm pull-right" href="{{url('usuario/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
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
                      <th class="text-center tab_temp txt">Código Usuario</th>
                      <th class="text-center tab_temp txt">Nombres y Apellidos</th>
                      <th class="text-center tab_temp txt">C.I.</th>
                      <th class="text-center tab_temp txt">Email</th>
                      <th class="text-center tab_temp txt">Teléfono</th>
                      <th class="text-center tab_temp txt">Celular</th>
                      <th class="text-center tab_temp txt">Tipo Usuario</th>
                      <th class="text-center tab_temp txt">Foto</th>
                      <th class="text-center tab_temp txt">Habilitación</th>
                      <th class="text-center tab_temp txt"></th>
                      <th class="text-center tab_temp txt"></th>
                  </tr>
              </thead>
              <tbody>
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->codigo_usuario}}</td>
                      <td class="text-justify txt">{{$value->nombre}} {{$value->paterno}} {{$value->materno}}</td>
                      <td class="text-justify txt">{{$value->ci}} {{$value->expedido}}</td>
                      <td class="text-justify txt">{{$value->email}}</td>
                      <td class="text-justify txt">{{$value->telefono}}</td>
                      <td class="text-justify txt">{{$value->celular}}</td>
                      <td class="text-justify txt">{{$value->tipo_usuario}}</td>
                      <td class="text-justify txt"><img src="{{url('uploads_files/'.$value->foto_)}}" style="height:50px; width:70px"></td>
                      <td class="text-center txt">{{$value->estado_usuario}}</td>

                      <td class="text-center"><a class="btn btn-info btn-xs waves-effect waves-float" href="{{action('UsuarioController@edit', Crypt::encrypt($value->id))}}">
                         <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-danger btn-xs waves-effect waves-float" data-toggle="modal" data-target="#darBaja{{$value->id}}" href="{{'deleteU/'.Crypt::encrypt($value->id)}}" role="button">
                        <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                      </td>
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
  <div class="modal fade modal-danger" id="darBaja{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
 @include('errors.mensajeInfo')
@endsection