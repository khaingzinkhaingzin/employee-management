<div class="left-side-menu">
    <div class="slimscroll-menu">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="" class="waves-effect waves-light">
                        {{-- <a href="{{ url('admin.dashboard')}}" class="waves-effect waves-light"> --}}
                        <i class="fa fa-desktop" aria-hidden="true"></i><span>  Dashboard  </span>
                    </a>
                </li>
                <li>
                    <a href="" class="waves-effect waves-light"><i class="fas fa-user"></i> User</a>
                </li>
                <li>
                    <a href="{{ url('admin.roles.index')}}" class="waves-effect waves-light"><i class="fas fa-user-shield nav-icon"></i> Role</a>
                </li>
                <li>
                    <a href="{{ url('admin.permissions.index')}}" class="waves-effect waves-light"><i class="fas fa-shield-alt"></i> Permission</a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect waves-light">
                        <i class="fas fa-cog"></i>
                        <span>  Control Pannel </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="waves-effect waves-light {{ request()->is('admin/company*') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.company.index')}}">Company</a>
                        </li>
                        <li class="waves-effect waves-light {{ request()->is('admin/department*') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.department.index')}}">Department</a>
                        </li>
                        <li class="waves-effect waves-light {{ request()->is('admin/employee*') ? 'mm-active' : ''}}">
                            <a href="{{ route('admin.employee.index')}}">Employee</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>           
</div>
