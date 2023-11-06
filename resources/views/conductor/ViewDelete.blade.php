<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro del Conductor?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletConductor')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST"> 
        <input type="hidden" name="id" value="<?= $row->id_conductor?>"> 
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-12 txt">
				<div class="form-group col-md-6">
					<label class="txt">Nombres y Apellidos:</label> {{$row->nombre_con}} {{$row->paterno_con}} {{$row->materno_con}}
				</div>

				<div class="form-group col-md-6">
					<label class="txt">C.I.:</label> {{$row->ci_con}} <label class="txt">Exp.:</label> {{$row->expedido_con}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Categoría Licencia:</label> {{$row->categoria_licencia}}
				</div> 

				<div class="form-group col-md-12">
					<label class="txt">Dirección:</label> {{$row->direccion_con}}
				</div>
				
				<div class="form-group col-md-6">
					<label class="txt">Celular:</label> {{$row->celular_con}}
				</div>
				<div class="form-group col-md-6">
					<label class="txt">Teléfono:</label> {{$row->telefono_con}}
				</div>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../conductor'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


