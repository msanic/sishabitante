<nav class="main-header navbar navbar-expand navbar-navy navbar-dark" style="background-color:#455279">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
                <span class="badge badge-danger navbar-badge">X</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border border-primary">
                <span class="dropdown-header"> <strong> {{ Auth::user()->rol }}</strong> </span>
                <span class="dropdown-header"> {{ Auth::user()->name }}</span>
                <div class="dropdown-divider"></div>
                <div class="text-center">
                    <img src="{{ asset('loginfoto/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                        alt="User Image" width="50px" height="50px">
                </div>



                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-footer"><i class="fas fa-power-off"></i> Cerrar
                        Sesión</button>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
