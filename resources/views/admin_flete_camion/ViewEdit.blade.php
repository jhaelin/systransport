@extends('adminlte.dashboard')  
@section('content') 
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/flete')}}">Administrar Flete de Camiones</a></li>
		<li class="active">Editar Flete de Camiones</li>
	</ol>
</section> 
<section class="content"> 
@include('errors.mensajeError')    
@include('errors.mensaje')

	<form id="formPerson" class="" role="form" method="post" action="{{action('AdminFleteCamionController@update',$id)}}" enctype='multipart/form-data'>
		{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-laptop"></i></strong> Editar Registro de Flete de Camiones</h3>
						<div class="box-tools pull-right">
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
							</div>
						</div>
					</div>

					<div class="box-body">
						<div class="row">

							<div class="col-md-12">
								<div class="form-group col-md-4">
									<label class="txt">Camión:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="camion" class="form-control" onclick="validar()" maxlength="" required>
											<option value="{{$row->id_camion}}">{{$row->matricula}} - {{$row->marca}} - {{$row->modelo}}</option>
										</select>									
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Conductor:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-user-secret"></i></div>
										<select id="expedido" name="conductor" class="form-control" onclick="validar()" maxlength="" required>
											<option value="{{$row->id_conductor}}">{{$row->nombre_con}} {{$row->paterno_con}} {{$row->materno_con}}</option>
											@foreach($conductor as $cn)
											<option value="{{$cn->id_conductor}}">{{$cn->nombre_con}} {{$cn->paterno_con}} {{$cn->materno_con}}</option>
											@endforeach
										</select>									
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Cliente:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="cliente" class="form-control" onclick="validar()" maxlength="" required>
											<option value="{{$row->id_cliente}}">{{$row->nit}} - {{$row->razon_social}}</option>
											@foreach($cliente as $cl)
											<option value="{{$cl->id_cliente}}">{{$cl->nit}} - {{$cl->razon_social}}</option>
											@endforeach
										</select>									
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Ruta:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="ruta" class="form-control" onclick="validar()" maxlength="" required>
											<option value="{{$row->id_ruta}}">{{$row->nombre_ruta}}, km:{{$row->distancia_km}}</option>
											@foreach($ruta as $r)
											<option value="{{$r->id_ruta}}">{{$r->nombre_ruta}}, km:{{$r->distancia_km}}</option>
											@endforeach
										</select>									
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="txt">Fecha:</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
											<input type="date" class="form-control datepikert" id="fecha_asignacion" name="fecha" value="{{$row->fecha_flete}}" maxlength="10" required >
										</div>
									</div>
								</div>
<!-- 								<div class="form-group col-md-4">
									<label class="txt">Estado:</label>
									<select id="materno" name="estado" class="form-control" onclick="validar()" maxlength="" required>
										<option value="{{$row->estado_flete}}">{{$row->estado_flete}}</option>
										<option value="HABILITADO">HABILITADO</option>
										<option value="DESHABILITADO">DESHABILITADO</option>
									</select>
								</div> -->

								<div class="col-md-12">
									<div class="form-group">
										<label class="txt">Descripción:</label>
										<div class="form-group">
											<textarea class="form-control" id="descripcion_cargo" name="descripcion" maxlength="1000" >{{$row->descripcion_flete}}</textarea>
										</div>
									</div>
								</div>

							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/flete')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<button type="submit" id="guardar" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>


@endsection

