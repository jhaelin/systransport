@extends('adminlte.dashboard')  
@section('content')
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/persona')}}">Personal</a></li>
		<li class="active">Editar Personal</li>
	</ol>
</section> 
<section class="content"> 
@include('errors.mensajeError')    
@include('errors.mensaje')

	<form id="formPerson" class="" role="form" method="post" action="{{action('PersonaController@update',$id)}}" enctype='multipart/form-data'>
		{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-user-plus"></i></strong> Editar Registro de Personal</h3>
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
								<div class="form-group col-md-4 form-line">
									<label class="txt">Nombres:</label>
									<input type="text" id="nombre" name="nombre" value="{{$row->nombre}}" pattern="[^'\x220-9]+" class="form-control" onclick="validarp()" maxlength="60">
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Paterno:</label>
									<input type="text" id="paterno" name="paterno" value="{{$row->paterno}}" pattern="[^'\x220-9]+" class="form-control" maxlength="60">
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Materno:</label>
									<input type="text" id="materno" name="materno" value="{{$row->materno}}" pattern="[^'\x220-9]+" class="form-control" onclick="validarp()" maxlength="60" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Cédula de Identidad (C.I.):</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-newspaper-o"></i></div>
										<input type="text" id="ci" name="ci" value="{{$row->ci}}" class="form-control" maxlength="8" onclick="validarp()" onkeypress="return permite(event, 'num')" maxlength="11" required>
									</div>
								</div>
								<div class="form-group col-md-2">
									<label class="txt">Exp.:</label>
									<select id="exp" name="exp" class="form-control" onclick="validarp()" maxlength="" required>
                                        <option value="{{$row->expedido}}">{{$row->expedido}}</option>
										<option value="LP">LP</option>
										<option value="OR">OR</option>
										<option value="CBBA">CBBA</option>
										<option value="CH">CH</option>
										<option value="PT">PT</option>
										<option value="SC">SC</option>
										<option value="BN">BN</option>
										<option value="TJ">TJ</option>
										<option value="PND">PND</option>
										<option value="PERU">PERU</option>
										<option value="ITA">ITA</option>
										<option value="OTRO">OTRO</option>
									</select>
								</div>
								<div class="form-group col-md-2"></div> 
								<div class="form-group col-md-4">
									<label class="txt">Foto: </label>
                                    <img src="{{url('uploads_files/'.$row->foto)}}" class="archivo3" style="height:50px; width:100px">
                                    <input type="text" name="archivo" class="form-control archivo2" value="{{$row->foto}}" id="archivo" placeholder="foto">
									<input type="file" id="archivo" name="archivo" class="form-control archivo" onclick="validarp()" onkeypress="return permite(event, 'car')" maxlength="200">
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Domicilio:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-home"></i></div>
										<input type="text" id="zona" name="zona" value="{{$row->zona}}" class="form-control" onclick="validarp()" maxlength="100" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Calle:</label>
									<input type="text" id="calle" name="calle" value="{{$row->calle}}" class="form-control" onclick="validarp()" maxlength="100" required>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">N°:</label>
									<input type="text" id="num" name="num" value="{{$row->numero}}" class="form-control" onclick="validarp()" onkeypress="return permite(event, 'num')" maxlength="10" required>
								</div>

								<div class="form-group col-md-4">
									<label class="txt">Teléfono:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
										<input type="text" id="tel" name="tel" value="{{$row->telefono}}" class="form-control" maxlength="7" onkeypress="return permite(event, 'num')">
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Celular:</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
										<input type="text" id="cel" name="cel" value="{{$row->celular}}" class="form-control" maxlength="8" onclick="validarp()" onkeypress="return permite(event, 'num')" required>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Email:</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></div>
										<input type="email" id="email" name="email" value="{{$row->email}}" class="form-control" onclick="validarp()" maxlength="100">
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="txt">Cargo:</label>
									<input type="text" id="nombre" name="cargo" value="{{$row->cargo}}" class="form-control" onclick="validarp()" maxlength="120" required>
								</div>
							</div>

						</div>
					</div>

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/persona')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
 							<button type="submit" id="guardar" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>


@endsection

