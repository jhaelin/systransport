<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro de Egreso?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletIngreso')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST"> 
        <input type="hidden" name="id" value="<?= $row->id_ingreso?>"> 
        <input type="hidden" name="id_flete" value="<?= $row->id_flete_camion?>">  
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-12 txt">
				<div class="form-group col-md-4">
					<label class="txt">Nro. Transporte:</label> {{$row->nro_transporte}}
				</div>

				<div class="form-group col-md-4"></div>

				<div class="form-group col-md-4">
					<label class="txt">Fecha:</label> {{$row->fecha_ing}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Cliente:</label> {{$row->nit}} - {{$row->razon_social}}  Representante: {{$row->nombre_representante}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Camión (Placa):</label> {{$row->matricula}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Ruta:</label> {{$row->nombre_ruta}} Km:{{$row->distancia_km}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Precio Unitario:</label> {{$row->precio_unidad}}
				</div>				
				<div class="form-group col-md-4">
					<label class="txt">Costo Total Flete:</label> {{$row->total_costo_flete}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Observaciones:</label> {{$row->observacion}}
				</div>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../ingreso'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


