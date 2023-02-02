    <!-- Dashboard -->
    @if(session()->get('Role') != "Faculty")
        <li class="side-menus {{ request()->is('dashboard') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class=" fas fa-chart-line" style="color: #606060;"></i> <span style="color:#606060">Dashboard</span>
            </a>
        </li>
    @endif

    <!-- {{ $role = session()->get('Role') }} -->

    <!-- Approval -->
    @if(session()->get('Role') == "Director")
        <li class="side-menus {{ request()->is('approval') ? 'active-nav' : '' }}" >
            <a class="nav-link" href="{{ route( 'approval.index' ) }}">
                <i class="fas fa-check" style="color: #606060;"></i> <span style="color: #606060">Approval</span>
            </a>
        </li>
    @endif

    <!-- User Management -->
    @if(session()->get('Role') == "Admin")
        <li class="side-menus {{ request()->is('usermanage') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('usermanage.index') }}">
                <i class=" fas fa-users" style="color: #606060;"></i> <span style="color:#606060">User Management</span>
            </a>
        </li>
    @endif

    <!-- Curriculum -->
    @if(session()->get('Role') == "Academic Head" || session()->get('Role') == "Admin")
        {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                    style="color: #606060;"></i> <span style="color:#606060">Curriculum Management</span></a>
            <ul class="dropdown-menu" style="{{ request()->is('course/index') || request()->is('curriculum/index') ? 'active-nav' : '' }}">
                <li><a class="nav-link pl-5 {{ request()->is('course/index') ? 'active-nav' : '' }}" href="{{ route('course.index') }}" style="color: #606060; font-weight:600;"><i
                            class=" fas fa-building icon" style="color: #606060;"></i>Course List</a></li>
                <li><a class="nav-link pl-5 {{ request()->is('curriculum/index') ? 'active-nav' : '' }}" href="{{ route('curriculum.index') }}" style="color: #606060; font-weight:600;"><i
                            class=" fas fa-building icon" style="color: #606060;"></i>Curriculum List</a></li>
            </ul>
        </li> --}}
        <li class="side-menus {{ request()->is('course/index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('course.index') }}">
                <i class=" fas fa-graduation-cap" style="color: #606060;"></i> <span style="color:#606060">Program List</span>
            </a>
        </li>
    @endif

    <!-- Faculty -->
    @if(session()->get('Role') != "Director")  
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                    style="color: #606060;"></i> <span style="color:#606060">Faculty Management</span></a>
            <ul class="dropdown-menu" style="{{ request()->is('faculty/index') || request()->is('faculty/load') ? 'active-nav' : '' }}">
                @if(session()->get('Role') != "Faculty")
                    <li><a class="nav-link pl-5 {{ request()->is('faculty/index') ? 'active-nav' : '' }}" href="{{ route('faculty.index') }}" style="color: #606060; font-weight:600;"><i
                                class=" fas fa-chalkboard-teacher" style="color: #606060;"></i>Faculty</a></li>
                    @if(session()->get('Role') != "Academic Head")
                        <li><a class="nav-link pl-5 {{ request()->is('faculty/load') ? 'active-nav' : '' }}" href="{{ route('faculty.load') }}" style="color: #606060; font-weight:600;"><i
                                    class=" fas fa-clipboard-list" style="color: #606060;"></i>Faculty Loading</a></li>
                    @endif
                @elseif(session()->get('Role') == "Faculty")
                    <li><a class="nav-link pl-5 {{ request()->is('faculty/index') ? 'active-nav' : '' }}" href="{{ route('faculty.viewonly', ['user_id' => session()->get('LoggedUser') ]) }}" style="color: #606060; font-weight:600;"><i
                        class=" fas fa-magnifying-glass" style="color: #606060;"></i>View Info</a></li>
                @endif
            </ul>
        </li>
    @endif

    <!-- View Schedule -->
    @if(session()->get('Role') == "Faculty")
        <li class="side-menus {{ request()->is('reports') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('reports.schedule', ['id' => session()->get('Faculty') ]) }}">
                <i class="fas fa-table" style="color: #606060;"></i> <span style="color:#606060">View Schedule</span>
            </a>
        </li>
    @endif

    <!-- Course loading -->
    @if(session()->get('Role') == "Admin")
        <li class="side-menus {{ request()->is('courseload') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('courseload.index') }}">
                <i class=" fas fa-calendar-alt" style="color: #606060;"></i> <span style="color:#606060">Program Loading</span>
            </a>
        </li>
    @endif

    <!-- Reports -->
    @if(session()->get('Role') == "Admin")
    <li class="side-menus {{ request()->is('reports') ? 'active-nav' : '' }}">
        <a class="nav-link" href="{{ route('reports.index') }}">
            <i class="fas fa-table" style="color: #606060;"></i> <span style="color:#606060">Reports</span>
        </a>
    </li>
    @endif


<style>
    li a {
        font-weight: 600;
        color: white;

    }

    a:hover {
        background-color: whitesmoke !important;
        color: white;
    }

    .active-nav {
        background-color: whitesmoke !important;
        color: white;
    }

</style>
