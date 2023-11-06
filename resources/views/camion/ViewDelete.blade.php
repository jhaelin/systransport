<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro de Camiones?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletCamion')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST">
        <input type="hidden" name="id" value="<?= $row->id_camion?>"> 
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-8 txt">
				<div class="form-group col-md-4">
					<label class="txt">Matrícula:</label> {{$row->matricula}}
				</div>
				<div class="form-group col-md-4">
					<label class="txt">Marca:</label> {{$row->marca}}
				</div>
				<div class="form-group col-md-4">
					<label class="txt">Modelo:</label> {{$row->modelo}}
				</div>

				<div class="form-group col-md-6">
					<label class="txt">Tipo de Vehículo:</label> {{$row->tipo_vehiculo}}
				</div>
				<div class="form-group col-md-6">
					<label class="txt">Fecha Registro:</label> {{$row->fecha_registro}}
				</div>
				
				<div class="form-group col-md-6">
					<label class="txt">Descripción:</label> {{$row->descripcion_cam}}
				</div>
			</div>

			<div class="col-md-4">
					<center><img src="{{url('uploads_files/'.$row->foto_cam)}}" class="archivo3" style="height:120px; width:120px"></center>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../camion'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


