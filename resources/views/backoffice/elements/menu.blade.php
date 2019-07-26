<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="box-container">
            <div class="collapse navbar-collapse" id="navbarListResponsive">
                <!--header nav links-->                
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
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Escaners
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.scanners.index') }}">Todos</a>
                            
                            <a class="dropdown-item" href="{{ route('admin.scanners.index', ['stock_market']) }}">Acciones</a>

                            <a class="dropdown-item" href="{{ route('admin.scanners.index', ['physical']) }}">Forex</a>

                            <a class="dropdown-item" href="{{ route('admin.scanners.index', ['digital']) }}">Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Alertas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.signals.index') }}">Todas</a>

                            <a class="dropdown-item" href="{{ route('admin.signals.index', ['stock_market']) }}">Acciones</a>
                            <a class="dropdown-item" href="{{ route('admin.signals.index', ['physical']) }}">Forex</a>
                            <a class="dropdown-item" href="{{ route('admin.signals.index', ['digital']) }}">Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Activos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.assets.index') }}">Todos</a>

                            <a class="dropdown-item" href="{{ route('admin.assets.index', ['stock_market']) }}">Acciones</a>
                            <a class="dropdown-item" href="{{ route('admin.assets.index', ['physical']) }}">Forex</a>
                            <a class="dropdown-item" href="{{ route('admin.assets.index', ['digital']) }}">Criptos</a>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('backoffice.index') }}">Usuarios</a>
                    
                    </li>

                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('admin.strategies.index') }}">Estrategias</a>
                    
                    </li>

                    @endif

                </ul>
            </div>
        </div>
    </nav>
    <!--/header-->