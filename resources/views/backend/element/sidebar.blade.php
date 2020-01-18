<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu nav-list" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{url('backend/img/profile_small.jpg')}}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('show.profile') }}">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
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

            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li>
                <a href="{{ route('departments.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Departments</span></a>
            </li>
            <li>
                <a href="{{ route('subjects.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Subjects</span></a>
            </li>
            <li>
                <a href="{{ route('questions.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Questions</span></a>
            </li>
            <!-- <li>
                <a href="{{ route('examinations.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Examinations</span></a>
            </li> -->
        </ul>
    </div>
</nav>
