<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.slider.index') }}">
                <i class="ti-layout-slider menu-icon"></i>
                <span class="menu-title">Slaydlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="ti-list menu-icon"></i>
                <span class="menu-title">Kateqoriyalar</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.about.index') }}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Haqqımızda</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.contact.index') }}">
                <i class="ti-bookmark-alt menu-icon"></i>
                <span class="menu-title">Kontaktlar</span>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">--}}
{{--                <i class="icon-layout menu-icon"></i>--}}
{{--                <span class="menu-title">Slaydlar</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="ui-basic">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider.index') }}">Slaydlar</a></li>--}}
{{--                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider.create') }}">Yeni Slayd Yarat</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
    </ul>
</nav>
