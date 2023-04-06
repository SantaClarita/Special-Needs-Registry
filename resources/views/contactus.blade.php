@extends('layouts.app')
@section('title', '- Contact Us')
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
    <div class="panel-heading">Contact Information</div>

    <div class="panel-body">
    	<div>
	        <b>SNR Administrator</b><br>
			Name: Kevin Tonoian<br>
			<!-- Phone:{{config('app.adminPhone')}}<br> -->
			Email: <a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a>
		</div>
    </div>

    <div class="panel-heading">Mailing Address</div>

    <div class="panel-body">
    	<div>
	    	If no digital image available, please send it here. Provide the participant's name, so we know who the person is.<br>
	        <b>Family Focus Resource Center</b><br>
			Attention Emily Iland<br>
			25360 Magic Mountain Parkway, Suite 150 <br>
			Santa Clarita, CA 91355
		</div>
    </div>
</div>
@endsection


