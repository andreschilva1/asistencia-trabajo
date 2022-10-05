<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              
                @if (auth()->user()->unreadNotifications()->count() ) 
                <span class="badge badge-warning navbar-badge">{{(auth()->user()->unreadNotifications()->count())}}
                </span>
                @endif
              
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header"> Notificaciones sin leer</span>
                @foreach (Auth::user()->unreadNotifications()->get() as $notificacion)
                    
                <div class="dropdown-divider"></div>
                <a href="{{route('trabajos_asignados_tecnicos.index')}}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{'nuevo trabajo:    '.$notificacion->data["trabajo_nombre"]}}
                    <span class="ml-3 pull-left text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
                </a>
                
                
                @endforeach

                {{-- <span class="dropdown-header"> Notificaciones leidas</span>
                @forelse (Auth::user()->readNotifications()->get() as $notificacion)
                    
                <div class="dropdown-divider"></div>
                <a href="{{route('trabajos_asignados_tecnicos.index')}}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{$notificacion->data["trabajoAsignado_id"]}}
                    <span class="ml-3 pull-left text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
                </a>
                
                @empty
                <span class="dropdown-header">Sin notificaciones leidas </span>
                
                @endforelse --}}
                <div class="dropdown-divider"></div>
              <a href="{{route('notificaciones.markAsRead')}}" class="dropdown-item dropdown-footer">Marcar todas como leidas</a>

              <div class="dropdown-divider"></div>
              <a href="{{route('notificaciones.index')}}" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
            </div>
        </li>

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
