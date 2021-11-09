@extends('layouts.app')
@section('title', '- Edit '.$participant->lname.' Profile' )
@section('content')
@if (count($errors))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div>
        <u>Errors</u>
        </div>
        @foreach ($errors->all() as $error)
            <strong><div>{{ $error }}</div></strong>
        @endforeach
    </div>
@endif
<div class="col-md-12">
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/participants/update/'.$participant->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Special Needs Information <small style="color: white;"><b><i class="glyphicon glyphicon-edit"></i></b>
                        <a class="pull-right btn btn-default btn-primary" href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> Back</a>
                        {{ $participant->fname." ".$participant->middleinitial." ".$participant->lname}}</small></h2>
                        <div class="row">
                            @if(count($user) > 0)
                                <span class="pull-left">Owner: {{$user->fname.' '.$user->lname.' ( '}}
                                <a href="mailto:{{$user->email}}">{{$user->email}}</a> )</span>
                            @else
                                <span class="pull-left">Owner: No owner found was deleted most likely</span>
                            @endif
                            @if(isset($participant->updated_at))
                                <span class="pull-right">Last Updated: {{$participant->updated_at->format('F d, Y')}}</span>
                            @else
                                <span class="pull-right">Last Updated: {{$participant->created_at->format('F d, Y')}}</span>
                            @endif
                        </div>

                    @can('manageParticipantListAboveOwner', $participant)
                    <h5> Change Ownership:
                    <select class="selectpicker" name="user" title="No Owner Found">
                        @foreach ($users as $i=>$user)
                         <option value="{{$user->id}}" 
                            {{ old("user") == $user->id ? "selected" : ($user->id == $participant->user_id ? "selected":"") }}
                            >{{$user->fname.' '.$user->lname.' ('.$user->email.')'}}</option>
                        @endforeach
                    </select>   
                    </h5>
                    @endcan
                </div>

                <div class="panel-heading" data-toggle="collapse" data-target="#part0">
                    <h3 class="panel-title">Participant's Image Upload<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
                </div>

                <div class="collapse in panel-body" id="part0">
                    <label for="image" class="col-md-4 control-label">
                    Participant Image 250px X 250px <font color="red">*</font></label>
                    <div class="col-md-6 form-group">
                        @if ($participant->imagechk())
                            <img class="aspectImage idImage" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" height="100" width="100">
                        @endif
                        <div>
                            <label for="image">Choose an image to upload</label>
                            <input type="file" name="image">
                        </div>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>
                <div class="panel-footer"></div>
                <div class="panel-heading" data-toggle="collapse" data-target="#part1" >
                    <h3 class="panel-title">Participant's Personal Information<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
                </div>
                
                <div class="collapse in panel-body" id="part1">
                    @include('participants.edit-zero')
                    @include('participants.edit-one') 
                </div>
                <div class="panel-footer">
                </div>  
                <div class="page-header">
                    <h2>Home and Contact Information <small>Participants Infomation and Emergency Contact</small></h2>
                </div>
                @include('participants.edit-two')  
                <div class="panel-footer">
                </div>
                @include('participants.edit-three')
                <div class="panel-footer">
                </div>
                <div class="page-header">
                    <h2>Medical Information <small>Medical Conditions and Physician Contact</small></h2>
                </div>
                @include('participants.edit-four')
                <div class="panel-footer">
                </div> 
                <div class="page-header">
                    <h2>Agreement <small> Authorization for Release of Information</small></h2>
                </div>
                @include('participants.edit-five')
                <div class="panel-footer">
                    <div class="form-group">
                            <div class="col-md-12">
                                <input style=""type="submit" name="submit" value="Submit" class="pull-right btn btn-primary"/>
                            </div>
                    </div>
                </div>
            </div>
        </form>
        @can('manageParticipantListAboveOwner', $participant)
        <div class="panel panel-default">
            <div class="panel-heading clearfix"> 
                <div class="pull-left">
                    Delete this participant?
                </div>
                <div class="pull-right">  
                    <button data-toggle="modal" data-target="#confirm-delete-part-{{$participant->id}}" type="submit" id="delete-participant-{{ $participant->id }}" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Delete
                    </button>
                    <div class="modal fade" id="confirm-delete-part-{{$participant->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                </div>
                            
                                <div class="modal-body">
                                    <p>You are about to delete a registered participant, this procedure is irreversible.</p>
                                    <p>Do you want to proceed?</p>
                                    <p class="debug-url"></p>
                                </div>
                                <form action="{{ url('/participants/delete/'.$participant->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="delete-participant-{{ $participant->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Yes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

<datalist id="lang">
    <option value="English">English</option>
    <option value="Spanish">Spanish</option>
    <option value="Chinese">Chinese</option>
    <option value="Tagalog">Tagalog</option>
    <option value="Vietnamese">Vietnamese</option>
    <option value="Korean">Korean</option>
    <option value="Farsi/Persian">Farsi</option>
    <option value="Armenian">Armenian</option>
    <option value="Russian">Russian</option>
    <option value="Arabic">Arabic</option>
    <option value="None">None</option>
</datalist>

<datalist id="haircol">
    <option value="Black">Black</option>
    <option value="Blonde">Blonde</option>
    <option value="Dark Brown">Dark Brown</option>
    <option value="Brown">Brown</option>
    <option value="Light Brown">Light Brown</option>
    <option value="Gray">Gray</option>
    <option value="Blonde">Blonde</option>
</datalist>
@endsection