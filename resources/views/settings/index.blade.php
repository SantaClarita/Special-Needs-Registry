@extends('layouts.app')
@section('title', '- Settings')
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
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                    <div>
                        <b><h4 class="fa fa-cog"> </h4> Settings </b> -  
                        Click me for information
                    </div>
                </span>          
            </h4>
        </div>
        <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <p>If you want to attach/detach email lists to a setting, you can click edit/remove on the specific settings panel. 
                    You can attach multiple email lists or none*. If you attach none, an error will be generated once that action 
                    is fired by a user.</p>
                 <p>If you want to edit an email lists, you can click edit on that email list. Take notice that any changes to an email 
                 list will have affect on other settings which have that common email list attached. If you need to create a new email 
                 list, you can go <a href="{{url('/emaillists')}}"> here</a>. You can also manage email lists here.
                <p>Notes: A Webmaster Email ({{config('app.webmasterEmail')}}) is attached to EVERY single email action taken by default. 
                There is no need to add this email anywhere.</p>
                <p>If there are no recipients or a setting has no email list, once that specific action is fired then the website will 
                generate an error. This error will say to contact the admin due to said reasons.</p>
                <p>This used to have a lot more functions such as edit emails and such. There were changes made to the SNR program which allowed me to cut many email features which was better for the users. For now, the main features will be the contact us form and mass email flyer action</p>
            </div>
        </div>
    </div>
    @foreach ($settings as $i=>$setting)
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a href="{{ url('/settings/edit/'.$setting->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit Setting </button></a>
                <span role="button" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    <div>
                        <i class="fa fa-cog"></i><b> {{ $setting->name }}</b> - 
                        <i>{{ $setting->description }}</i>
                    </div>
                </span>
            </h4>
        </div>
        @if (count($setting->emaillists) > 0)   
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body clearfix">
                <!--Permissions -->
                <table class="table well">
                    @foreach ($setting->emaillists as $j=>$emaillist)
                    <tr>
                        <td>
                            <div class="col-md-12 clearfix">
                                    <div class="col-md-8">
                                        <span role="button" data-toggle="collapse" href="#collapseEL-{{$i}}-{{$j}}" aria-expanded="false" aria-controls="collapseEL-{{$i}}-{{$j}}">
                                            <b><i class="glyphicon glyphicon-envelope"></i> {{$emaillist->name}}</b> - 
                                            {{$emaillist->description}}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="pull-right">
                                            <button data-toggle="modal" data-target="#confirm-delete-{{$i}}-{{$j}}" type="submit" id="delete-emaillist-{{ $emaillist->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Remove
                                            </button>
                                            <div class="modal fade" id="confirm-delete-{{$i}}-{{$j}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Confirm Removal</h4>
                                                        </div>
                                                    
                                                        <div class="modal-body">
                                                            <p>You are only removing the email list from this setting.</p>
                                                            <p>Do you want to proceed?</p>
                                                            <p class="debug-url"></p>
                                                        </div>
                                                        <form action="{{ url('/settings/delete/'.$setting->id.'/'.$emaillist->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" id="delete-setting-{{ $emaillist->id }}" class="btn btn-danger">
                                                                        <i class="fa fa-btn fa-trash"></i>Yes
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                        <a href="{{ url( '/emaillists/edit/'.$emaillist->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit </button></a>
                                    </div>
                            </div>
                            <div class= "col-md-12 collapse" id="collapseEL-{{$i}}-{{$j}}" aria-expanded="false" aria-controls="collapseEL-{{$i}}-{{$j}}">
                                <div class="row">
                                    <div class="row-eq-height">
                                        <div class="col-md-6 well" style="background-color:white;"> 
                                            <div>
                                                <h4><span class="fa fa-users"></span> Role Recipients</h4>
                                            </div>
                                            @if (count($emaillist->roles) > 0)
                                                @foreach($emaillist->roles as $role)
                                                <div id="recipient">
                                                    <b>{{$role->name}}</b>
                                                </div>
                                                @endforeach
                                            @else
                                                <div>
                                                    <b>None</b>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-md-6 well" style="background-color:white;">
                                            <div>
                                                <h4><span class="fa fa-user"></span> Email Recipients</h4>
                                            </div>
                                            @if (count($emaillist->useremails) > 0 && count($emaillist->useremails) < 20 )
                                                @foreach($emaillist->useremails as $useremail)
                                                    <div id="recipient">
                                                        <b>{{$useremail->email}}</b>
                                                    </div>
                                                @endforeach
                                            @elseif (count($emaillist->useremails) > 20)
                                                <div id="recipient">
                                                    Too many recipients to list...
                                                </div>
                                            @else
                                                <div>
                                                    <b>None</b>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </table>
          </div>
        </div>
        @else
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <p>Settings has no email lists assigned.</p>
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection