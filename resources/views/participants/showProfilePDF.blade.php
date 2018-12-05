@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Special Needs Information <small>{{ $participant->fname." ".$participant->middleinitial." ".$participant->lname}}</small>
        </div>
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Participant's Personal Information</h3>
        </div>

        <div class="panel-body">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-3 col-xs-3" style="float:left;padding:2px;">
                    @if ($participant->imagechk())
                        <img class="img-rounded" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" alt="TEMP No Image Found" height="150" width="150">
                    @endif
                </div>
                <div class="col-md-9 col-xs-9" style="float:right; position:relative;" >
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
                                    {{$participant->birthdate->format('F d, Y')}}
                                    <div>Age: 
                                    @if ($participant->birthdate->age != 0)
                                        {{ $participant->birthdate->age }} years old
                                    @else
                                        {{ $participant->birthdate->diffInMonths( Carbon\Carbon::now()  )  }} months old
                                    @endif

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender: </td> 
                                <td>{{$participant->gender}}</td>
                            </tr>
                            <tr>
                                <td>Main Ethnicity: </td> 
                                <td>{{$participant->ethnicity1}}</td>
                            </tr>
                            <tr>
                                <td>Other Ethnicity: </td> 
                                <td>{{$participant->ethnicity2}}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
        <div class="panel-heading">
            <h2>Home and Emergency Contact Information</h2>
        </div>
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Participant's Address</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Individual lives alone?: </td> 
                            <td>{{$participant->livealone}}</td>
                        </tr>
                        <tr>
                            <td>Residence Type: </td> 
                            <td>{{$participant->typeofresidence}}</td>
                        </tr>
                        <tr>
                            <td>Address: </td> 
                            <td>
                                <div>{{$participant->address1.' '.$participant->address2}}</div>
                                <div>{{$participant->city.' '.$participant->state.' '.$participant->zip}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Home Phone: </td> 
                            <td>{{$participant->homephone}}</td>
                        </tr>
                        <tr>
                            <td>Cell Phone: </td> 
                            <td>{{$participant->cellphone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer"></div>
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Main Emergency Contact Information</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Relationship to Participant: </td> 
                            <td>{{$participant->eme_relation}}</td>
                        </tr>
                        <tr>
                            <td>Contact Name: </td> 
                            <td>{{$participant->eme_name}}</td>
                        </tr>
                        <tr>
                            <td>Address: </td> 
                            <td>
                                <div>{{$participant->eme_address1.' '.$participant->eme_address2}}</div>
                                <div>{{$participant->eme_city.' '.$participant->eme_state.' '.$participant->eme_zip}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Home Phone: </td> 
                            <td>{{$participant->eme_homephone}}</td>
                        </tr>
                        <tr>
                            <td>Cell Phone: </td> 
                            <td>{{$participant->eme_cellphone}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer"></div>
        @if ($participant->getOriginal("alt_eme_relation") != 0)
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Alternative Emergency Contact Information</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Relationship to Participant: </td> 
                            <td>{{$participant->alt_eme_relation}}</td>
                        </tr>
                        <tr>
                            <td>Contact Name: </td> 
                            <td>{{$participant->alt_eme_name}}</td>
                        </tr>
                        <tr>
                            <td>Address: </td> 
                            <td>
                                <div>{{$participant->alt_eme_address1.' '.$participant->alt_eme_address2}}</div>
                                <div>{{$participant->alt_eme_city.' '.$participant->alt_eme_state.' '.$participant->alt_eme_zip}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Home Phone: </td> 
                            <td>{{$participant->alt_eme_homephone}}</td>
                        </tr>
                        <tr>
                            <td>Cell Phone: </td> 
                            <td>{{$participant->alt_eme_cellphone}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer"></div>
        @else
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">No Alternative Emergency Contact Information Given</h3>
        </div>
        <div class="panel-footer"></div>
        @endif
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Participant's Common Patterns and Behaviors</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Does participant tend to wander off or elope?</td> 
                            <td>{{$participant->wanders}}</td>
                        </tr>
                        <tr>
                            <td>Favorite Attractions / Locations where the indivdual may be found: </td> 
                            <td>{{$participant->possiblelocations}}</td>
                        </tr>
                        <tr>
                            <td>Describe any behaviors or characteristics that may attract attention or endanger this person </td> 
                            <td>{{$participant->behaviorialhazards}}</td>
                        </tr>
                        <tr>
                            <td>Other important information or suggested accommodations: </td> 
                            <td>{{$participant->otherinfo}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer"></div>
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Participant's Communication Information</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Primary Language: </td> 
                            <td>{{$participant->primarylang}}</td>
                        </tr>
                        <tr>
                            <td>Secondary Language: </td> 
                            <td>{{$participant->secondarylang}}</td>
                        </tr>
                        <tr>
                            <td>Special Communication Methods </td> 
                            <td>{{$participant->communicationmethod}}</td>
                        </tr>
                        <tr>
                            <td>Other important information or suggested accommodations: </td> 
                            <td>{{$participant->otherinfo}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer"></div>

        <div class="panel-heading">
            <h2>Medical Information And Physician</h2>
        </div>
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Physician Contact Information</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td>Physician 1 Information: </td> 
                            <td>
                                <div>Name: {{$participant->physicianname1}}</div>
                                <div>Phone: {{$participant->physicianphone1}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Physician 2 Information: </td> 
                            <td>
                                <div>Name: {{$participant->physicianname2}}</div>
                                <div>Phone: {{$participant->physicianphone2}}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>  
        <div class="panel-footer"></div>
        
        <div class="panel-heading" id="smallerheader">
            <h3 class="panel-title">Medical Condition</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="profile">
                    <tbody>
                        <tr>
                            <td> List of Medical Conditions: </td> 
                            <td>
                                @if (count($disabilities) > 0)
                                    @foreach ($disabilities as $disability)
                                        <div>{{$disability->name}}</div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Other Conditions?: </td> 
                            <td>
                                {{$participant->otherconditions}}
                            </td>
                        </tr>
                        <tr>
                            <td>Medication and Dosage: </td> 
                            <td>
                                {{$participant->medication}}
                            </td>
                        </tr>
                        <tr>
                            <td>Medical, Dietary, Sensory Issues, and Requirements: </td> 
                            <td>
                                {{$participant->medicalrequirements}}
                            </td>
                        </tr>
                        <tr>
                            <td>Medical Devices or Equipment Used: </td> 
                            <td>
                                {{$participant->medicaldevices}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>     
</div>
@endsection