<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:18px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Cargo?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletRuta')}}"> 
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST">
        <input type="hidden" name="id" value="<?= $row->id_ruta?>">
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-12 txt">
				<div class="form-group col-md-12">
					<label class="txt">Nombre Ruta:</label> {{$row->nombre_ruta}}
				</div>
				
				<div class="form-group col-md-12">
					<label class="txt">Distancia Km:</label> {{$row->distancia_km}}
				</div>
				
				<div class="form-group col-md-12">
					<label class="txt">Descripción Ruta:</label> {{$row->descripcion_ruta}}
				</div>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{asset('/ruta')}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>





