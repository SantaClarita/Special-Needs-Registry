@if (count($participants) > 0 )
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color:#447145;">
            <div class="panel-title">
                <div class="text-center">
                    <b><h4 class="fa fa-users"> </h4></b> These are your registered participants
                </div>
            </div>
        </div>
    </div>
    @foreach ($participants as $i=>$participant)
    <div class="panel panel-default center-block" style="width:90%;" >
        <div class="panel-heading clearfix" role="tab" id="headingTwo" >
            <h4 class="panel-title">
                <span class="pull-right" style="padding-left: 20px;">
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
                </span>
                <a href="{{ url('/participants/ID/'.$participant->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-id-card-o"></i> ID </button></a>
                <a href="{{ url('/participants/profile/'.$participant->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-user-circle"></i> Profile </button></a>
                <a href="{{ url('/participants/edit/'.$participant->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Edit </button></a>
                <span role="button" data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    <div>
                        <b><h4 class="fa fa-user"> </h4></b> {{ $participant->fname.' '.$participant->middleinitial.' '.$participant->lname }} - 
                        <i>Birthdate: {{ $participant->birthdate->format('F d, Y') }}</i>
                    </div>
                </span>
                
            </h4>
        </div>
        <div id="collapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <table id="participantlist">
                    <thead>
                        <tr class="header">
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="table-text" style="padding-right:15px">
                                @if ($participant->imagechk())
                                    <img class="idImage aspectImage img-rounded" src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" alt="TEMP No Image Found" height="100" width="100">
                                @else 
                                    <img class="idImage aspectImage img-rounded" src="{{ url('images/nophoto.jpg') }}" alt="No Image Found" height="100" width="100">
                                @endif
                            </td>
                            <td class="table-text">
                                <div>
                                    <b>Name: {{ $participant->fname.' '.$participant->middleinitial.' '.$participant->lname }} - ID# {{$participant->id}}</b>
                                </div>
                                <div>
                                    <b>Gender:</b> {{ $participant->gender }}
                                </div>
                                <div>
                                    <b>Diagnosis:</b> {{ $participant->disability }}
                                </div>
                                <div>
                                @if( strtotime(Carbon\Carbon::parse($participant->updated_at)->addYears(2)->format('F d, Y')) < strtotime(Carbon\Carbon::now()))
                                    <b style="color:red;">Note:</b> Information out of date since  {{Carbon\Carbon::parse($participant->updated_at)->addYears(2)->format('M d, Y') }}.
                                @else
                                    <b style="color:#00cc36;">Note:</b> Information up-to-date until 
                                    {{Carbon\Carbon::parse($participant->updated_at)->addYears(2)->format('M d, Y') }}. 
                                @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div>
                                    <b>Age:</b> {{$participant->age()}}
                                </div>
                                <div>
                                    <b>Height:</b> {{ $participant->height }}
                                </div>
                                <div>
                                    <b>Weight:</b> {{ $participant->weight }}
                                </div>
                                <div>
                                    <b>Hair Color:</b> {{ $participant->haircolor }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="panel-body">
        <div class="alert alert-danger" role="alert">
            <p><h4>Currently, you do not have any registered participants in the Special Needs Registry. Click <a class="alert-link" href="/applications/create">here</a> or the 
            create button on the top right corner to start an application. You must <b>complete</b> the application for the participant to be added to the Special Needs Registry.</h4></p>
        </div>
    </div>
@endif