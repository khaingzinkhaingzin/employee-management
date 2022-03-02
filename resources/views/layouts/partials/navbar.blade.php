<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('assets/img/user.png')}}" alt="user-image" class="rounded-circle">
                <span class="d-none d-sm-inline-block ml-1">@if(Auth::check()){{ Auth::user()->name }} @endif</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
               

                <!-- item-->

                <a href="#" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                
               

            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box" style="box-shadow: 0 0 1px #fff;">
        <a href="{{ route('admin.company.index') }}" class="logo text-center">
            <span class="logo-lg" style="padding: 3px 0;">
                <img src="{{ asset('assets/img/logo.png')}}" alt="" width="100">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
        
               

        <li class="d-none d-lg-block">
            <a href="{{ route('admin.company.index') }}" class="nav-link">EMPLOYEE MANAGEMENT</a>
        </li>       

    </ul>
</div>