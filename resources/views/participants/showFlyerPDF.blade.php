<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Special Needs Registry</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/latofont.css') }}" media="all">
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flyer.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" media="all">
</head><body>
    <div class="col-md-12" id="printpage" style="margin-left:-25px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Missing Person Information - {{ $participant->fname." ".$participant->middleinitial." ".$participant->lname}}</h3>
            </div>
            <div class="panel-body">
                    <div id="flyerimage" style="width:200px;height:200px;">
                        @if ($participant->imagechk())
                            <img class="img-rounded" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" alt="TEMP No Image Found" height="200" width="200">
                        @else 
                            <img class="img-rounded" src="{{ url('images/nophoto.jpg') }}" alt="No Image Found" height="200" width="200">
                        @endif
                    </div>
                    <div id="flyerbody">
                        <table>
                            
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
                                        {{$participant->birthdate->format('F d, Y')}}
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
                        <b>Emergency</b></br>
                        In the event of an emergency please call <b>911</b>
                </span>
            </div>
        </div>     
    </div>
</body></html>