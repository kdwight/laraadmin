<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="#">
            <img src="{{ asset('img/logo.png')}}" class="navbar-brand-img" alt="...">
        </a>

        @include('admin.partials.mobnav')

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="{{ asset('img/favicon.png')}}" alt="...">
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
                    <a class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}" href="{{ url("admin/dashboard") }}">
                        <i class="{{ (request()->is('admin/dashboard*')) ? 'fas fa-circle' : 'far fa-circle' }}"></i>
                        Dashboard
                    </a>
                </li>
                @for ($i = 0; $i < count($sidenav); $i++)
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/'.$sidenav[$i] . '*')) ? 'active' : '' }}" href="{{ url("admin/" . $sidenav[$i]) }}">
                            <i class="{{ (request()->is('admin/'.$sidenav[$i] . '*')) ? 'fas fa-circle' : 'far fa-circle' }}"></i>
                            {{ ucwords(str_replace('_', ' ', $sidenav[$i])) }}
                        </a>
                    </li>
                @endfor
            </ul>

            <hr class="my-3">

            <div>
                <!-- Heading -->
                <h6 class="navbar-heading text-muted">Account</h6>

                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/users/'. auth()->id() .'/change-password') }}">
                            <i class="ni ni-lock-circle-open text-info"></i> Change Password
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin-logout') }}">
                            <i class="ni ni-user-run text-danger"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>