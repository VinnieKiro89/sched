@can('dashboard permission')
    <li class="side-menus {{ request()->is('dashboard/index') ? 'active-nav' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class=" fas fa-building icon" style="color: #033571;"></i> <span>Dashboard</span>
        </a>
    </li>
@endcan


@can('user management permission')
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                style="color: #033571;"></i> <span>User Management</span></a>
        <ul class="dropdown-menu" style="{{ request()->is('users/index') || request()->is('roles/index') || request()->is('departments/index') ? 'display:block' : 'display:none' }}">
            <li><a class="nav-link pl-5 {{ request()->is('users/index') ? 'active-nav' : '' }}" href="{{ route('users.index') }}" style="color: #033571; font-weight:600;"><i
                        class=" fas fa-building icon" style="color: #033571;"></i>Users</a></li>
            <li><a class="nav-link pl-5 {{ request()->is('roles/index') ? 'active-nav' : '' }}" href="{{ route('roles.index') }}" style="color: #033571; font-weight:600;"><i
                        class=" fas fa-building icon" style="color: #033571;"></i>Roles / Permission</a></li>
            <li><a class="nav-link pl-5 {{ request()->is('departments/index') ? 'active-nav' : '' }}" href="{{ route('departments.index') }}" style="color: #033571; font-weight:600;"><i
                        class=" fas fa-building icon" style="color: #033571;"></i>Departments</a></li>

        </ul>
    </li>
@endcan


@can('patient management permission for doctor')
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"
                style="color: #033571;"></i> <span>Patient Management</span></a>
        <ul class="dropdown-menu" style="display: none;">
            <li><a class="nav-link pl-5" href="{{route('patients.index')}}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Patient List</a></li>
            {{-- <li><a class="nav-link pl-5" href="" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                        style="color: #033571;"></i>Consultation</a></li> --}}
                        <li><a class="nav-link pl-5" href="{{route('doctor_intervention.index')}}" style="color: #033571; font-weight:600;"><i class=" fas fa-building icon"
                            style="color: #033571;"></i>For Intervention</a></li>
                        </ul>
                    </li>
@endcan

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
        color: #033571;

    }

    a:hover {
        background-color: #41b96d !important;
        color: white;
    }

    .active-nav {
        background-color: #41b96d !important;
        color: white;
    }

</style>
