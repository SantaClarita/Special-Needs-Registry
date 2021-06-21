<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Special Needs Registry - {{$participant->lname}} Flyer</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/latofont.css') }}">
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <style type="text/css">body {padding-top: 50px;}</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lsidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rsidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flyer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/heightbootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="container-fluid" id="wrapper">
        <div id="header" class="row hidden-print">
            @include('layouts.header')
        </div>
        <div id="content" class="row">
            <div class="col-md-2">
                @include('layouts.leftsidebar')
            </div>
            <div class="col-md-8 col-md-offset-1" id="printpage">
                @if(Session::has('data.status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ Session::get('data.status') }}
                        <!-- @if(Session::has('data.jobid'))
                            <form id="undo_form" action="{{url('/participants/flyer/undo/'.$participant->id.'/'.Session::get('data.jobid'))}}" method="POST">
                            {{ csrf_field() }}
                                <button type="submit" id="undo-participant" class="btn btn-warning">
                                        <i class="fa fa-btn fa-trash"></i>You have 60 seconds to revert the action.
                                </button>
                            </form>
                        @endif -->
                    </strong>
                </div>
                @endif
                 <div class="hidden-print panel panel-default" style="margin-top: 15px;border-color:#DDDDDD;">
                    <div class="panel-heading" style=" background-color:#888888; border-color: #DDDDDD;" role="tab" id="headingOne">
                        <h4 class="panel-title" style="color:white;">
                            <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                                <div>
                                    <b><h4 class="glyphicon glyphicon-envelope"> </h4> Flyer</b> - 
                                    Click me for information
                                    @can('viewParticipantProfile', $participant)
                                    <a class="noevent" href="{{ url('/participants/profile/'.$participant->id) }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-user-circle"></i> Profile </button></a>
                                    @endcan
                                    <a class="noevent" href="{{ url('/participants/ID/'.$participant->id) }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-id-card-o"></i> ID </button></a>
                                    <a class="noevent" href="{{ url('/participants/search') }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-arrow-left"></i> Back</button></a>
                                </div>
                            </span>       
                        </h4>
                    </div>
                    <div id="collapseHelp" class="hidden-print panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body" style="font-size: 17px;">
                            <p>
                             Email PDF sends an email with the flyer PDF attached to an email list/s. You can see the settings tab to
                             find out who receives this email, if you have access to see that.</p>
                             <p>You have the option of downloading the PDF version of the flyer. Also, you may manually print the flyer.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title text-center">Missing Person Information - {{ $participant->fname." ".$participant->middleinitial." ".$participant->lname}}
                        </h3>
                        <div>
                            @can('manageParticipantList', $participant)
                                <a class="hidden-print" href="{{ url('/participants/edit/'.$participant->id) }}"><button class="pull-right btn btn-default btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit </button></a>
                            @endcan
                        </div>
                        </br></br class="hidden-print">
                        <div>
                            <a target="_blank" class="hidden-print" href="{{ url('/participants/showFlyerPDF/'.$participant->id) }}">
                            <button class="btn btn-danger btn-primary pull-right" id="downloadButton">
                                <i class="fa fa-file-pdf-o"></i> Generate PDF </button></a>
                            @can('emailParticipantFlyer', $participant)
                            <button data-toggle="modal" data-target="#confirm-email-flyer" type="submit" class="hidden-print btn btn-default btn-primary pull-right">
                                <i class="fa fa-envelope"></i> Email
                            </button>
                            @include('participants.flyer-send')
                            @endcan
                        </div>
                        <div id="loader" style="display:none;"></div>
                    </div>
                    <div class="panel-body"> 
                        <div id="flyerimage" style="width:200px;height:200px;">
                            @if ($participant->imagechk())
                                <img class="aspectImage img-rounded" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" alt="{{ url('images/nophoto.jpg') }}" height="200" width="200">
                            @else 
                                <img class="aspectImage img-rounded" src="{{ url('images/nophoto.jpg') }}" alt="No Image Found" height="200" width="200">
                            @endif
                        </div>
                        <div id="flyerbody">
                            <table class="profile">
                                <tbody>
                                    <tr>
                                        <td>Name: </td> 
                                        <td>{{$participant->fname.' '.$participant->middleinitial.' '.$participant->lname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nickname: </td> 
                                        <td>{{$participant->nickname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Birthdate: </td> 
                                        <td>
                                            {{$participant->birthdate->format('F d, Y')}} - 
                                            Age: 
                                            @if ($participant->birthdate->age != 0)
                                                {{ $participant->birthdate->age }} years old
                                            @else
                                                {{ $participant->birthdate->diffInMonths( Carbon\Carbon::now()  )  }} months old
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gender: </td> 
                                        <td>{{$participant->gender}}</td>
                                    </tr>
                                    <tr>
                                        <td>Hair Color: </td> 
                                        <td>{{$participant->haircolor}}</td>
                                    </tr>
                                    <tr>
                                        <td>Eye Color: </td> 
                                        <td>{{$participant->eyecolor}}</td>
                                    </tr>
                                    <tr>
                                        <td>Height: </td> 
                                        <td>{{$participant->height}}</td>
                                    </tr>
                                    <tr>
                                        <td>Weight: </td> 
                                        <td>{{$participant->weight}}</td>
                                    </tr>
                                    <tr>
                                        <td>Primary Language: </td> 
                                        <td>{{$participant->primarylang}}</td>
                                    </tr>
                                    <tr>
                                        <td>Disability/Diagnosis: </td> 
                                        <td>{{$participant->disability}}</td>
                                    </tr>
                                    <tr>
                                        <td>Identifying Features: </td> 
                                        <td>{{$participant->identifyingfeatures}}</td>
                                    </tr>
                                    <tr>
                                        <td>Identification on Person: </td> 
                                        <td>{{$participant->idonparticipant}}</td>
                                    </tr>
                                    <tr>
                                        <td>Approach Suggestions / De-escalation techniques: </td> 
                                        <td>{{$participant->approachsuggestions}}</td>
                                    </tr>
                                    <tr>
                                        <td>Favorite Attractions / Locations where the individual may be found: </td> 
                                        <td>{{$participant->possiblelocations}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="flyer" class="panel-footer">
                        <span id="flyerleftfooter">
                            <b>Santa Clarita Valley Station</b></br>
                                23740 Magic Mountain Parkway</br>
                                Santa Clarita, CA 91355</br>
                                (661) 255-1121</br>
                                http://www.scvsheriff.com/</a>
                        </span>
                        <span id="flyerrightfooter">
                            If you have any information about this person please contact the Santa Clarita Valley Sheriff's department.
                            </br>
                            <b>Emergency</b>
                            In the event of an emergency please call <b>911</b>
                        </span>
                    </div>
                </div>  
            </div>
            <div class="col-md-2 hidden-print" id="rsidebar">
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<script type="text/javascript">
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 3000);
    }

    function showPage() {
      document.getElementById("loader").style.display = "block";
    }

    $('.selectpicker').selectpicker();
    $('.noevent').on('click', function(e){
    //$('#'+this.id).click();
        e.stopPropagation();
    });
</script>