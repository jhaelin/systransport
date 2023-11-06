@extends('adminlte.dashboard')  

@section('content')
    <section class="content-header">
      <h1>
        Página de error 403
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{'../home'}}"><i class="fa fa-fw fa-home"></i> Principal</a></li>
        <li class="active">Error 403</li>
      </ol>
    </section>
    <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-red"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-fw fa-ban text-red"></i> Acceso Denegado! Usted no tiene permisos.</h3>

          <p>
             Mientras tanto , 
             es posible volver al panel <a href="{{'../home'}}"><i class="fa fa-fw fa-home"></i> Principal</a>. 
          </p>
              <div class="box-body">
              <!-- <img class="img-responsive pad" src="../img/error403.png" alt="Photo"> -->
            </div>

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
  </section>
@endsection
