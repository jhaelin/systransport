@extends('adminlte.dashboard')   
@section('content')
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/cliente')}}">Cliente</a></li>
		<li class="active">Nuevo Cliente</li>
	</ol>
</section> 
<section class="content">
@include('errors.mensajeError')    
@include('errors.mensaje')
	<form id="formPerson" class="" role="form" method="post" action="{{url('cliente')}}" enctype='multipart/form-data'> 
		{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-institution"></i></strong> Registrar Nuevo Cliente</h3>
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
								<div class="form-group col-md-12">
									<!-- <label class="txt bg-yellow">Datos requeridos (*)</label> -->
								</div>
								<div class="form-group col-md-4">
									<label class="txt">NIT:</label>
									<input type="text" id="nombre" name="nit" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num_car')" maxlength="60" required>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Razón Social:</label>
									<input type="text" id="materno" name="razon" class="form-control" maxlength="60" required>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Nro. Autorización:</label>
									<input type="text" id="materno" name="autorizacion" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="60" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Nombre Representante:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
									    <input type="text" id="nombre" name="nombre" pattern="[^'\x220-9]+" class="form-control" maxlength="150" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Cédula de Identidad (C.I.):</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-newspaper-o"></i></div>
										<input type="text" id="ci" name="ci" class="form-control" maxlength="10" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="11" required>
									</div>
								</div>
								<div class="form-group col-md-2">
									<label class="txt">Exp.:</label>
									<select id="expedido" name="exp" class="form-control" onclick="validar()" maxlength="" required>
										<option value="LP">LP</option>
										<option value="OR">OR</option>
										<option value="CBBA">CBBA</option>
										<option value="CH">CH</option>
										<option value="PT">PT</option>
										<option value="SC">SC</option>
										<option value="BN">BN</option>
										<option value="TJ">TJ</option>
										<option value="PND">PND</option>
										<option value="PERU">PERU</option>
										<option value="ITA">ITA</option>
										<option value="OTRO">OTRO</option>
									</select>
								</div>
								<div class="form-group col-md-2"></div>
								<div class="form-group col-md-4">
									<label class="txt">Dirección Ciudad:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-globe"></i></div>
										<input type="text" id="direccion_zona" name="ciudad" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Dirección Zona/Villa:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-home"></i></div>
										<input type="text" id="direccion_zona" name="zona" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-2">
									<label class="txt">Dirección Calle/Av.:</label>
									<input type="text" id="direccion_calle" name="calle" class="form-control" onclick="validar()" maxlength="100" required>
								</div>
								<div class="form-group col-md-2">
									<label class="txt">Dirección N°:</label>
									<input type="text" id="direccion_numero" name="num" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="10" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Fax:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-fax"></i></div>
										<input type="text" id="direccion_zona" name="fax" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num_car')" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Email:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-at"></i></div>
									    <input type="email" id="paterno" name="email" class="form-control" onclick="validar()" maxlength="100">
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Web:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-wikipedia-w"></i></div>
									    <input type="text" id="paterno" name="web" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num_car')" maxlength="100">
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Teléfono:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
										<input type="text" id="celular" name="tel" class="form-control" maxlength="7" onkeypress="return permite(event, 'num')" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Celular:</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
										<input type="text" id="celular" name="cel" class="form-control" maxlength="8" onclick="validar()" onkeypress="return permite(event, 'num')" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Logo:</label>	
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-camera"></i></div>
									    <input type="file" id="nombre" name="archivo" class="form-control" onclick="validar()" onkeypress="return permite(event, 'car')" maxlength="200">
									</div>								
								</div>

							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/cliente')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<a class="btn btn-default btn-sm" href="{{url('cliente/create')}}"><span class="glyphicon glyphicon-repeat"></span> Limpiar</a>
							<button type="submit" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>
@endsection

