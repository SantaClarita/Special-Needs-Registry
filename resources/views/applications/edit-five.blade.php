@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/applications/update-five/'.$participant->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="panel panel-default">
                <div class="page-header text-center">
                    <h2>Agreement <h4><i>Authorization for Release of Information and Verification of Preparer</i></h4></h2>
                </div>
                @include('participants.edit-five')
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
                                    <li><a href="{{ url('/applications/edit-three/'.$participant->id) }}">3</a></li>
                                @endif
                                @if ($participant->status >= 4)
                                    <li><a href="{{ url('/applications/edit-four/'.$participant->id) }}">4</a></li>
                                @endif
                                @if ($participant->status >= 5)
                                    <li class="active">5</li>
                                @endif
                            </ol>
                        </div>
                        <div class="col-md-8">
                            <input style=""type="submit" name="submit" value="Submit" class="btn btn-primary pull-right"/>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection