<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu nav-list" id="side-menu">

            <li class="nav-header">
                @auth
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('admin/img/admin.png') }}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ ucfirst(Auth::user()->name) .' '. Auth::user()->last_name }}</strong>
                        </span> <span class="text-muted text-xs block">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'Student'}}<b class="caret"></b></span> </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('profile') }}"><i class="fa fa-user-circle"></i> Profile</a></li>
                        @if(auth()->user()->role_id != 1)
                            <li><a href="{{ route('user.renew') }}"><i class="fa fa-refresh"></i> Renew Subscription</a></li>
                        @endif
                        <li><a href="{{ route('password.change') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
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
                @endauth
            </li>


            @if(Auth::check() && Auth::user()->role_id == 1)

                 <li class="{{ Request::is('home*') ? 'active' : '' }}">
                    <a href="{{ url('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                 </li>

                 <li class="{{ Request::is('notifications*') ? 'active' : '' }}">
                    <a href="{{ route('admin.notifications.index') }}"><i style="font-size: 14px" class="fa fa-bell"></i><span class="nav-label">Notifications</span></a>
                 </li>

                 <li class="{{ Request::is('users*', 'user*') ? 'active' : '' }}">
                    <a href="{{ Route('admin.users.index') }}"><i style="font-size: 14px" class="fa fa-users"></i><span class="nav-label">Students</span></a>
                 </li>

                 <li class="{{ Request::is('question-template*') ? 'active' : '' }}">
                    <a href="{{ route('admin.question-templates.index') }}"><i class="fa fa-file-text"></i><span class="nav-label">Exam</span></a>
                 </li>

                 <li class="{{ Request::is('questions*') ? 'active' : '' }}">
                    <a href="{{ route('admin.questions.index') }}"><i style="font-size: 20px" class="fa fa-question"></i> <span class="nav-label">Questions</span></a>
                 </li>

                 <li class="{{ Request::is('departments*') ? 'active' : '' }}">
                    <a href="{{ route('admin.departments.index') }}"><i style="font-size: 14px" class="fa fa-users"></i><span class="nav-label">Departments</span></a>
                 </li>

                 <li class="{{ Request::is('subjects*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subjects.index') }}"><i style="font-size: 14px" class="fa fa-book"></i><span class="nav-label">Subjects</span></a>
                 </li>

                <li class="{{ Request::is('payments*') ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}"><i style="font-size: 14px" class="fa fa-money"></i><span class="nav-label">Payments</span></a>
                </li>
            @else
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                </li>

                <li class="{{ Request::is('study*') ? 'active' : '' }}">
                    <a href="{{ route('study.select-subject') }}"><i style="font-size: 18px" class="fa fa-graduation-cap"></i><span class="nav-label">Study</span></a>
                </li>

                <li class="{{ Request::is('practice*') ? 'active' : '' }}">
                    <a href="{{ route('practice.select-subject') }}"><i class="fa fa-flask" aria-hidden="true"></i> <span class="nav-label">Practice</span></a>
                </li>

                @php
                    $cur_route_name = Route::currentRouteName();
                    $current_controller = class_basename(Route::current()->controller)
                @endphp

                @if(Auth::check() and Auth::user()->account_type_id == 1)
                    <li class="{{ $current_controller == 'ExaminationController' ? 'active' : '' }}">
                        <a href="{{ route('examination.prepare') }}"><i style="font-size: 18px" class="fa fa-thermometer-empty" aria-hidden="true"></i><span class="nav-label">Exam</span></a>
                    </li>
                @endif

                <li class="{{ Request::is('examination/top-scorer*') ? 'active' : '' }}">
                    <a href="{{ route('examination.topScorer') }}"><i style="font-size: 18px" class="fa fa-bookmark" aria-hidden="true"></i><span class="nav-label">Top Scorer</span></a>
                </li>
            @endif
        </ul>
    </div>
</nav>
