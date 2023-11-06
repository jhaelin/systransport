@extends('adminlte.dashboard')  
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header"> 
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/conductor')}}">Conductor</a></li>
    <li class="active">Listado de Conductores</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-user-secret"></i></strong> Listado de Conductores </h3>
         @if (Auth::user()->id_rol == 1  || Auth::user()->id_rol==2)
          <a class="btn btn_temp btn-sm pull-right" href="{{url('conductor/create')}}"><i class="fa fa-fw fa-file-o"></i> Nuevo</a>
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
                <th class="text-center tab_temp txt">Nombres<font class="col">_</font>y<font class="col">_</font>Apellidos</th>
                <th class="text-center tab_temp txt"><font class="col">______</font>C.I.<font class="col">___</font></th>
                <th class="text-center tab_temp txt">Categoria Licencia</th>
                <th class="text-center tab_temp txt">Dirección</th>
                <th class="text-center tab_temp txt">Teléfono</th>
                <th class="text-center tab_temp txt">Celular</th>
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
                  <td class="text-justify txt">{{$value->nombre_con}} {{$value->paterno_con}} {{$value->materno_con}}</td>
                  <td class="text-justify txt">{{$value->ci_con}} {{$value->expedido_con}}</td>
                  <td class="text-justify txt">{{$value->categoria_licencia}}</td>
                  <td class="text-justify txt">{{$value->direccion_con}}</td>
                  <td class="text-justify txt">{{$value->telefono_con}}</td>
                  <td class="text-justify txt">{{$value->celular_con}}</td>

                  @if(Auth::user()->id_rol==1  || Auth::user()->id_rol==2)
                      <?php $comprobar=0;?>
                      @foreach ($vf as $v)  
                         @if($v->id_conductor==$value->id_conductor)
                             <?php $comprobar=1;?>
                         @endif
                      @endforeach

                      @if($comprobar==1)
                          <td class="text-center txt">ACTIVO</td>
                          <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('ConductorController@edit', Crypt::encrypt($value->id_conductor))}}">
                             <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                          </td>
                          <td class="text-center">
                            <a class="btn btn-danger btn-xs" data-toggle="modal"  data-target="#mensaje"role="button">
                            <i class="fa fa-fw fa-trash-o" data-toggle="tooltip" title="" data-original-title="Eliminar"></i> Eliminar</a>
                          </td>
                      @else
                          <td class="text-center txt">INACTIVO</td>
                          <td class="text-center"><a class="btn btn-info btn-xs" href="{{action('ConductorController@edit', Crypt::encrypt($value->id_conductor))}}">
                             <i class="fa fa-fw fa-pencil-square-o"></i> Editar</a>
                          </td>
                          <td class="text-center">
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#darBaja{{$value->id_conductor}}" href="{{'deleteConductor/'.Crypt::encrypt($value->id_conductor)}}" role="button">
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
  <div class="modal fade modal-danger" id="darBaja{{$value->id_conductor}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endforeach
 @include('errors.mensajeInfo')
@endsection