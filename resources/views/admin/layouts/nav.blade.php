<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v1</p>
                    </a>
                </li>
               
            </ul>
        </li> --}}

        <li class="nav-item">
            <a href="{{ url('/admin/subjects') }}"
                class="nav-link {{ request()->is('*/subjects*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Subjects</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/class') }}" class="nav-link {{ request()->is('*/class*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Class</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/section') }}" class="nav-link {{ request()->is('*/section*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Section</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('*/users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/routine') }}" class="nav-link {{ request()->is('*/routine*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Routine</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/exam') }}" class="nav-link {{ request()->is('*/exam*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Exam</p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
