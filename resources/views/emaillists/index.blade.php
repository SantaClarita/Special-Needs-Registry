@extends('layouts.app')
@section('title', '- Email Lists')
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
                <a data-toggle="modal" data-target="#create-modal" id="create-emaillist-modal"><button style="margin-top:2px" class="pull-right btn btn-default btn-primary"><i class="glyphicon glyphicon-plus"></i> Create an Email List </button></a> 
                <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Create Email List</h4>
                            </div>
                        
                            <div class="modal-body">
                                @include('emaillists.create')
                            </div>
                        </div>
                    </div>
                </div>

                <!--
                <a data-toggle="modal" data-target="#create-modal-mail"><button style="margin-top:2px" class="pull-right btn btn-default btn-primary"><i class="fa fa-paper-plane"></i> Send Mail </button></a> 
                <div class="modal fade" id="create-modal-mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Create Email List</h4>
                            </div>
                        
                            <div class="modal-body">
                                @include('emaillists.sendmail')
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                    <div>
                        <b><h4 class="glyphicon glyphicon-envelope"> </h4> Email Lists</b> - 
                        Click me for information
                    </div>
                </span>       
            </h4>
        </div>
        <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <p>Role recipients are users who receive the email because of their assigned role. Lets say
                you want to create a email list where you only want people with the "Sheriff" role to recieve that email. 
                You can attach that role to the email list you just created and done. No need to add individual sheriffs 
                if roles are properly assigned. Of course, you can add specific emails if need be, such as someone outside
                without account.</p>
                <p>Email recipients are specific recipients that the email list creator decided to include. You do not 
                have to have an account in the website to be a recipient.</p>
                <p>There is a send mail function. You can send mail to a specific email list. Currently you can only send messages with a body.
                </p>
            </div>
        </div>
    </div>
    @foreach ($emaillists as $i=>$emaillist )
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingOne">
            <h4 class="panel-title">
                <span class="pull-right">
                    <button data-toggle="modal" data-target="#confirm-delete-{{$i}}" type="submit" id="delete-role-{{ $emaillist->id }}" class="btn btn-danger">
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
                                    <p>You are about to delete a Email List, this procedure is irreversible.</p>
                                    <p>Do you want to proceed?</p>
                                    <p class="debug-url"></p>
                                </div>
                                <form action="{{ url('/emaillists/delete/'.$emaillist->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="delete-emaillist-{{ $emaillist->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Yes
                                        </button>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </span>
                <a href="{{ url('/emaillists/edit/'.$emaillist->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit </button></a>
                <span role="button" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    <div>
                        <b><i class="glyphicon glyphicon-envelope"></i> {{ $emaillist->name }}</b> - 
                        <i>{{ $emaillist->description }}</i>
                    </div>
                </span>
        
            </h4>
        </div>
        @if (count($emaillist->roles) > 0)   
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <h4><i class="fa fa-users"></i> Role Recipients</h4>
                @foreach ($emaillist->roles as $role)
                    <div id="recipient">
                        <b>{{$role->name}}</b> - 
                        {{$role->description}} </br>
                    </div>
                @endforeach
                <h4><i class="fa fa-user"></i> Email Recipients</h4>
                @if (count($emaillist->useremails) > 0 )
                    <div id="recipient" style="overflow-y:scroll; max-height: 200px;">
                        @foreach ($emaillist->useremails as $useremail)
                            <b>{{$useremail->email}}</b> </br>
                        @endforeach
                    </div>
                @else
                    <div id="recipient">
                        <b><p>None</p></b>
                    </div>
                @endif
          </div>
        </div>
        @else
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <h4><i class="fa fa-users"></i> Role Recipients</h4>
                <div id="recipient">
                    <b><p>None</p></b>
                </div>
                <h4><i class="fa fa-user"></i> Email Recipients</h4>
                @if (count($emaillist->useremails) > 0 )
                    <div id="recipient" style="overflow-y:scroll; max-height: 200px;">
                            @foreach ($emaillist->useremails as $useremail)
                            <b>{{$useremail->email}}</b> </br>
                        @endforeach
                    </div>
                @else
                    <div id="recipient">
                        <b><p>None</p></b>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>

@endsection