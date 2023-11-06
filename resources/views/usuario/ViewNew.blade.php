@extends('adminlte.dashboard')   
@section('content')
<section class="content-header"> 
	<h1><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{asset('/home')}}"><i class="fa fa-dashboard"></i> Principal</a></li>
		<li><a href="{{asset('/usuario')}}">Usuario</a></li>
		<li class="active">Nuevo usuariol</li>
	</ol>
</section> 
<section class="content">
@include('errors.mensajeError')    
@include('errors.mensaje')
	<form id="formPerson" class="" role="form" method="post" action="{{url('usuario')}}" enctype='multipart/form-data'> 
		{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">

				<div class="box box_temp">

					<div class="box-header with-border"><h3 class="box-title"><strong> <i class="fa fa-fw fa-user-plus"></i></strong> Registrar Nuevo Usuario</h3>
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
									<select id="person" name="person" class="form-control select2" onclick="validarp()" maxlength="" required>
                                    <option value=""> Seleccione Personal </option>
                                    @foreach($pers as $p)
                                    <?php $comprobar=0;?>
                                    @foreach ($val as $v)  
                                       @if($v->id_persona==$p->id_persona)
                                           <?php $comprobar=1;?>
                                       @endif
                                    @endforeach

                                    @if($comprobar!=1)
                                       <option value="{{$p->id_persona}}">{{$p->nombre}} {{$p->paterno}} {{$p->materno}}  C.I.: {{$p->ci}} {{$p->expedido}}    Cargo: {{$p->cargo}}</option>
                                    @else
                                    @endif
                                    @endforeach
									</select>
								</div>

								<div class="form-group col-md-6">
									<label class="txt">Tipo de Uaurio:</label>
									<select id="tipo" name="tipo" class="form-control" onclick="validarp()" maxlength="" required>
                                    <option value="">Seleccione tipo de Usuario</option>
                                    <option value="MAESTRO">MAESTRO</option>
                                    <option value="AUXILIAR">AUXILIAR</option>
									</select>
								</div>
							</div>

						</div>
					</div>

					

					<div class="box-footer">
						<div class="pull-right">
							<a class="btn btn-danger btn-sm" href="{{asset('/usuario')}}"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
							<a class="btn btn-default btn-sm" href="{{url('usuario/create')}}"><span class="glyphicon glyphicon-repeat"></span> Limpiar</a>
							<button type="submit" value="guardar"  class="btn btn_temp btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>	                
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>
</section>
@endsection

