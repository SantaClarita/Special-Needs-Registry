@extends('layouts.app')
@section('title', '- Participants')
@section('content')
@if(Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('status') }}</strong>
    </div>
@endif
<div>
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a href="{{ url('/applications/create') }}"><button class="btn btn-default btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Add a Participant </button></a>
                <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                    <div>
                        <b><h4 class="fa fa-sticky-note"> </h4> Note </b> -  
                        Click me for information
                    </div>
                </span>           
            </h4>
        </div>
        <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <p>
                To register a participant, you must start an application and complete it. Your
                participant is not registered in the Special Needs Registry until you complete
                and submit the application. Non-registered participants (pending applications) 
                will <b>NOT</b> be accessible to deputies.</p>
                <p>
                In the "Registered Participants" tab, you are provided with links to your 
                participants profile. It also displays information such as when the information will expire.
                It is important to keep information up to date because deputies rely on this information in 
                an event of a incident/crisis. Outdated or inaccurate information wastes precious time when 
                every second is vital when locating a missing person or assisting someone in an emergency.
                </p>
                <p>
                In the "Pending Applications" tab, you can see how many applications you haven't completed/submitted.
                </p>
                <strong>Notice:</strong> Information that is more than 2 years old will be deleted.
            </div>
        </div>
    </div>
    <div class="modal fade in" id="prompt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Important Information About Your ID Cards</h4>
                </div>
            
                <div class="modal-body">
                    Now that your registry form is complete, you can print a Special Needs Registry Identification Card (SNR ID Card) that contains key information from the registration form. These cards can be presented to law enforcement personnel or responders when help is need. You can print as many copies of the card as you need. Remember to update the cards regularly, especially when any of the information on the card changes.
                    <br><br>
                    In an emergency or when help is needed, always let the 911 operator and any deputies know that the person is part of the Special Needs Registry. Caregivers and/or the person with special needs can also present the Special Needs Registry Identification Cards (SNR ID Card) to deputies, but <b>remember to always ask permission to get the ID out of a pocket, wallet, purse or bag.</b>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/participants/ID/'.session('idPrompt')) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-id-card-o"></i> ID </button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                <i class="fa fa-users"></i> Registered Participants <span class="badge">{{count($participants)}}</span></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                <i class="fa fa-spinner fa-spin fa-fw"></i>Pending Applications <span class="badge">{{count($applications)}}</span></a></li>
        </ul>
          <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                    @include('participants.index-registered')
            </div>
            <div role="tabpanel" class="tab-pane" id="profile"> 
                    @include('participants.index-applications')
            </div>
        </div>
    </div>
</div>
@endsection