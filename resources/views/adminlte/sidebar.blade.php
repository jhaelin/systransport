  <!-- Copyright © 2022 mcall -->
  <!-- Left side column. contains the logo and sidebar --> 
  <aside class="main-sidebar">  

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="pull-left image">
          <img src="{{ asset('/img/logo_empresa.jpg')}}" class="img-thumbnail" alt="Vilma huayllas" width="210" height="10">
        </div>
      </form>
      <!-- /.search form -->

  <!-- Sidebar Menu -->


    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header"><center>MENU PRINCIPAL</center></li>
                  <li class="treeview">
              <a href="{{asset('home')}}"><i class="fa fa-fw fa-home"></i><span>Inicio</span>
              </a>
            </li> 
@if (Auth::user()->id_rol == 1) 
            <!-- PERSONAL -->
            <li class="treeview">
              <a href="{{asset('persona')}}"><i class="fa fa-fw fa-group"></i><span>Personal</span>
              </a>
            </li>  
@endif
@if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2) 
            
            <!-- FLETES -->
            <li class="treeview">
              <a href="{{asset('flete')}}"><i class="fa fa-fw fa-laptop"></i><span> Administrar Flete de <br>Camiones</span></a>
            </li> 

            <!-- TRANSACCIONES -->
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-exchange"></i><span>Transacciones</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{asset('ingreso')}}"><i class="fa fa-fw fa-plus-square"></i><span> Ingresos</span></a></li>
                <li><a href="{{asset('egreso')}}"><i class="fa fa-fw fa-minus-square"></i><span> Egresos</span></a></li>
              </ul>
            </li> 

            <!-- CONDUCTORES -->
            <li class="treeview">
              <a href="{{asset('conductor')}}"><i class="fa fa-fw fa-user-secret"></i><span> Conductores</span></a>
            </li>  

            <!-- CLIENTES -->
            <li class="treeview">
              <a href="{{asset('cliente')}}"><i class="fa fa-fw fa-institution"></i><span> Clientes</span></a>
            </li>  
 
            <!-- CAMIONES -->
            <li class="treeview">
              <a href="{{asset('camion')}}"><i class="fa fa-fw fa-truck"></i><span> Camiones</span></a>
            </li>  

            <!-- RUTAS -->
            <li class="treeview">
              <a href="{{asset('ruta')}}"><i class="fa fa-fw fa-map-marker"></i><span> Rutas</span></a>
            </li>  
  
            <!-- FONDOS DE AVANCE -->
            <li class="treeview">
              <a href="{{asset('home')}}"><i class="fa fa-fw fa-wrench"></i><span> Control de <br>fondos de avance</span></a>
            </li> 

            


            <!-- REPORTES -->
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-file-pdf-o"></i><span>Reportes</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a> 
              <ul class="treeview-menu">
                @if (Auth::user()->id_rol == 1) 
                <li><a href="{{asset('repUsuario')}}" ><i class="fa fa-fw fa-file-text"></i><span>Reporte de Usuarios</span></a></li>
                @endif
                <li><a href="{{asset('repCamion')}}"><i class="fa fa-fw fa-file-text"></i><span>Reportes de Camiones</span></a></li>
                <li><a href="{{asset('repCliente')}}" ><i class="fa fa-fw fa-file-text"></i><span>Reporte de Clientes</span></a></li>
                <li><a href="{{asset('repConductor')}}" ><i class="fa fa-fw fa-file-text"></i><span>Reporte de<br>Conductores</span></a></li>
                <li><a href="{{asset('repFlete')}}" ><i class="fa fa-fw fa-file-text"></i><span>Reporte de Flete<br>de Camiones</span></a></li>
                <li class="treeview menu-open">
                    <a href="#"><i class="fa fa-fw fa-file-text"></i>Reporte Fondos <br>de Avance
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                      <li><a href="{{asset('home')}}" ><i class="fa fa-fw fa-file-text"></i>Historia Fondos de Avance<br></a></li>
                      
                    </ul>
                </li>             
                <li><a href="{{asset('repIngreso')}}" ><i class="fa fa-fw fa-file-text"></i><span> Reporte de Ingresos<br>Económicos</span></a></li>
                <li><a href="{{asset('repEgreso')}}" ><i class="fa fa-fw fa-file-text"></i><span> Reporte de Egresos<br>Económicos</span></a></li>
                <li><a href="{{asset('repImpuesto')}}" ><i class="fa fa-fw fa-file-text"></i><span> Reporte de Cálculo<br> de Impuestos</span></a></li>
              </ul>
            </li>
@endif


@if (Auth::user()->id_rol == 1) 
      <!-- CONFIGURACIÓN -->
      <li class="treeview">
        <a href="{{asset('usuario')}}"><i class="fa fa-fw fa-cog"></i><span>Configuración de Usuarios</span></a>
      </li>
    </ul><!-- /.sidebar-menu -->
@endif
      <!-- /.sidebar-menu -->
  </section>
    <!-- /.sidebar -->
</aside>
