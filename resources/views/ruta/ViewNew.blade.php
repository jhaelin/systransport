@extends('adminlte.dashboard')  
@section('content')
<section class="content-header">
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/ruta')}}">Rutas</a></li>
		<li class="active">Nuevas Rutas</li>
	</ol>
</section> 
<section class="content">
	@include('errors.mensajeError')    
	@include('errors.mensaje')
	<form id="form_pei" name="form_pei" class="" role="form" method="post" action="{{url('ruta')}}">
        {{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><i class="fa fa-fw fa-map-marker"></i></strong> Registrar Nuevas Rutas </h3>
						<div class="box-tools pull-right">
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
							</div>
						</div>
					</div>
					<div class="box-body"> 
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
								    <label class="txt">Nombre Ruta:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
										<input type="text" class="form-control" id="nombre_cargo" name="nombre" maxlength="1000" required>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="txt">Distancia Km:</label>
									<div class="form-group">
										<textarea class="form-control" id="descripcion_cargo" name="distancia" maxlength="100" required></textarea>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="txt">Descripción Ruta:</label>
									<div class="form-group">
										<textarea class="form-control" id="descripcion_cargo" name="descripcion" maxlength="1000" ></textarea>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/ruta')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<a class="btn btn-default btn-sm" href="{{url('ruta/create')}}"><span class="glyphicon glyphicon-repeat"></span> Limpiar</a>
							<button type="submit" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>
@endsection

