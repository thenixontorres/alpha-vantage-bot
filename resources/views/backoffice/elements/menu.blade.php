<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="box-container">
            <div class="collapse navbar-collapse" id="navbarListResponsive">
                <!--header nav links-->
                @if(!Auth::guest())
                <ul class="navbar-nav header-links">
                    <li class="nav-item active">
                        <a class="nav-link mr-lg-3" href="index.html">

                        </a>
                    </li>
                  
                    <li class="nav-item">
                    
                        <a class="nav-link mr-lg-3" id="" href="{{ route('backoffice.index') }}">Inicio</a>
                    
                    </li>
                    
                 
                             
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