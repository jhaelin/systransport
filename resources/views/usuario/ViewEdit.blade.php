@extends('adminlte.dashboard')  
@section('content')
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/usuario')}}">Configuración</a></li>
		<li class="active">Editar Usuarios</li>
	</ol>
</section> 
<section class="content"> 
@include('errors.mensajeError')    
@include('errors.mensaje')

	<form id="formPerson" class="" role="form" method="post" action="{{action('UsuarioController@update',$id)}}" enctype='multipart/form-data'>
		{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-user-plus"></i></strong> Editar Registro de Usuarios</h3>
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
								<div class="form-group col-md-12">
									<label class="txt">Personal:</label>
									<td>{{$row->nombre}} {{$row->paterno}} {{$row->materno}}   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <label class="txt">C.I.:</label> {{$row->ci}} {{$row->expedido}}      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<label class="txt">Cargo:</label> {{$row->cargo}}</td>
								</div>

								<div class="form-group col-md-6">
									<label class="txt">Tipo de Uaurio:</label>
									<select id="tipo" name="tipo" class="form-control" onclick="validarp()" maxlength="" required>
                                        <option value="{{$row->tipo_usuario}}">{{$row->tipo_usuario}}</option>
                                        @if($row->tipo_usuario=='MAESTRO')
                                            <option value="AUXILIAR">AUXILIAR</option>
                                        @elseif($row->tipo_usuario=='AUXILIAR')
                                            <option value="MAESTRO">MAESTRO</option>
                                        @endif
									</select>
								</div>
							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/usuario')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
 							<button type="submit" id="guardar" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>


@endsection

