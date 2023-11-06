@extends('adminlte.dashboard')  

@section('content')
    <section class="content-header">
      <h1>
        Página de error 404
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{asset('/home')}}"><i class="fa fa-fw fa-home"></i> Principal</a></li>
        <li class="active">Error 404</li>
      </ol>
    </section>
    <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! No hemos podido encontrar la página .</h3>

          <p>
             Mientras tanto , 
             es posible volver al panel <a href="{{asset('/home')}}"><i class="fa fa-fw fa-home"></i> Principal</a>. Disculpe !!! 
          </p>

          <form class="search-form">
            <div class="input-group"style="display:none;">
             o intente utilizar el buscador
              <input type="text" name="search" class="form-control" placeholder="Buscar">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    <div style="padding: 10px 0px; text-align: center;"><div class="text-muted"></div>
    <!-- /.content -->
  </div>
@endsection
