    <!-- Copyright © 2022 mcall -->
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{$e->alias}}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{$e->alias}}</b></span> 
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Tasks Menu -->

          <?php $gestion=date('Y');?>
          @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          @else
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{url('uploads_files/'.Auth::user()->foto_)}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> {{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              @if (Auth::user()->id_rol == 1) 
                            <li class="user-header">
                              <img src="{{url('uploads_files/'.Auth::user()->foto_)}}" class="img-circle" alt="User Image">
                              <p>
                                 {{ Auth::user()->name}}<br><small>USUARIO GERENTE
                                <br>{{$e->alias}} - {{$gestion}}</small>
                              </p>
                            </li>
              @elseif (Auth::user()->id_rol == 2) 
                            <li class="user-header">
                              <img src="{{url('uploads_files/'.Auth::user()->foto_)}}" class="img-circle" alt="User Image">
                              <p>
                                 {{ Auth::user()->name}}<br><small>USUARIO ADMINISTRADOR
                                <br>{{$e->alias}} - {{$gestion}}</small>
                              </p>
                            </li>
              @endif
              <!-- Menu Footer--> <?php $id=Auth::user()->id ?>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{action('UsuarioController@show', Crypt::encrypt($id))}}" class="btn btn-default btn-flat">Ver Perfil
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
            </ul>
          </li>
           @endif
          <!-- Control Sidebar Toggle Button -->
          <li>
          </li>
        </ul>
      </div>
    </nav>
  </header>