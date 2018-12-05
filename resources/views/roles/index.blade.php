@extends('layouts.app')
@section('title', '- Roles')
@section('content')
@if(Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('status') }}</strong>
    </div>
@endif
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="modal" data-target="#create-modal"><button style="margin-top:1px" class="pull-right btn btn-default btn-primary"><i class="glyphicon glyphicon-plus"></i> Create a Role </button></a> 
                <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Create Role</h4>
                            </div>
                        
                            <div class="modal-body">
                                @include('roles.create')
                            </div>
                        </div>
                    </div>
                </div>

                <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                    <div>
                        <b><h4 class="fa fa-group"> </h4> Roles </b> -  
                        Click me for information
                    </div>
                </span>           
            </h4>
        </div>
        <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <p>Here you can create roles. You can assign permissions to roles and edit them. Be careful of what you can give access to.</p>
                <p>If you need to assign specific role/roles to a user, you can go <a href="{{url('/users')}}">here</a>.</p>
                <p><u>These are the current application's permissions.</u>
                @foreach ($permissions as $permission)
                    <div>
                        <b>{{$permission->name}}</b> - 
                        {{$permission->description}}
                    </div>
                @endforeach
                </p>

            </div>
        </div>
    </div>
    @foreach ($roles as $i=>$role)
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <span class="pull-right">
                    <button data-toggle="modal" data-target="#confirm-delete-{{$i}}" type="submit" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Delete
                    </button>

                    <div class="modal fade" id="confirm-delete-{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                </div>
                            
                                <div class="modal-body">
                                    <p>You are about to delete a Role, this procedure is irreversible.</p>
                                    <p>Do you want to proceed?</p>
                                    <p class="debug-url"></p>
                                </div>
                                <form action="{{ url('/roles/delete/'.$role->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="delete-role-{{ $role->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Yes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </span>
                <a href="{{ url('/roles/edit/'.$role->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit </button></a>
                <span role="button" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    <div>
                        <b>{{ $role->name }}</b> - 
                        <i>{{ $role->description }}</i>
                    </div>
                </span>
                
            </h4>
        </div>
        @if (count($role->permissions) > 0)   
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <!--Permissions -->
                @foreach ($role->permissions as $permission)
                    <div>
                        <b>{{$permission->name}}</b> - 
                        {{$permission->description}}
                    </div>
                @endforeach
          </div>
        </div>
        @else
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <p>Role has no permissions.</p>
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection