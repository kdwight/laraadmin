<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('staradmin/images/pic-1.png') }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ ucfirst( auth()->user()->username ) }}</p>
                        <div>
                            <small class="designation text-muted">{{ auth()->user()->type }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        @if (in_array("pages", json_decode(auth()->user()->hasAccess()->access)))
        <li class="nav-item {{ (request()->is('pages*')) ? 'active' : '' }}">
            <a class="nav-link" href="/pages">
                <i class="menu-icon fa fa-files-o"></i>
                <span class="menu-title">Pages</span>
            </a>
        </li>
        @endif
        @if ( Auth::user()->type == 'admin' )
        <li class="nav-item {{ (request()->is('users*')) ? 'active' : '' }}">
            <a class="nav-link" href="/users">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        @endif
    </ul>
</nav>