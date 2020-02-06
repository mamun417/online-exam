<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu nav-list" id="side-menu">
            <li class="nav-header ">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('backend/img/admin.png') }}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ ucfirst(Auth::user()->name)}} {{ ucfirst(Auth::user()->last_name)}}</strong>
                             </span> <span class="text-muted text-xs block">Administrator<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('show.profile') }}">Profile</a></li>
                        <li><a href="{{ route('password.change') }}">Change Password</a></li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="{{ Request::is('question-template*') ? 'active' : '' }}">
                <a href="{{ route('question-templates.index') }}"><i class="fa fa-file-text"></i><span class="nav-label">Question Template</span></a>
            </li>

             <li class="{{ Request::is('questions*') ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}"><i style="font-size: 20px" class="fa fa-question"></i> <span class="nav-label">Questions</span></a>
            </li>

            <li class="{{ Request::is('departments*') ? 'active' : '' }}">
                <a href="{{ route('departments.index') }}"><i style="font-size: 14px" class="fa fa-users"></i><span class="nav-label">Departments</span></a>
            </li>

            <li class="{{ Request::is('subjects*') ? 'active' : '' }}">
                <a href="{{ route('subjects.index') }}"><i style="font-size: 14px" class="fa fa-book"></i><span class="nav-label">Subjects</span></a>
            </li>

            <li>
                <a href="#"><i style="font-size: 18px" class="fa fa-home" aria-hidden="true"></i><span class="nav-label">Home</span></a>
            </li>

            <li>
                <a href="#"><i style="font-size: 18px" class="fa fa-graduation-cap"></i><span class="nav-label">Study</span></a>
            </li>

            <li>
                <a href="#"><i style="font-size: 18px" class="fa fa-pinterest"></i> <span class="nav-label">Practice</span></a>
            </li>

            <li>
                <a href="#"><i style="font-size: 18px" class="fa fa-thermometer-empty" aria-hidden="true"></i><span class="nav-label">Exam</span></a>
            </li>

        </ul>
    </div>
</nav>
