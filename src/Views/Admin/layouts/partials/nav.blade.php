<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index-2.html"><img src="{{ asset('assets/admin/img/logo.png') }}" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a class="has-arrow" z href="{{ url('admin/') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/6.svg') }}" alt>
                </div>
                <span>Dashboard</span>
            </a>
            <a class="has-arrow" z href="{{ url('admin/users/' . '/') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/6.svg') }}" alt>
                </div>
                <span>Users Management</span>
            </a>
            <a class="has-arrow" href="{{ url('admin/products/') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/6.svg') }}" alt>
                </div>
                <span>Products Management</span>
            </a>
            <a class="has-arrow" href="{{ url('admin/categories/') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/6.svg') }}" alt>
                </div>
                <span>Cterories Management</span>
            </a>
        </li>

        {{-- <li class>
            <a href="Board.html" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/5.svg') }}" alt>
                </div>
                <span>Board</span>
            </a>
        </li> --}}
        <li class>
            <a href="{{ url('') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('assets/admin/img/menu-icon/5.svg') }}" alt>
                </div>
                <span>Home</span>
            </a>
        </li>

    </ul>
</nav>
