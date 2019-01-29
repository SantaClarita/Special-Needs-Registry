@extends('layouts.app')
@section('title', '- Participants ID')
@section('content')
</br>
<div class="col-md-12" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix hidden-print">
            <button class="pull-right btn btn-primary hidden-print" onclick="myPrint()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
            <a href="{{ url('/participants/flyer/'.$participant->id) }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-newspaper-o"></i> Flyer </button></a>
            <a href="{{ url('/participants/profile/'.$participant->id) }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-user-circle"></i> Profile </button></a>
            <a href="{{ url('/participants/search') }}"><button class="pull-right btn btn-default btn-primary"><i class="fa fa-arrow-left"></i> Back</button></a>
        </div>
    </div>
        <div class="ProfileID clearfix">
            <h2 style="color: #437143;"><b>SCV Special Needs Registry: Clearscv.org</b></h2>
            <div class="innerProfileID">
                <div align="center" class="ProfileIDImage">
                    @if ($participant->imagechk())
                        <img class="aspectImage idImage img-rounded" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" alt="TEMP No Image Found" height="150" width="150">
                    @else 
                        <img class="aspectImage idImage img-rounded" src="{{ url('images/nophoto.jpg') }}" alt="No Image Found" height="150" width="150">
                    @endif
                </div>
                <p>
                    <span>
                    <b style="font-size:11px;">{{$participant->fname.' '.$participant->middleinitial.' '.$participant->lname}}</b>
                    </span>
                    <span>
                        (ID: #{{$participant->id}})
                    </span>
                    <span>
                        DOB: {{$participant->birthdate->format('F d, Y')}}
                    </span>
                    <span>
                        {{$participant->address1}} 
                        {{$participant->address2}}
                    </span>
                    <span>
                        {{  $participant->city.', '.$participant->state.' '.$participant->zip  }}
                    </span>
                    <span>
                        <b>Diagnosis/Disability</b><span>{{$participant->disability}}</span>
                    </span>
                </p>
                <ul class="profileList clearfix">
                    <li>
                        <b>Gender</b></br>
                        {{$participant->gender}}
                    </li>
                    <li>
                        <b>Hair</b></br>
                        {{$participant->haircolor}}
                    </li>
                    <li>
                        <b>Height</b></br>
                        {{$participant->height}}
                    </li>
                    <li>
                        <b>Weight</b></br>
                        {{$participant->weight}}
                    </li>
                    <li>
                        <b>Eye</b></br>
                        {{$participant->eyecolor}}
                    </li>
                </ul>
                </br>
            </div>    
        </div>
        <div class="ProfileID clearfix backsideID">
            <h2 style="color: #437143;"><b>SCV Special Needs Registry: Clearscv.org</b></h2>
            <div class="innerProfileID" style="font-size:10.5px;">
                <b>Behaviors or characteristics that may attract attention or endanger this person</b>
                <div>
                    <span>{{$participant->behaviorialhazards}}</span>
                </div>
                </br>   
                <b>Emergency Contact:</b>
                <div>
                    <span>{{$participant->eme_name}}</span>
                </div>
                <div>
                    <span>{{ $participant->eme_address1.' '.$participant->eme_address2.' '.$participant->eme_city.', '.$participant->eme_state.' '.$participant->eme_zip }}</span>
                </div>
                <div>
                    <span>Phone: {{$participant->eme_homephone}}</span>
                </div>
                <div>
                    <span>Cell: {{$participant->eme_cellphone}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myPrint() {
        window.print();
    }
</script>
@endsection