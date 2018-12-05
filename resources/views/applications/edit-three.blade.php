@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/applications/update-three/'.$participant->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="panel panel-default">
                @include('participants.edit-three') 
                <div class="panel-footer">
                    <div class="form-group">
                        @include('applications.progress')
                        <div class="col-md-4"> 
                            <ol class="breadcrumb">
                                <h4>Part</h4>
                                @if ($participant->status >= 0)
                                    <li><a href="{{ url('/applications/edit-zero/'.$participant->id) }}">0</a></li>
                                @endif
                                @if ($participant->status >= 1)
                                    <li><a href="{{ url('/applications/edit-one/'.$participant->id) }}">1</a></li>
                                @endif
                                @if ($participant->status >= 2)
                                    <li><a href="{{ url('/applications/edit-two/'.$participant->id) }}">2</a></li>
                                @endif
                                @if ($participant->status >= 3)
                                    <li class="active">3</li>
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