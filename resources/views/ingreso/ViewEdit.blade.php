@extends('adminlte.dashboard')  
@section('content')
<section class="content-header">  
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/ingreso')}}">Transacciones</a></li>
		<li class="active">Editar Ingreso</li> 
	</ol>
</section> 
<section class="content"> 
@include('errors.mensajeError')    
@include('errors.mensaje')

	<form id="formPerson" class="" role="form" method="post" action="{{action('IngresoController@update',$id)}}" enctype='multipart/form-data'>
		{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-plus-square"></i></strong> Editar Registro de Ingreso</h3>
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
									<label class="txt">Nro. Transporte:</label>
									<input type="text" id="nombre" name="transporte" value="{{$row->nro_transporte}}" class="form-control" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="60" required>
								</div>
								<div class="col-md-4"></div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="txt">Fecha:</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
											<input type="date" value="{{$row->fecha_ing}}" class="form-control datepikert" id="fecha_asignacion" name="fecha" value="<?php echo date("Y-m-d");?>" maxlength="10" required >
										</div>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Código:</label>
									<input type="text" id="paterno" name="codigo" value="{{$row->codigo_ing}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="form-group col-md-4">
									<label class="txt">N° Hoja de Entrada:</label>
									<input type="text" id="paterno" name="hoja_entrada" value="{{$row->nro_hoja_entrada}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Doc. Compra:</label>
									<input type="text" id="paterno" name="doc_compra" value="{{$row->doc_compra}}" class="form-control" onkeypress="return permite(event, 'num_car')" maxlength="50">
								</div>

								<div class="form-group col-md-8">
									<label class="txt">Transportadora (Empresa):</label>
									<input type="text" id="nombre" name="transportadora" value="{{$row->nombre_empresa}}" class="form-control" onkeypress="return permite(event, 'num_car')" readonly maxlength="100">
								</div>
                                <div class="form-group col-md-12"></div>
								<div class="form-group col-md-4">
									<label class="txt">Placa:</label>

									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="camion" class="form-control placa" onclick="validar()" maxlength="" required>
											<option value="{{$row->id_camion}}">{{$row->matricula}} -  {{$row->marca}} - {{$row->modelo}}</option>											
<!-- 											@foreach($camion as $c)
											@if($row->id_camion!=$c->id_camion)
											<option value="{{$c->id_camion}}">{{$c->matricula}} - {{$c->marca}} - {{$c->modelo}}</option>
											@endif
											@endforeach -->
										</select>									
									</div>
									<div class="input-group cam" style="display:none">
									<input type="text" name="id_flete" class="form-control" maxlength="50">
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">N° Gasto:</label>
									<input type="text" id="paterno" name="gasto" value="{{$row->nro_gasto}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Hoja de Trabajo:</label>
									<input type="text" id="paterno" name="hoja_trabajo" value="{{$row->hoja_trabajo}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="form-group col-md-8">
									<label class="txt">Cliente:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="cliente" class="form-control cliente" onclick="validar()" maxlength="" readonly required>
											<option value="{{$row->id_cliente}}">{{$row->nit}} - {{$row->razon_social}}  Representante: {{$row->nombre_representante}} </option>
										</select>									
									</div>
								</div>

								<div class="col-md-12"></div>

								<div class="form-group col-md-4">
									<label class="txt">Tonelada (TN):</label>
									<input type="text" id="cantidad" name="cantidad" value="{{$row->tonelada_tn}}" class="form-control sum"  onblur="sum()" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="60" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Precio Unidad:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-newspaper-o"></i></div>
										<input type="text" id="unidad" name="unidad" value="{{$row->precio_unidad}}" class="form-control sum" maxlength="8"   onblur="sum()" onclick="validar()" onkeypress="return permite(event, 'num')" maxlength="11" required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Total Costo Flete:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-newspaper-o"></i></div>
										<input type="text" id="total" name="total" value="{{$row->total_costo_flete}}" class="form-control sum" maxlength="7"   onblur="sum()" onkeypress="return permite(event, 'num')" readonly required>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Ruta:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-truck"></i></div>
										<select id="expedido" name="ruta" class="form-control ruta" onclick="validar()" readonly maxlength="" required>
											<option value="{{$row->id_ruta}}">{{$row->nombre_ruta}} Km: {{$row->distancia_km}}</option>
										</select>									
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">N° Entrega:</label>
									<input type="text" id="paterno" name="num_entrega" value="{{$row->nro_entrega}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="form-group col-md-4">
									<label class="txt">N° Material/N° Mercadería:</label>
									<input type="text" id="paterno" name="num_matrial" value="{{$row->nro_material_mercaderia}}" class="form-control" onkeypress="return permite(event, 'num')" maxlength="50">
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="txt">Observaciones:</label>
										<div class="form-group">
											<textarea class="form-control" id="descripcion_cargo" name="observacion" maxlength="1000" >{{$row->observacion}}</textarea>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/ingreso')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<button type="submit" id="guardar" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>


@endsection

