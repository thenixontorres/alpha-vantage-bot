<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="box-container">
            <div class="collapse navbar-collapse" id="navbarListResponsive">
                <!--header nav links-->
                @if(!Auth::guest())
                
                <ul class="navbar-nav header-links">
                 	<li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('backoffice.index') }}">Inicio</a>
                    
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mis escaners
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index') }}">Todos</a>
                            
                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index', ['stock_market']) }}">Acciones</a>

                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index', ['physical']) }}">Forex</a>

                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index', ['digital']) }}">Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mis alertas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('backoffice.signals.index') }}">Todas</a>

                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['stock_market']) }}">Acciones</a>
                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['physical']) }}">Forex</a>
                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['digital']) }}">Criptos</a>
                        </div>
                    </li>

                    @if(Auth::user()->type == 'admin')
                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('admin.index') }}">Administracion</a>
                    
                    </li>
                    @endif
                </ul>
                @else
                <ul class="navbar-nav header-links">
                    <li class="nav-item active">
                        <a class="nav-link mr-lg-3" href="index.html">

                        </a>
                    </li>
                  
                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('auth.login') }}">Login</a>
                    
                    </li>
             
                </ul>
                @endif
           
            </div>
        </div>
    </nav>
    <!--/header-->