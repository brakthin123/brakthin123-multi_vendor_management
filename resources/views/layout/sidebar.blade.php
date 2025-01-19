<div class="sidebar" data-background-color="dark">
    {{-- Sidebar For Super Admin --}}
    @if (Auth::user()->is_role == 2)
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('superadmin/dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ url('superadmin/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Vendor</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('superadmin/vendor/table') }}">
                                    <span class="sub-item">View Vendor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Add more nav items as needed -->
            </ul>
        </div>
    </div>

    {{-- Sidebar For Vendor --}}
    @elseif(Auth::user()->is_role == 1)
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('vendor/dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ url('vendor/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ url('vendor/category/list') }}">
                        <i class="fas fa-th-large"></i>
                        <p>Category</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>

                <!-- Add more nav items as needed -->
                <li class="nav-item">
                    <a href="{{ route('vendor.product.list') }}">
                        <i class="fab fa-product-hunt"></i>
                        <p>Product</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="">
                        <i class="fas fa-luggage-cart"></i>
                        <p>Order</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home.list', ['name' => Auth::user()->vendor->shop_name]) }}">
                        <i class="fas fa-link"></i>
                        <p>Link Page</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @elseif(Auth::user()->is_role == 0)
    @endif
</div>
