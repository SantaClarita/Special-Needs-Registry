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
                        <li class="{{ Request::is('participants') ? 'active' : '' }}"> <a href="{{ url('/participants') }}">My Participants</a></li>
                        <li class="{{ Request::is('faqs') ? 'active' : '' }}"> <a href="{{ url('/faqs') }}">FAQs</a></li>
                        <li class="{{ Request::is('contactus') ? 'active' : '' }}"> <a href="{{ url('/contactus') }}">Contact</a></li>
                        @can('CanSearchParticipants', 'App\Participant')
                            <li>
                                <form class="navbar-form" method="POST" action="{{ url('/participants/search') }}" role="search">
                                {{ csrf_field() }}
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <select class="selectpicker" name="age_range" title="Age" data-width="fit" data-style="btn-default" data-container="body">
                                                <option value="0" {{ old("age_range") == "0" ? "selected" :"" }}>All Ages</option>
                                                <option value="1" {{ old("age_range") == "1" ? "selected" :"" }}>5 - less</option>
                                                <option value="2" {{ old("age_range") == "2" ? "selected" :"" }}>6 - 10</option>
                                                <option value="3" {{ old("age_range") == "3" ? "selected" :"" }}>11 - 15</option>
                                                <option value="4" {{ old("age_range") == "4" ? "selected" :"" }}>16 - 20</option>
                                                <option value="5" {{ old("age_range") == "5" ? "selected" :"" }}>21 - 25</option>
                                                <option value="6" {{ old("age_range") == "6" ? "selected" :"" }}>26 - 30</option>
                                                <option value="7" {{ old("age_range") == "7" ? "selected" :"" }}>31 - 40</option>
                                                <option value="8" {{ old("age_range") == "8" ? "selected" :"" }}>41 - 50</option>
                                                <option value="9" {{ old("age_range") == "9" ? "selected" :"" }}>51 - 60</option>
                                                <option value="10" {{ old("age_range") == "10" ? "selected" :"" }}>61 - 70</option>
                                                <option value="11" {{ old("age_range") == "11" ? "selected" :"" }}>70 or more</option>
                                            </select>
                                        </div>

                                        <input type="text" class="form-control" style="margin-left: 0px;" id="searchbar" placeholder="Search Participant..." name="search" value="{{ old( 'search' ) }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="searchbutton" type="submit"><i class="glyphicon glyphicon-search"></i>Search</button>
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
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
            </div>
    </nav>