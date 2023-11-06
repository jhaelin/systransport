@extends('adminlte.dashboard')   
@section('content')
@include('errors.mensajeError')      
@include('errors.mensaje') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><small></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
    <li><a href="{{asset('/repCliente')}}">Reportes</a></li>
    <li class="active">Clientes</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">

 @include('errors.mensaje_flash') 
  <div class="row">
    <div class="col-xs-12">

      <div class="box box_temp">
        <div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-file-text"></i></strong> Reporte de Clientes </h3></div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- /.box-header -->
      <form id="rep" method="GET" novalidate="novalidate" target="_blank" action="{{url('clientePdf')}}" enctype='multipart/form-data'>
          {{csrf_field()}}
          <div class="table-responsive">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 txt">
              <select name="cliente" id="cliente" class="form-control cliente txt select2">
                  <option value="TODO" class="txt">TODOS los Clientes</option> 
                  @foreach($data as $val)
                  <option value="{{$val->id_cliente}}">{{$val->nit}} {{$val->razon_social}} {{$val->nombre_representante}}</option>
                  @endforeach
              </select>
            <br><br>
            </div>
           <table id='' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">NIT</th>
                    <th class="text-center tab_temp txt">Razón Social</th>
                    <th class="text-center tab_temp txt">Nro. Autorización</th>
                    <th class="text-center tab_temp txt">Nombre de Representante</th>
                    <th class="text-center tab_temp txt">C.I.</th>
                    <th class="text-center tab_temp txt">Dirección Empresa</th>
                    <th class="text-center tab_temp txt">Email</th>
                    <th class="text-center tab_temp txt">Fax</th>
                    <th class="text-center tab_temp txt">Teléfono/Celular</th>
                  </tr>
              </thead>
              <tbody class="tbody">
                @if($data)
                  @foreach($data as $key=>$value)                                       
                    <tr>
                      <td class="text-center  txt">{{$key+1}}</td>
                      <td class="text-justify txt">{{$value->nit}}</td>
                      <td class="text-justify txt">{{$value->razon_social}}</td>
                      <td class="text-justify txt">{{$value->nro_autorizacion}}</td>
                      <td class="text-justify txt">{{$value->nombre_representante}}</td>
                      <td class="text-justify txt">{{$value->ci_representante}}</td>
                      <td class="text-justify txt">Ciudad:{{$value->ciudad_cli}}, Z:{{$value->zona_cli}} C/{{$value->calle_cli}} N° {{$value->numero_cli}}</td>
                      <td class="text-justify txt">{{$value->email_cli}}</td>
                      <td class="text-justify txt">{{$value->fax_cli}}</td>
                      <td class="text-justify txt">{{$value->telefono_cli}}/{{$value->celular_cli}}</td>
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