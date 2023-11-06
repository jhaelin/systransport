<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro del Flete de Camión?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletAdminFleteCamion')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST"> 
        <input type="hidden" name="id" value="<?= $row->id_flete_camion?>"> 
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-12 txt">
				<div class="form-group col-md-6">
					<label class="txt">Camión:</label> {{$row->matricula}} - {{$row->marca}} - {{$row->modelo}}
				</div>

				<div class="form-group col-md-6">
					<label class="txt">Conductor:</label> {{$row->nombre_con}} {{$row->paterno_con}} {{$row->materno_con}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Cliente:</label> {{$row->nit}} - {{$row->razon_social}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Ruta:</label> {{$row->nombre_ruta}}, km:{{$row->distancia_km}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Fecha:</label> {{$row->fecha_flete}}
				</div>
				
				<div class="form-group col-md-4">
					<label class="txt">Estado:</label> {{$row->estado_flete}}
				</div>
				<div class="form-group col-md-12">
					<label class="txt">Descripción:</label> {{$row->descripcion_flete}}
				</div>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../flete'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


