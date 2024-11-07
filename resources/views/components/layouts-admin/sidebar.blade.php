<aside class="sidebar">
    <!-- sidebar close btn -->
    <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
    <!-- sidebar close btn -->

    <a href="index.html" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="assets/admin/images/logo/logo_app.svg" alt="Logo">
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Dashboard</span>
                        {{-- <span class="link-badge">3</span> --}}
                    </a>
                </li>
                <li class="sidebar-menu__item has-dropdown">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        {{-- <span class="icon"><i class="ph ph-graduation-cap"></i></span> --}}
                        <span class="icon"><i class="ph ph-clipboard-text"></i></span>
                        <span class="text">Indeks Kinerja Utama (IKU)</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">
                        <li class="sidebar-submenu__item">
                            <a href="student-courses.html" class="sidebar-submenu__link"> IKU I </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="mentor-courses.html" class="sidebar-submenu__link"> IKU II </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="create-course.html" class="sidebar-submenu__link"> IKU III </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="student-courses.html" class="sidebar-submenu__link"> IKU IV </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="mentor-courses.html" class="sidebar-submenu__link"> IKU V </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="create-course.html" class="sidebar-submenu__link"> IKU VI </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="student-courses.html" class="sidebar-submenu__link"> IKU VII </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="mentor-courses.html" class="sidebar-submenu__link"> IKU VIII </a>
                        </li>
                    </ul>
                    <!-- Submenu End -->
                </li>
                <li class="sidebar-menu__item has-dropdown">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        {{-- <span class="icon"><i class="ph ph-graduation-cap"></i></span> --}}
                        <span class="icon"><i class="ph ph-clipboard-text"></i></span>
                        <span class="text">Administrator</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('parent_menu') }}" class="sidebar-submenu__link"> Parent Menu </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('menu') }}" class="sidebar-submenu__link"> Menu </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('role') }}" class="sidebar-submenu__link"> Roles </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('access_role') }}" class="sidebar-submenu__link"> Access role </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </div>

    </div>

</aside>
