@extends('adminlte.dashboard')   
@section('content')
<section class="content-header">  
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/egreso')}}">Transacciones</a></li>
		<li class="active">Nuevo Egreso</li>
	</ol>
</section> 
<section class="content">
@include('errors.mensajeError')     
@include('errors.mensaje')
	<form id="formPerson" class="" role="form" method="post" action="{{url('egreso')}}" enctype='multipart/form-data'> 
		{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-minus-square"></i></strong> Registrar Nuevo Egreso</h3>
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
									<label class="txt">Nro. Factura:</label>
									<input type="text" id="nombre" name="factura" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="60" required>
								</div>
								<div class="col-md-4"></div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="txt">Fecha:</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
											<input type="date" class="form-control datepikert" id="fecha_asignacion" name="fecha" value="<?php echo date("Y-m-d");?>" maxlength="10" required >
										</div>
									</div>
								</div>

								<div class="form-group col-md-12">
									<label class="txt">Concepto Pago:</label>
									<input type="text" id="paterno" name="concepto" class="form-control" onkeypress="return permite(event, 'num_car')" maxlength="500">
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Cantidad:</label>
									<input type="text" id="cantidad" name="cantidad" class="form-control sum"  onblur="sum()" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="60" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Costo Unidad:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-newspaper-o"></i></div>
										<input type="text" id="unidad" name="unidad" class="form-control sum" maxlength="8"   onblur="sum()" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="11" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Costo Total:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
										<input type="text" id="total" name="total" class="form-control sum" maxlength="7"   onblur="sum()" onkeypress="return permite(event, 'num')" readonly>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="txt">Observaciones:</label>
										<div class="form-group">
											<textarea class="form-control" id="descripcion_cargo" name="observacion" maxlength="1000" ></textarea>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/egreso')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<a class="btn btn-default btn-sm" href="{{url('egreso/create')}}"><span class="glyphicon glyphicon-repeat"></span> Limpiar</a>
							<button type="submit" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>
@endsection

