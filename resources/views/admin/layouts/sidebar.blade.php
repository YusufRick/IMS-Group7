<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('admin/dashboard') }}">
                    <img src="{{ Storage::url($app_logo) }}" alt="App Logo" width="50">
                    <h2 class="brand-text mb-0">{{ $app_title }}</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Dashboard -->
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            @can('view branches')
            <li class="nav-item {{ Request::is('admin/branches*') ? 'active' : '' }}">
                <a href="{{ route('branches.index') }}">
                    <i class="fa fa-building"></i>
                    <span class="menu-title" data-i18n="Branch Management">Branch Management</span>
                </a>
            </li>
            @endcan
            <!-- User Management -->
            @can('view users')
                <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-user"></i>
                        <span class="menu-title" data-i18n="User Management">User Management</span>
                    </a>
                </li>
            @endcan

            <!-- Role Management -->
            @can('view roles')
                <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}">
                        <i class="fa fa-lock"></i>
                        <span class="menu-title" data-i18n="Role Management">Role Management</span>
                    </a>
                </li>
            @endcan
         <!-- Products Management -->
        
                <!-- Products Management -->
            <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-bandcamp"></i>
                    <span class="menu-title" data-i18n="Product Management">Products</span>
                </a>
            </li>
       <!-- Inventory Management -->
            @can('view inventory')
                <li class="nav-item {{ Request::is('admin/inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory.index') }}">
                        <i class="fa fa-superpowers"></i>
                        <span class="menu-title" data-i18n="Inventory Management">Inventory Management</span>
                    </a>
                </li>
            @endcan
            <!-- Permission Management -->
            {{-- @can('view permissions')
                <li class="nav-item {{ Request::is('admin/permissions*') ? 'active' : '' }}">
                    <a href="{{ route('permissions.index') }}">
                        <i class="fa fa-key"></i>
                        <span class="menu-title" data-i18n="Permission Management">Permission Management</span>
                    </a>
                </li>
            @endcan --}}

            {{-- <!-- Inventory Management -->
            @can('view inventory')
                <li class="nav-item {{ Request::is('admin/inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory.index') }}">
                        <i class="fa fa-boxes"></i>
                        <span class="menu-title" data-i18n="Inventory Management">Inventory Management</span>
                    </a>
                </li>
            @endcan

            <!-- Sales Management -->
            @can('view sales')
                <li class="nav-item {{ Request::is('admin/sales*') ? 'active' : '' }}">
                    <a href="{{ route('sales.index') }}">
                        <i class="fa fa-chart-line"></i>
                        <span class="menu-title" data-i18n="Sales Management">Sales Management</span>
                    </a>
                </li>
            @endcan --}}

            <!-- Additional Permissions -->
            @can('view sales')
    <li class="nav-item {{ Request::is('admin/sales*') ? 'active' : '' }}">
        <a href="{{ route('sales.index') }}">
            <i class="fa fa-chart-line">£</i>
            <span class="menu-title" data-i18n="Sales Management">Sales Management</span>
        </a>
    </li>
@endcan
@if(auth()->check() && !auth()->user()->branch_id)
    <li class="nav-item {{ Request::is('admin/user_request*') ? 'active' : '' }}">
        <a href="{{ url('admin/user_request') }}">
            <i class="fa fa-paper-plane"></i>
            <span class="menu-title" data-i18n="User Requests">User Requests</span>
        </a>
    </li>
@endif
@if(auth()->check() && auth()->user()->branch_id)
    <li class="nav-item {{ Request::is('admin/api-documentation*') ? 'active' : '' }}">
        <a href="{{ url('admin/api-documentation') }}">
            <i class="fa fa-paper-plane"></i>
            <span class="menu-title" data-i18n="User Requests">Api Documentation</span>
        </a>
    </li>
@endif
@can('generate invoice')
<li class="nav-item {{ Request::is('/sales-report') ? 'active' : '' }}">
    <a href="{{ route('sales.report') }}">
        <i class="fa fa-report"></i>
        <span class="menu-title" data-i18n="Setting">Sales Report</span>
    </a>
</li>
@endcan
            @can('manage settings')
                <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting') }}">
                        <i class="fa fa-cog"></i>
                        <span class="menu-title" data-i18n="Setting">Settings</span>
                    </a>
                </li>
            @endcan
{{-- 
            @can('view reports')
                <li class="nav-item {{ Request::is('admin/reports') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports') }}">
                        <i class="fa fa-file-alt"></i>
                        <span class="menu-title" data-i18n="Reports">Reports</span>
                    </a>
                </li>
            @endcan

            @can('manage notifications')
                <li class="nav-item {{ Request::is('admin/notifications') ? 'active' : '' }}">
                    <a href="{{ route('admin.notifications') }}">
                        <i class="fa fa-bell"></i>
                        <span class="menu-title" data-i18n="Notifications">Notifications</span>
                    </a>
                </li>
            @endcan

            @can('manage system logs')
                <li class="nav-item {{ Request::is('admin/system-logs') ? 'active' : '' }}">
                    <a href="{{ route('admin.system_logs') }}">
                        <i class="fa fa-database"></i>
                        <span class="menu-title" data-i18n="System Logs">System Logs</span>
                    </a>
                </li>
            @endcan --}}
        </ul>
    </div>
</div>
