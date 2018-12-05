@if (count($applications) > 0 )
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#01045b;">
            <div class="panel-title">
                <div class="text-center">
                    <b><h4 class="fa fa-spinner fa-spin fa-fw"> </h4></b> These are your current pending applications
                </div>
            </div>
        </div>
    </div>
    @foreach ($applications as $i=>$application)
    <div class="panel panel-default center-block" style="width:90%;" >
        <div class="panel-heading clearfix" role="tab" id="headingTwo" >
            <h4 class="panel-title">
                <span class="pull-right">
                        <button data-toggle="modal" data-target="#confirm-delete-app-{{$application->id}}" type="submit" id="delete-application-{{ $application->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Delete
                        </button>
                        <div class="modal fade" id="confirm-delete-app-{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>
                                
                                    <div class="modal-body">
                                        <p>You are about to delete an application, you will lose the information that you already 
                                        provided and you will have to start a new application.</p>
                                        <p>Do you want to proceed?</p>
                                        <p class="debug-url"></p>
                                    </div>
                                    <form action="{{ url('/participants/delete/'.$application->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" id="delete-application-{{ $application->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Yes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </span>
                <a href="{{ url('/applications/nav/'.$application->id) }}"><button class="btn btn-default btn-primary pull-right"><i class="fa fa-user-circle"></i> Complete </button></a>
                
                <span role="button" data-toggle="collapse" href="#acollapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    <div>
                        <b><h4 class="fa fa-user"> </h4></b> {{ $application->fname.' '.$application->middleinitial.' '.$application->lname }} - 
                        <i>Birthdate: {{ $application->birthdate->format('F d, Y') }}</i>
                    </div>
                </span>
                
            </h4>
        </div>
        <div id="acollapse{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <div class="col-md-8">
                    @if ($application->status == 5)
                         You have completed {{$application->status}}/5 parts of the application. All you have to do is sign and submit.
                    @else
                        You have completed {{$application->status}}/5 parts of the application.
                    @endif
                </div>
                <div class="col-md-4">
                    <ol class="breadcrumb">
                        <h4>Part</h4>
                        @if ($application->status >= 0)
                            <li class="{{ ($application->status == "0" ? "active":"") }}"><a href="{{ url('/applications/edit-zero/'.$application->id) }}">0</a></li>
                        @endif
                        @if ($application->status >= 1)
                            <li class="{{ ($application->status == "1" ? "active":"") }}"><a href="{{ url('/applications/edit-one/'.$application->id) }}">1</a></li>
                        @endif
                        @if ($application->status >= 2)
                            <li class="{{ ($application->status == "2" ? "active":"") }}"><a href="{{ url('/applications/edit-two/'.$application->id) }}">2</a></li>
                        @endif
                        @if ($application->status >= 3)
                            <li class="{{ ($application->status == "3" ? "active":"") }}"><a href="{{ url('/applications/edit-three/'.$application->id) }}">3</a></li>
                        @endif
                        @if ($application->status >= 4)
                            <li class="{{ ($application->status == "4" ? "active":"") }}"><a href="{{ url('/applications/edit-four/'.$application->id) }}">4</a></li>
                        @endif
                        @if ($application->status >= 5)
                            <li class="{{ ($application->status == "5" ? "active":"") }}"><a href="{{ url('/applications/edit-five/'.$application->id) }}">5</a></li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p><h4>Currently, you do not have any incomplete applications. Click <a class="alert-link" href="{{ url('/applications/create') }}">here</a> or the 
            create button on the top right corner to start an application. You must <b>complete</b> the application for the participant to be added to the Special Needs Registry.</h4></p>
        </div>
    </div>
@endif