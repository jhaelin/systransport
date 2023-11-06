<div class="modal-header header-danger">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><center style="font-size:12px; color:white;"><i style="font-size:12px; color:white;" class="fa fa-fw fa-exclamation-triangle danger"></i> ¿Esta seguro de Eliminar Registro de Usuario?</center></h4>
</div>
<form id="f11" name="f11" class="" role="form" method="post" action="{{url('/deletU')}}" >
        {{csrf_field()}}
        <input name="_method" type="hidden" value="POST">
        <input type="hidden" name="id" value="<?= $row->id?>"> 
	<div  class="modal-body" >

		<div class="row">

			<div class="col-md-8 txt">
				<div class="form-group col-md-12">
					<label class="txt">Nombres y Apellidos:</label> {{$row->nombre}} {{$row->paterno}} {{$row->materno}}
				</div>

				<div class="form-group col-md-12">
					<label class="txt">C.I.:</label> {{$row->ci}} <label class="txt">Exp.:</label> {{$row->expedido}}
				</div>
				<div class="form-group col-md-12">
					<label class="txt">Dirección Domicilio:</label> {{$row->zona}} C/: {{$row->calle}} N°: {{$row->numero}}
				</div>
				
				<div class="form-group col-md-6">
					<label class="txt">Celular:</label> {{$row->celular}}
				</div>
				<div class="form-group col-md-6">
					<label class="txt">Teléfono:</label> {{$row->telefono}}
				</div>
				<div class="form-group col-md-12">
					<label class="txt">Email:</label> {{$row->email}}
				</div>
			</div>

			<div class="col-md-4"><br>
				<!-- <div class="form-group col-md-12"> -->
					<center><img src="{{url('uploads_files/'.$row->foto_)}}" class="archivo3" style="height:140px; width:120px"></center>
				<!-- </div> -->
			</div>

		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-sm btn-outline pull-left" href="{{'../usuario'}}" role="button" data-dismiss="modal">Cancelar</a>
		<button type="submit" class="btn btn-sm btn-outline">Si, Guardar Cambios</button>
	</div>
</form>


