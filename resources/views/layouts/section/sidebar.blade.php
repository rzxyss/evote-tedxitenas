<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets') }}/images/logo-black.png"
                            alt="Logo" style="height: 40px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item @if (request()->routeIs('dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item @if (request()->routeIs('master-data.*')) active @endif has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu @if (request()->routeIs('master-data.*')) active @endif">
                        <li class="submenu-item @if (request()->routeIs('master-data.permissions.*')) active @endif">
                            <a href="{{ route('master-data.permissions.index') }}">Permissions</a>
                        </li>
                        <li class="submenu-item @if (request()->routeIs('master-data.roles.*')) active @endif">
                            <a href="{{ route('master-data.roles.index') }}">Roles</a>
                        </li>
                        <li class="submenu-item @if (request()->routeIs('master-data.account.*')) active @endif">
                            <a href="{{ route('master-data.account.index') }}">Account</a>
                        </li>
                        <li class="submenu-item @if (request()->routeIs('master-data.candidates.*')) active @endif">
                            <a href="{{ route('master-data.candidates.index') }}">Candidates</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
