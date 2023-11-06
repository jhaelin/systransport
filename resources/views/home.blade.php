<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
@section('htmlheader')
@yield('adminlte.htmlheader')
@include('adminlte.htmlheader')
@show
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
   @include('adminlte.header')
   
  <!-- Left side column. contains the logo and sidebar -->
   @include('adminlte.sidebar')

  <!-- Content Wrapper. Contains page content width="100" height="20px"-->
  <div class="content-wrapper">



  <section class="col-xs-12">
      <div class="row ">
        <div class="col-xs-12">
          <h2 class="page-header"><br>
          <?php $fecha=date('d/m/Y');?>
            &nbsp;&nbsp;&nbsp;<i class="fa fa-globe"></i> Bienvenidos al Sistema de Información para el Control de Fondos de Avance  de la Empresa {{$e->nombre_empresa}}<small class="pull-right"><div class="btn btn-flat" style="background:#ffffff;"><strong> <i class="fa fa-calendar"></i></strong>  Fecha: {{$fecha}}</div>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small><br>
            <!-- Main Header imagen 
            <div class="col-lg-12"><br>
                <img class="img-responsive" src="{{ asset('/img/cam4.jpg') }}" width="100%"   alt="">
                <br>
            </div>
             -->
            
          </h2>
        </div>
        <!-- /.col -->
      </div>

  <div class="col-xs-12"></div>
   <div class="col-xs-9"></div>
</section>

 <!-- Barra de la parte inferior  -->
         <a class="btn btn-app" href="{{asset('home')}}">
            <span class="badge bg-red">Ir</span>
            <i class="fa fa-home"></i> Home
          </a>

          <a class="btn btn-app" href="{{asset('cliente')}}">
            <span class="badge bg-red">Ir</span>
            <i class="fa fa-barcode"></i> Clientes
          </a>
          <a class="btn btn-app" href="{{asset('camion')}}">
            <span class="badge bg-yellow">Ir</span> 
            <i class="fa fa-truck"></i> Camiones
          </a>
<!--           <a class="btn btn-app" href="{{asset('conductor')}}">
            <span class="badge bg-success">Ir</span> 
            <i class="fa fa-fw fa-user-secret"></i> Conductores
          </a> -->
          <a class="btn btn-app"  href="{{asset('ruta')}}">
            <span class="badge bg-green">Ir</span>
            <i class="fa fa-fw fa-map-marker"></i> Rutas
          </a>
          <a class="btn btn-app"  href="{{asset('flete')}}">
            <span class="badge bg-teal">Ir</span>
            <i class="fa fa-fw fa-laptop"></i> Flete de Camiones
          </a>
          <a class="btn btn-app"  href="{{asset('home')}}">
            <span class="badge bg-aqua">Ir</span>
            <i class="fa fa-wrench"></i> Fondos de Avance
          </a>
          <a class="btn btn-app"  href="{{asset('ingreso')}}">
            <span class="badge bg-blue">Ir</span>
            <i class="fa fa-fw fa-plus-square"></i> Ingresos 
          </a>
          <a class="btn btn-app"  href="{{asset('egreso')}}">
            <span class="badge bg-navy">Ir</span>
            <i class="fa fa-fw fa-minus-square"></i> Egresos
          </a>
          @if (Auth::user()->id_rol == 1) 
  <!--         <a class="btn btn-app" href="{{asset('persona')}}">
            <span class="badge bg-red">Ir</span>
            <i class="fa fa-user"></i> Personal
          </a> -->
          @endif
<!--           <a class="btn btn-app"  href="{{asset('asigperson')}}">
            <span class="badge bg-purple">Ir</span>
            <i class="fa fa-users"></i> Asignación
          </a> -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
   @include('adminlte.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

        
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
    @section('scripts')
    @yield('scripts')
    @include('adminlte.scripts')
    @show
     
</body>
</html>
