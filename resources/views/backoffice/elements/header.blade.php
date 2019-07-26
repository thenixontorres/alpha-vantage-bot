<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="mainNav">
        <div class="box-container">
           <!--brand name for responsive-->
           <a class="navbar-brand navbar-brand-responsive" href="{{ route('backoffice.index') }}">
                    {{-- 
                    <img class="pr-3 float-left" src="{{ asset('img/isotipo.png')}}" srcset="{{ asset('img/isotipo.png')}}" style="height: 25px;"  alt=""/>
                    --}}
                    <div class="float-left" style="margin-top: 4px;">
                        <div>TURTRADING</div>
                       
                    </div>
                </a>
           <!--/brand name for responsive-->

            <!--responsive navigation list toggle-->
            <button class="navbar-toggler navigation-list-toggler" type="button" data-toggle="collapse" data-target="#navbarListResponsive" aria-controls="navbarListResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--/responsive navigation list toggle-->

            <!--responsive nav notification toggle-->
            <button class="navbar-toggler nav-notification-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span> <i class="vl_ellipsis-fill-v f16"></i></span>
            </button>
            <!--/responsive nav notification toggle-->

            <div class="collapse navbar-collapse" id="navbarResponsive">

                <!--brand name-->
                <a class="navbar-brand navbar-hide-responsive" href="{{ route('backoffice.index') }}">
                    {{-- 
                    <img class="pr-3 float-left" src="{{ asset('img/isotipo.png')}}" srcset="{{ asset('img/isotipo.png')}}" style="height: 25px;"  alt=""/>
                    --}}
                    <div class="float-left" style="margin-top: 4px;">
                        <div>TURTRADING</div>
                    </div>
                </a>
                <!--/brand name-->

                <!--header rightside links-->
                @if(!Auth::guest())
                <ul class="navbar-nav header-links ml-auto hide-arrow">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-3" id="userNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-thumb">
                                {{--               
                                <img 
                                    class="rounded-circle @if($auth->isVip)  vip @endif" 
                                    src="{{ asset('storage/images/avatars/'.$auth->profile->avatar)}}" 
                                    alt=""
                                    @if($auth->isVip) 
                                    data-toggle="tooltip" data-placement="top" title="Cuenta VIP" 
                                    @endif
                                />
                                --}}
                                {{ Auth::user()->name }}<i class="icon-options-vertical" style="margin: 7px 0 0 4px; float: right;"> </i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userNav">
                            <a class="dropdown-item" href="{{ route('backoffice.index') }}">Inicio</a>
                            
                            <a class="dropdown-item" href="{{ route('backoffice.users.index') }}">Mi cuenta</a>
                            
                            @if(Auth::user()->type == 'admin')
                                
                                <a class="dropdown-item" href="{{ route('admin.settings.index') }}">Configuraciones</a>

                            @endif

                            <div class="dropdown-divider"></div>
                            
                            
                            <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">Desconectarme</a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                   
                </ul>
                <!--/header rightside links-->
                @endif
            </div>
        </div>
    </nav>