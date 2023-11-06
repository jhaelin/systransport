<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro del Cliente?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletCliente')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST"> 
        <input type="hidden" name="id" value="<?= $row->id_cliente?>"> 
	<div  class="modal-body" >

		<div class="row">


			<div class="col-md-12 txt">
				<div class="form-group col-md-4">
					<label class="txt">NIT:</label> {{$row->nit}}
				</div>
				<div class="form-group col-md-4">
					<label class="txt">Nro. Autorización:</label> {{$row->nro_autorizacion}}
				</div>
				<div class="form-group col-md-4">
					<label class="txt">Razón Social:</label> {{$row->razon_social}}
				</div>
			</div>


			<div class="col-md-8 txt">				

				<div class="form-group col-md-6">
					<label class="txt">Celular:</label> {{$row->nombre_representante}}
				</div>

				<div class="form-group col-md-6">
					<label class="txt">C.I.:</label> {{$row->ci_representante}} <label class="txt">Exp.:</label> {{$row->expedido_representante}}
				</div>
				
				<div class="form-group col-md-12">
					<label class="txt">Dirección Ciudad:</label> {{$row->ciudad_cli}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">Dirección:</label> {{$row->zona_cli}} C/: {{$row->calle_cli}} N°: {{$row->numero_cli}}
				</div>

				<div class="form-group col-md-4">
					<label class="txt">Teléfono:</label> {{$row->telefono_cli}}
				</div>				
				<div class="form-group col-md-4">
					<label class="txt">Celular:</label> {{$row->celular_cli}}
				</div>
				<div class="form-group col-md-4">
					<label class="txt">Fax:</label> {{$row->fax_cli}}
				</div>

				<div class="form-group col-md-6">
					<label class="txt">Email:</label> {{$row->email_cli}}
				</div>
				<div class="form-group col-md-6">
					<label class="txt">Web:</label> {{$row->web_cli}}
				</div>
			</div>

			<div class="col-md-4"><br>
					<center><img src="{{url('uploads_files/'.$row->logo_cli)}}" class="archivo3" style="height:140px; width:120px"></center>
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../cliente'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


