<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="shortcut icon" type="image/x-icon" href="#">
	<title>Sistema de Transporte</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="{{asset('adminlte/bootstrap/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/square/blue.css')}}"> 
	<link rel="stylesheet" href="{{asset('adminlte/dist/css/color_tables.css')}}">

</head>
<body class="hold-transition login-page" id="cuerpo" style="background: url(img/fon.jpg) no-repeat;">
<!-- style="background-color:#195b7f;"> -->
	<div class="login-box">
		<div class="login-logo">
			<a style="color:#efefef">S.C.F.A.</a>
			<br><p style="font-size:18px;color:#efefef">SISTEMA WEB DE CONTROL DE FONDOS DE AVANCE <br>"VILMA HUAYLLAS TRANSPORTES"</p>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body" style="background-color:#195b7f; border: 1px solid #9b9bff; opacity:0.8;border-radius: 6px; box-shadow:inset 2px 2px 4px rgba(120, 120, 120, .4), inset -3px -3px 3px rgba(255,255,255,.4);text-shadow: 1px 1px rgba(0,0,0,.3);">
    <div class="thumbnail">
        <img src="img/logo_.png" class="img-circle" alt="Lights" style="width:30%">
        <!-- <img src="img/logo_.png" class="img-circle" alt="Cinque Terre">  195b7f-->
    </div>
		

			<p class="login-box-msg" style="color:#efefef;font-size:15px;">Inicia sesión para acceder</p>


			<form action="{{ route('login') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group form-group{{$errors->has('codigo_usuario') ? ' has-error' : '' }} has-feedback">
					<input id="email" type="text" class="form-control" placeholder="Usuario" name="codigo_usuario" value="{{ old('codigo_usuario') }}" required autofocus>
					<span class="bg-black glyphicon glyphicon-user form-control-feedback"></span>
					@if ($errors->has('codigo_usuario'))
					<span class="help-block">{{ $errors->first('codigo_usuario') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
					<input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
					<span class="bg-black glyphicon glyphicon-lock form-control-feedback"></span>										
					@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="row">

					<div class="col-xs-12">
						<button type="submit" style="background-color:#000000;opacity:1;color:white;" class="btn  btn-block btn-flat">Iniciar Sesión</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
    @section('scripts')
    @yield('scripts')
    @include('adminlte.scripts')
    @show

			</div>
			<!-- /.login-box -->

			<!-- jQuery 2.2.3 -->
			<script src="{{asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
			<!-- Bootstrap 3.3.6 -->
			<script src="{{asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
			<!-- iCheck -->
			<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
			<script>
				$(function () {
					$('input').iCheck({
						checkboxClass: 'icheckbox_square-blue',
						radioClass: 'iradio_square-blue',
                        increaseArea: '20%' // optional
                    });
				});
			</script>

