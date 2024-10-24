<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">


        <a href="/dashboard" class="logo logo-dark">
            <span class="logo-lg">
                <img src=" " alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src=" " alt="" height="60">
            </span>
        </a>

        <a href="/dashboard" class="logo logo-light">
            <span class="logo-lg">
                <img src=" " alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src=" " alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/dashboard">
                        <i class="bx bxs-bar-chart-alt-2"></i> <span data-key="t-apps">Dashboards</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('ktp.index') }}">
                        <i class="bx bxs-bar-chart-alt-2"></i> <span data-key="t-apps">KTP</span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('kk.index') }}">
                        <i class="bx bxs-bar-chart-alt-2"></i> <span data-key="t-apps">Kartu Keluarga</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
