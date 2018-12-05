@extends('layouts.app')
@section('title', '- Users')
@section('content')
@if(Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('status') }}</strong>
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading clearfix" role="tab" id="headingOne">
            <h4 class="panel-title">
                
                <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                    <div>
                        <b><h4 class="fa fa-user"> </h4> Users </b> -  
                        Click me for information
                    </div>
                </span>           
            </h4>
        </div>
        <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <p>If you need to give a user role/roles, click on the edit button near their name. Be careful of what you can give access 
                to and double check that it is the correct person.</p>
                <p>If you need to edit specific role/roles, you can go <a href="{{url('/roles')}}">here</a>.</p>
                <p>There is a user search function below. You can search by name, email, roles, and phone number.
                Strongest matches will be near the top.</p>

            </div>
        </div>
        <div class="text-center">
            <!-- {{ $users->appends(Request::only('search'))->links() }} -->
        </div>
    <div class="panel-heading clearfix">
        <b><h4 class="glyphicon glyphicon-th-list"> </h4> Users </b>
        <a data-toggle="modal" data-target="#create-modal"><button style="margin-top:9px" class="btn btn-default btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Add a User </button></a>
        <div class="form-group pull-right">
            <form class="navbar-form" method="POST" action="{{ url('/users/search') }}" role="search">
            {{ csrf_field() }}
                @can('manageUserList', Auth::user())
                    <label style="color:white"> Search Deleted Users <input style="margin: 10px" type="checkbox" name="searchdeleted" value="1"
                    {{ (old("searchdeleted") == "1" ? "checked" :"") }}
                    ></label>
                @endcan
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Name Email Roles..." name="search_user" value="{{ old( 'search_user' ) }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" id="search_icon"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Create User</h4>
                    </div>
                
                    <div class="modal-body">
                        @include('users.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body table-responsive">
        <table id="userlist" class="table table-condensed table-striped task-table table-hover">
            <thead class="header">
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Roles</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody class="list">
                @foreach ($users as $i=>$user)
                    <tr>
                        <td class="table-text"><div>{{ $user->fname.' '.$user->lname}}</div></td>
                        <td class="table-text"><div>{{ $user->email }}</div></td>
                        <td class="table-text"><div>{{ $user->phone }}</div></td>
                        <td class="table-text">
                            <div>
                                @foreach ($user->roles as $role)
                                    {{$role->name}} 
                                @endforeach
                            </div>
                        </td>
                        <td class="table-text"><div><a href="{{ url('/users/edit/'.$user->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit </button></a></div></td>
                        <td>
                            @if (isset($user->deleted_at))
                            <button data-toggle="modal" data-target="#confirm-restore-user-{{$user->id}}" type="submit" id="restore-modal-{{ $user->id }}" class="btn btn-success">
                                <i class="fa fa-btn fa-trash"></i>Restore
                            </button>
                            @else
                            <button data-toggle="modal" data-target="#confirm-delete-user-{{$user->id}}" type="submit" id="delete-modal-{{ $user->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                            @endif
                            @include('users.search-delete')
                            @include('users.search-restore')
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
        <div class="text-center">
            {{ $users->appends(Request::only('search', 'searchdeleted'))->links() }}
        </div>
    </div>
</div>



@endsection