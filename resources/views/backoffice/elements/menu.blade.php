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
                            
                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index') }}"> <i class="fa fa-line-chart"></i> Todos</a>
                            
                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index', ['stock_market']) }}"> <i class="fa fa-building"></i> Acciones</a>

                            <a class="dropdown-item" href="{{ route('backoffice.scanners.index', ['physical']) }}"> <i class="fa fa-money"></i> Forex</a>

                            <a class="dropdown-item" href="#"> <i class="fa fa-bitcoin"></i> Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mis alertas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['all']) }}"> <i class="fa fa-warning"></i> Todas</a>

                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['stock_market']) }}">  <i class="fa fa-building"></i> Acciones</a>
                            <a class="dropdown-item" href="{{ route('backoffice.signals.index', ['physical']) }}"> <i class="fa fa-money"></i> Forex</a>
                            <a class="dropdown-item" href="#"> <i class="fa fa-bitcoin"></i> Criptos</a>
                        </div>
                    </li>

                    @if(Auth::user()->type == 'admin')
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Escaners
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.scanners.index') }}"> <i class="fa fa-line-chart"></i> Todos</a>
                            
                            <a class="dropdown-item" href="{{ route('admin.scanners.index', ['stock_market']) }}"> <i class="fa fa-building"></i> Acciones</a>

                            <a class="dropdown-item" href="{{ route('admin.scanners.index', ['physical']) }}"> <i class="fa fa-money"></i> Forex</a>

                            <a class="dropdown-item" href="#"> <i class="fa fa-bitcoin"></i> Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Alertas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.signals.index', 'all') }}"><i class="fa fa-warning"></i> Todas</a>

                            <a class="dropdown-item" href="{{ route('admin.signals.index', ['stock_market']) }}"><i class="fa fa-building"></i>  Acciones</a>
                            <a class="dropdown-item" href="{{ route('admin.signals.index', ['physical']) }}"><i class="fa fa-money"></i> Forex</a>

                            <a class="dropdown-item" href="#"> <i class="fa fa-bitcoin"></i> Criptos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="dashNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Activos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashNav">
                            
                            <a class="dropdown-item" href="{{ route('admin.assets.index') }}"> <i class="fa fa-area-chart"></i>  Todos</a>

                            <a class="dropdown-item" href="{{ route('admin.assets.index', ['stock_market']) }}"><i class="fa fa-building"></i> Acciones</a>
                            <a class="dropdown-item" href="{{ route('admin.assets.index', ['physical']) }}"><i class="fa fa-money"></i>  Forex</a>
                            <a class="dropdown-item" href="#"> <i class="fa fa-bitcoin"></i> Criptos</a>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('admin.users.index') }}">Usuarios</a>
                    
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