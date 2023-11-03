<aside class="main-sidebar sidebar-dark-custom elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('dist/img/pitzal.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">PITZAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('loginfoto/'.Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{Auth::user()->name}} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
            <a href="{{ url('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Panel
                <span class="right badge badge-danger">Inicio</span>
               
              </p>
            </a>
          </li>
          @if(Auth::user()->rol=="administrador")
          
          <li class="nav-item">
            <a href="{{url('usuarios')}}" class="nav-link"> 
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
        @endif
    
          <li class="nav-item">
            <a href="{{ url('habitantes')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Habitantes
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('cuotas')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Cuotas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('quejas')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quejas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('documentos')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Documentos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('bienes')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Bienes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('gastos')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Gastos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('matricula')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Matriculas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('proyectos')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
              Proyectos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('comites.create')}}" class="nav-link"> 
              <i class="nav-icon fas fa-th"></i>
              <p>
                Comités
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>