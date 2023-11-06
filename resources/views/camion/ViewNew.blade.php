@extends('adminlte.dashboard')  
@section('content')
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/camion')}}">Camiones</a></li>
		<li class="active">Nuevo Camiones</li>
	</ol>
</section> 
<section class="content">
@include('errors.mensajeError')    
@include('errors.mensaje')
	<form id="formPerson" class="" role="form" method="post" action="{{url('camion')}}" enctype='multipart/form-data'> 
		{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-truck"></i></strong> Registrar Nuevo Camiones</h3>
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
									<label class="txt">Matrícula:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></div>
									<input type="text" id="nombre" name="matricula" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num_car')" maxlength="50" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Marca:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-thumb-tack"></i></div>
									<input type="text" id="materno" name="marca" class="form-control" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Modelo:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-history"></i></div>
									<input type="text" id="materno" name="modelo" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Tipo Vehículo:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<input type="text" id="direccion_zona" name="tipo" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Fecha Registro:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
										<input type="date" id="celular" name="fecha" value="<?php echo date("Y-m-d");?>" class="form-control" maxlength="10" required>
									</div>
								</div>
								<?php  // http://systransport/uploads_files/
								$imagen = "public/uploads_files/camion_defecto.jpg";?>
								<div class="form-group col-md-4">
									<label class="txt">Foto:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-camera"></i></div>
										<!-- <input type="hidden" id="nombre" name="archivo" class="form-control" onclick="validar()" value="{{$imagen}}" onkeypress="return permite(event, 'car')" maxlength="60" required> -->

									    <input type="file" id="nombre" name="archivo" class="form-control" onclick="validar()" value="{{$imagen}}" onkeypress="return permite(event, 'car')" maxlength="60">
									</div>	
								</div>

								<div class="form-group col-md-12">
									<label class="txt">Descripción:</label>
								    <textarea class="form-control" id="nombre" name="descripcion" style="margin: 0px -0.711806px 0px 0px;" maxlength="1000" required></textarea>
								</div>

							</div>

						</div>
					</div>

					

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/camion')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<a class="btn btn-default btn-sm" href="{{url('camion/create')}}"><span class="glyphicon glyphicon-repeat"></span> Limpiar</a>
							<button type="submit" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>
@endsection

