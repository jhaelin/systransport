@extends('adminlte.dashboard')   
@section('content')
<section class="content-header">  
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/camion')}}">Camiones</a></li>
		<li class="active">Editar Camiones</li>
	</ol>
</section> 
<section class="content"> 
@include('errors.mensajeError')    
@include('errors.mensaje')

	<form id="formPerson" class="" role="form" method="post" action="{{action('CamionController@update',$id)}}" enctype='multipart/form-data'>
		{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-user-plus"></i></strong> Editar Registro de Camiones</h3>
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
									<input type="text" id="nombre" name="matricula" value="{{$row->matricula}}" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num_car')" maxlength="50" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Marca:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-thumb-tack"></i></div>
									<input type="text" id="materno" name="marca" value="{{$row->marca}}" class="form-control" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Modelo:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-history"></i></div>
									<input type="text" id="materno" name="modelo" value="{{$row->modelo}}" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Tipo Vehículo:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<input type="text" id="direccion_zona" name="tipo" value="{{$row->tipo_vehiculo}}" class="form-control" onclick="validar()" maxlength="100" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Fecha Registro:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
										<input type="date" id="celular" name="fecha" value="{{$row->fecha_registro}}" class="form-control" maxlength="10" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Foto:</label>		
                                            <img src="{{url('uploads_files/'.$row->foto_cam)}}" class="archivo3" style="height:50px; width:100px">
                                            <input type="text" name="archivo" class="form-control archivo2" value="{{$row->foto_cam}}" id="archivo" placeholder="foto">
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-camera"></i></div>
									    <input type="file" id="archivo" name="archivo" class="form-control archivo" onclick="validar()" onkeypress="return permite(event, 'car')" maxlength="200">
									</div>	
								</div>

								<div class="form-group col-md-12">
									<label class="txt">Descripción:</label>
								    <textarea class="form-control" id="nombre" name="descripcion" style="margin: 0px -0.711806px 0px 0px;" required>{{$row->descripcion_cam}}</textarea>
								</div>

							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/camion')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<button type="submit" id="guardar" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>


@endsection

