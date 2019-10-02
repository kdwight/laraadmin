<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('img') }}/logo.png" class="navbar-brand-img" alt="...">
        </a>

        <!-- Mobile Nav -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <span class="avatar avatar-sm rounded-circle fa fa-user"></span>
                        </span>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Mobile Nav -->

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('img') }}/logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>

                {{-- @for ($i = 0; $i < count($sidebar); $i++)
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/'.$sidebar[$i] . '*')) ? 'active' : '' }}" href="{{ url("admin/" . $sidebar[$i]) }}">
                        <i class="{{ (request()->is('admin/'.$sidebar[$i] . '*')) ? 'fas fa-circle' : 'far fa-circle' }}"></i>
                        {{ ucwords(str_replace('_', ' ', $sidebar[$i])) }}
                    </a>
                </li>
                @endfor --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/users') }}">
                        <i class="fas fa-users-cog text-primary"></i> Users Management
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-3">

            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Account</h6>

            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="ni ni-single-02 text-default"></i> Profile
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/activities') }}">
                        <i class="ni ni-calendar-grid-58 text-info"></i> Acivity
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run text-danger"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>