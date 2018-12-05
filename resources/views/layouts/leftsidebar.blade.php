@if(Auth::check())
    @if (Auth::user()->viewLeftSidebar())
        <nav class="navbar navbar-default navbar-left sidebar navbar-absolute" role="navigation" style="margin-top:5px;">
            <div class="container-fluid">
                <a class="navbar-brand">Admin Functions</a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>      
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @can('manageUserList', 'App\User')
                        <li class="{{ Request::is('users')?'active':''}}"><a href="{{ url('/users') }}">Users<span class="pull-right hidden-xs showopacity fa fa-user"></span></a></li>
                        @endcan
                        @can('manageRolesList', 'App\Role')
                        <li class="{{ Request::is('roles')?'active':''}}"><a href="{{ url('/roles') }}">Roles<span class="pull-right hidden-xs showopacity fa fa-users"></span></a></li>
                        @endcan
                        @can('manageEmailList', 'App\Emaillist')
                        <li class="{{ Request::is('emaillists')?'active':''}}"><a href="{{ url('/emaillists') }}">Email Lists<span class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                        @endcan
                        @can('manageSetting', 'App\Setting')
                        <li class="{{ Request::is('settings')?'active':''}}"><a href="{{ url('/settings') }}">Settings<span class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a></li>
                        @endcan
                        @can('viewLogs', 'App\Log')
                        <li class="{{ Request::is('logs')?'active':''}}"><a href="{{ url('/logs') }}">Logs<span class="pull-right hidden-xs showopacity fa fa-book"></span></a></li>
                        @endcan
                    </ul> 
                </div>
            </div>
        </nav>
    @endif
@endif
