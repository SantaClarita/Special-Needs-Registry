@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/applications/update-zero/'.$participant->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Participant's Image Upload</h3>
                </div>

                <div class="panel-body">
                    <p class="col-md-8 col-md-offset-2">It is important to upload an image of the person participating in the CLEAR Special Needs Registry. 
                        Law Enforcement relies on the image to identify the participant and in the case someone found who 
                        is not verbally communicating, often times the image is the only means of identifying someone within 
                        the Special Needs Registry. <b>Please make your image clear, lighted, and close up. Please refer to this</b> 
                        <a target="_blank"  href="{{ url('/images/pictureexample.jpg') }}">example image outline</a>
                    </p>
                    <label for="image" class="col-md-4 control-label">
                    Participant Image(250x250px) <font color="red">*</font></label>
                    <div class="col-md-6 form-group">
                        @if ($participant->imagechk())
                            <img src="data:image/jpeg;base64, {{ base64_encode(Storage::get($participant->image_link)) }}" name="currimage" height="100" width="100">
                        @endif
                        <input type="file" class="form-control" name="image">
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                    <p class="col-md-8 col-md-offset-2">
                         <b>Need Help?</b> Make sure the image is at least 250x250 pixels. The system will not accept the image if it is not at least 250 pixels. Go to <a target="_blank" href="{{ url('/contactus') }}">Contact Us</a> page for assistance.
                    </p>
                </div>
                <div class="panel-footer">
                </div>


                <div class="panel-heading">
                    <h3 class="panel-title">Participant's Personal Information</h3>
                </div>

                <div class="panel-body">
                    @include('participants.edit-zero') 
                </div> 
                <div class="panel-footer">
                    <div class="form-group">
                        @include('applications.progress')
                        <div class="col-md-4">
                            <ol class="breadcrumb">
                                <h4>Part</h4>
                                @if ($participant->status >= 0)
                                    <li class="active">0</li>
                                @endif
                                @if ($participant->status >= 1)
                                    <li><a href="{{ url('/applications/edit-one/'.$participant->id) }}">1</a></li>
                                @endif
                                @if ($participant->status >= 2)
                                    <li><a href="{{ url('/applications/edit-two/'.$participant->id) }}">2</a></li>
                                @endif
                                @if ($participant->status >= 3)
                                    <li><a href="{{ url('/applications/edit-three/'.$participant->id) }}">3</a></li>
                                @endif
                                @if ($participant->status >= 4)
                                    <li><a href="{{ url('/applications/edit-four/'.$participant->id) }}">4</a></li>
                                @endif
                                @if ($participant->status >= 5)
                                    <li><a href="{{ url('/applications/edit-five/'.$participant->id) }}">5</a></li>
                                @endif
                            </ol>
                        </div>
                        <div class="col-md-8">
                            <input style=""type="submit" name="submit" value="Save" class="btn btn-primary pull-right"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection