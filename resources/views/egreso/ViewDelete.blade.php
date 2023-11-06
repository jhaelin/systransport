<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro de Egreso?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletEgreso')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST"> 
        <input type="hidden" name="id" value="<?= $row->id_egreso?>"> 
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-12 txt">
				<div class="form-group col-md-4">
					<label class="txt">Nro. Factura:</label> {{$row->nro_factura}}
				</div>

				<div class="form-group col-md-4"></div>

				<div class="form-group col-md-4">
					<label class="txt">Fecha:</label> {{$row->fecha_e}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Concepto Pagp:</label> {{$row->concepto_pago}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Cantidad:</label> {{$row->cantidad}}
				</div> 

				<div class="form-group col-md-4">
					<label class="txt">Costo Unitario:</label> {{$row->costo_unidad}}
				</div>				
				<div class="form-group col-md-4">
					<label class="txt">Costo Total:</label> {{$row->costo_total}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Observaciones:</label> {{$row->observacion}}
				</div>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../egreso'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


