<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><img src="{{ asset('resources/images/main.png') }}" alt=""></span>
        <span class="logo-lg"><img src="{{ asset('resources/images/main.png') }}" alt=""></span>
    </a>

    <nav class="navbar navbar-static-top bg-navbar" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <ul class="menu">
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="{{ asset('resources/images/user2-160x160.jpg') }}" width="50" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    Support Team
                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Hello, world!</p>
                                </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>

                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('resources/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                        Team Lead
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Incomplete Time Report</p>
                                    </a>
                                </li>
                            </div>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul> --}}
                {{-- </li> --}}
                {{-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li> --}}
               {{--  <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <h3>
                                        SSA Consulting Group
                                        <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('resources/images/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->fullname }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('resources/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ auth()->user()->fullname }} {{ "" }}
                                <small>Member since {{ auth()->user()->created_at }}</small>
                            </p>
                        </li>
                        {{-- <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                        </li> --}}
                        <li class="user-footer">
                            {{--  <div class="pull-left">
                                <a href="{{ url('admin/settings/profile') }}" class="btn btn-default btn-flat">Profile</a>
                            </div> --}}
                            <div class="pull-right">
                                <a href="{{ action('\Pluma\Controllers\Auth\LoginController@logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>