    <nav class="navbar navbar-top navbar-static-top navbar-fixed-top" id="main">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand col-xs-8" href="{{ url('/') }}">
                        <img class="image-brand" src="{{ url('images/Special-Needs-Registry-Logo.png') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse pull-right" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('participants') ? 'active' : '' }}"> <a href="{{ url('/participants') }}">Participants</a></li>
                        <li class="{{ Request::is('faqs') ? 'active' : '' }}"> <a href="{{ url('/faqs') }}">FAQs</a></li>
                        <li class="{{ Request::is('contactus') ? 'active' : '' }}"> <a href="{{ url('/contactus') }}">Contact</a></li>
                        @can('CanSearchParticipants', 'App\Participant')
                            <li>
                                <form class="navbar-form" method="POST" action="{{ url('/participants/search') }}" role="search">
                                {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchbar" placeholder="Search Participant..." name="search" value="{{ old( 'search' ) }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="searchbutton" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/users/editpersonalinfo') }}"><i class="fa fa-address-book"></i> Edit Information</a></li>
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
            </div>
    </nav>