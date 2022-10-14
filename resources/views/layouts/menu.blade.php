    <!-- Dashboard -->
    <li class="side-menus {{ request()->is('dashboard') ? 'active-nav' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class=" fas fa-building icon" style="color: #606060;"></i> <span style="color:#606060">Dashboard</span>
        </a>
    </li>



    <!-- Curriculum -->
    @if(Auth::user()->role == "Academic Head" || Auth::user()->role == "Admin")
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                    style="color: #606060;"></i> <span style="color:#606060">Curriculum Management</span></a>
            <ul class="dropdown-menu" style="{{ request()->is('course/index') || request()->is('curriculum/index') ? 'active-nav' : '' }}">
                <li><a class="nav-link pl-5 {{ request()->is('course/index') ? 'active-nav' : '' }}" href="{{ route('course.index') }}" style="color: #606060; font-weight:600;"><i
                            class=" fas fa-building icon" style="color: #606060;"></i>Course List</a></li>
                <li><a class="nav-link pl-5 {{ request()->is('curriculum/index') ? 'active-nav' : '' }}" href="{{ route('curriculum.index') }}" style="color: #606060; font-weight:600;"><i
                            class=" fas fa-building icon" style="color: #606060;"></i>curriculum List</a></li>
            </ul>
        </li>
    @endif

    <!-- Faculty -->
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                style="color: #606060;"></i> <span style="color:#606060">Faculty Management</span></a>
        <ul class="dropdown-menu" style="{{ request()->is('faculty/index') || request()->is('faculty/load') ? 'active-nav' : '' }}">
            <li><a class="nav-link pl-5 {{ request()->is('faculty/index') ? 'active-nav' : '' }}" href="{{ route('faculty.index') }}" style="color: #606060; font-weight:600;"><i
                        class=" fas fa-building icon" style="color: #606060;"></i>Faculty</a></li>
            <li><a class="nav-link pl-5 {{ request()->is('faculty/load') ? 'active-nav' : '' }}" href="{{ route('faculty.load') }}" style="color: #606060; font-weight:600;"><i
                        class=" fas fa-building icon" style="color: #606060;"></i>Faculty Loading</a></li>
        </ul>
    </li>

    <!-- Course loading -->
    <li class="side-menus {{ request()->is('courseload') ? 'active-nav' : '' }}">
        <a class="nav-link" href="{{ route('courseload.index') }}">
            <i class=" fas fa-building icon" style="color: #606060;"></i> <span style="color:#606060">Course Loading</span>
        </a>
    </li>


@can('patient management permission for nurse')
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                style="color: #033571;"></i> <span>Patient Management</span></a>
        <ul class="dropdown-menu" style="display: none;">
            <li><a class="nav-link pl-5" href="{{route('patients.index')}}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Patient List</a></li>
        
                        </ul>
                    </li>
@endcan




@can('inventory permission')

<li class="nav-item dropdown">
    <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
            style="color: #033571;"></i> <span>Inventory</span></a>
    <ul class="dropdown-menu" style="">
        <li><a class="nav-link pl-5" href="{{ route('inventory.index') }}" style="color: #033571; font-weight:600;"><i
                    class=" fas fa-building icon" style="color: #033571;"></i>Medicine/Supply</a></li>
        {{-- <li><a class="nav-link pl-5" href="" style="color: #033571; font-weight:600;"><i
                    class=" fas fa-building icon" style="color: #033571;"></i>Delivery</a></li>
        <li><a class="nav-link pl-5" href="" style="color: #033571; font-weight:600;"><i
                    class=" fas fa-building icon" style="color: #033571;"></i>Option</a></li> --}}

    </ul>
</li>
    {{-- <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('inventory.index') }}">
            <i class=" fas fa-building icon" style="color: #033571;"></i> <span>Inventory</span>
        </a>
    </li> --}}
@endcan


@can('reports permission')
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                style="color: #033571;"></i> <span>Reports</span></a>
        <ul class="dropdown-menu" style="display: none;">
            <li><a class="nav-link pl-5" href="{{ route('physician_report.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Physician Report </a></li>
            <li><a class="nav-link pl-5" href="{{ route('nurse_assestment_report.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Nurse Assessment </a></li>
            <li><a class="nav-link pl-5" href="{{ route('daily_medication_report.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571; "></i> <span style="line-height: 16px;">Daily Medication Consumption</span>
                </a></li>
            <li><a class="nav-link pl-5" href="{{ route('top10data.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Top 10 Data</a></li>
            <li><a class="nav-link pl-5" href="{{ route('monthlyreport.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Monthly Report</a></li>
            <li><a class="nav-link pl-5" href="{{ route('delivery_report.index') }}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Delivery Report</a></li>
        </ul>
    </li>
@endcan


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
