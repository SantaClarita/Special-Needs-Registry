@extends('layouts.app')
@section('title', '- Search')
@section('content')
@if(Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('status') }}</strong>
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading clearfix" role="tab" id="headingOne">
        <h4 class="panel-title">
            <span role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                <div>
                    <b><h4 class="glyphicon glyphicon-th-list"> </h4> Search  </b> -  
                    Click me for information
                </div>
            </span>           
        </h4>
    </div>
    <div id="collapseHelp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            You can search by name, gender, and id number. Filter by Age. Best matches will be near the top.
        </div>
    </div>
    <div class="text-center">
        {{ $participants->appends(Request::only('search', 'searchdeleted', 'age_range', 'gender'))->links() }}
    </div>
    <div class="panel-heading clearfix">
        <b>Search Results <i class="glyphicon glyphicon-th-list"> </i></b>
        <div class="form-group pull-right">
            <form class="navbar-form" method="POST" action="{{ url('/participants/search') }}" role="search">
                {{ csrf_field() }}
                <span class="btn btn-primary btn-xs" style="color:white;" role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                        <h4 style="color:black;" class="fa fa-filter"> </h4>   Filters   
                </span>
                <div id="collapseFilter" class="panel collapse" role="tabpanel" aria-labelledby="filters" style="background-color:#F5F5F5; position:absolute">
                    <h4>Filters</h4>
                    <div class="pull-right">
                        <label> Age
                            <select class="selectpicker" name="age_range" title="Age Filter" data-width="auto">
                                <option value="0" {{ old("age_range") == "0" ? "selected" :"" }}>All Ages</option>
                                <option value="1" {{ old("age_range") == "1" ? "selected" :"" }}>5 - less</option>
                                <option value="2" {{ old("age_range") == "2" ? "selected" :"" }}>6 - 10</option>
                                <option value="3" {{ old("age_range") == "3" ? "selected" :"" }}>11 - 15</option>
                                <option value="4" {{ old("age_range") == "4" ? "selected" :"" }}>16 - 20</option>
                                <option value="5" {{ old("age_range") == "5" ? "selected" :"" }}>21 - 25</option>
                                <option value="6" {{ old("age_range") == "6" ? "selected" :"" }}>26 - 30</option>
                                <option value="7" {{ old("age_range") == "7" ? "selected" :"" }}>31 - 40</option>
                                <option value="8" {{ old("age_range") == "8" ? "selected" :"" }}>41 - 50</option>
                                <option value="9" {{ old("age_range") == "9" ? "selected" :"" }}>51 - 60</option>
                                <option value="10" {{ old("age_range") == "10" ? "selected" :"" }}>61 - 70</option>
                                <option value="11" {{ old("age_range") == "11" ? "selected" :"" }}>70 or more</option>
                            </select>
                        </label>
                    </div>
                    <div class="pull-right">
                        <label> Gender
                            <select class="selectpicker" name="gender" title="Gender" data-width="auto">
                                <option value="" {{ old("gender") == "" ? "selected" :"" }}>None</option> 
                                <option value="Male" {{ old("gender") == "Male" ? "selected" :"" }}>Male</option> 
                                <option value="Female" {{ old("gender") == "Female" ? "selected" :"" }}>Female</option> 
                            </select>
                        </label>
                    </div>
                    <div class="pull-right">
                        @can('manageParticipantList', $tmp)
                        <label> Include Deleted? <input style="margin-right: 10px;margin-left:10px;" type="checkbox" name="searchdeleted" value="1"
                        {{ (old("searchdeleted") == "1" ? "checked" :"") }}
                        ></label>
                        @endcan
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Participant..." name="search" value="{{ old( 'search' ) }}">
                    <span class="input-group-btn">
                        <button name="search_icon" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @if (count($participants) > 0)
    <div class="panel-body table-responsive">
        <table id="participantlist" class="table table-striped">
            <thead>
                <tr class="header">
                    <th>Image</th>
                    <th>Name</th>
                    <th></th>
                    <th style="min-width:45%;width:17%;">Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($participants as $participant)
                    <tr>
                        <td class="table-text">
                            @if ($participant->imagechk())
                                <img class="img-rounded" src="{{ url('/file/participants/'.basename(Storage::url($participant->image_link))) }}" alt="TEMP No Image Found" height="100" width="100">
                            @else 
                                <img class="img-rounded" src="{{ url('images/nophoto.jpg') }}" alt="No Image Found" height="100" width="100">
                            @endif
                        </td>
                        <td class="table-text" style="width:37.5%;">
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
                            @if( strtotime(Carbon\Carbon::parse($participant->updated_at)->addYears(1)->format('F d, Y')) < strtotime(Carbon\Carbon::now()))
                                <b style="color:red;">Note:</b> Information out of date since  {{Carbon\Carbon::parse($participant->updated_at)->addYears(1)->format('M d, Y') }}.
                            @else
                                <b style="color:#00cc36;">Note:</b> Information up-to-date until 
                                {{Carbon\Carbon::parse($participant->updated_at)->addYears(1)->format('M d, Y') }}. 
                            @endif
                            </div>
                        </td>
                        <td class="table-text" style="width:22.5%;">
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
                        <td class="table-text">
                            <div class="row">
                                @can('viewParticipantProfile', $tmp)
                                <a href="{{ url('/participants/profile/'.$participant->id) }}"><button style="max-width:45%;width:45%;" class="btn btn-default btn-primary"><i class="fa fa-user-circle"></i> Profile </button></a>
                                @endcan
                                @can('viewParticipantFlyer', $tmp)
                                <a href="{{ url('/participants/flyer/'.$participant->id) }}"><button  style="max-width:45%;width:45%;" class="btn btn-default btn-primary"><i class="fa fa-newspaper-o"></i> Flyer </button></a>
                                @endcan
                            </div>
                            <br>
                            <div class="row">
                                @can('manageParticipantList', $tmp)
                                <a href="{{ url('/participants/edit/'.$participant->id) }}"><button  style="max-width:45%;width:45%;" class="btn btn-default btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit </button></a>
                                @endcan
                                @can('viewParticipantIDs', $tmp)
                                <a href="{{ url('/participants/ID/'.$participant->id) }}"><button  style="max-width:45%;width:45%;" class="btn btn-default btn-primary"><i class="fa fa-id-card-o"></i> ID </button></a>
                                @endcan
                            </div>
                        </td>
                        @can('manageParticipantList', $tmp)
                        <td>
                            @if (isset($participant->deleted_at))
                            <button data-toggle="modal" data-target="#confirm-restore-part-{{$participant->id}}" type="submit" id="restore-participant-modal-{{ $participant->id }}" class="btn btn-success">
                                <i class="fa fa-btn fa-trash"></i>Restore
                            </button>
                            @else
                            <button data-toggle="modal" data-target="#confirm-delete-part-{{$participant->id}}" type="submit" id="delete-participant-modal-{{ $participant->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                            @endif
                            @include('participants.search-delete')
                            @include('participants.search-restore')
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $participants->appends(Request::only('search', 'searchdeleted', 'age_range', 'gender'))->links() }}
        </div>
    </div>
    @else
        <div class="panel-body">
            <p>There are no matching results</p>
        </div>
    @endif
</div>
@endsection