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

        @for ($i = 0; $i < count($sidebar); $i++)
            <li class="nav-item {{ (request()->is($sidebar[$i] . '*')) ? 'active' : '' }}">
                <a class="nav-link" href="/{{ $sidebar[$i] }}">
                    <i class="menu-icon fa  {{ (request()->is($sidebar[$i] . '*')) ? 'fa-circle' : 'fa-circle-o' }}"></i>
                    <span class="menu-title">{{ ucwords(str_replace('_', ' ', $sidebar[$i])) }}</span>
                </a>
            </li>
        @endfor
    </ul>
</nav>