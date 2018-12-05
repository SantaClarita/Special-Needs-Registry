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
    <div>
    	<form class="form-horizontal" role="form" method="POST" action="{{ url('/contactus') }}">
    		{{ csrf_field() }}
            <div class="panel-heading">
                <h3 class="panel-title">Contact Us Form</h3>
            </div>

            <div class="panel-body">
                <label for="name" class="col-md-4 control-label">
                Name <font color="red">*</font></label>
                <div class="col-md-6 form-group">
	                @if ($errors->has('name'))
	                    <div class="has-error">
	                        <input type="text" class="form-control has-error" id="name" name="name" 
	                            value="{{ old('name') }}" />
	                    </div>
	                    <span class="help-block has-warning has-feedback">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @else
	                    <input type="text" class="form-control" id="name" name="name" 
	                        value="{{ old('name') }}" />
	                @endif
	            </div>

	            <label for="email" class="col-md-4 control-label">
                Email <font color="red">*</font></label>
                <div class="col-md-6 form-group">
	                @if ($errors->has('email'))
	                    <div class="has-error">
	                        <input type="text" class="form-control has-error" id="email" name="email" 
	                            value="{{ old('email') }}" />
	                    </div>
	                    <span class="help-block has-warning has-feedback">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @else
	                    <input type="text" class="form-control" id="email" name="email" 
	                        value="{{ old('email') }}" />
	                @endif
	            </div>

	            <label for="comments" class="col-md-4 control-label">
                Comments/Questions <font color="red">*</font></label>
                <div class="col-md-6 form-group">
	                @if ($errors->has('comments'))
	                    <div class="has-error">
	                    	<textarea type="text" class="form-control" id="comments" name="comments">{{ old('comments') }}</textarea>
	                    </div>
	                    <span class="help-block has-warning has-feedback">
	                        <strong>{{ $errors->first('comments') }}</strong>
	                    </span>
	                @else
	                    <textarea type="text" class="form-control" id="comments" name="comments">{{ old('comments') }}</textarea>
	                @endif
	            </div>
	            <label for="comments" class="col-md-4 control-label"></label>
	            <div class="col-md-6 form-group">
	            	<div class="g-recaptcha" style="padding-left:7px;" data-sitekey="{{config('app.CAPTCHA_KEY')}}"></div>
	            	@if ($errors->has('g-recaptcha-response'))
	            		<span class="help-block has-warning has-feedback">
	                	    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
	                	</span>
	                @endif
	        	</div>
            </div>
            <div class="panel-footer">
            	<div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <input style=""type="submit" name="submit" value="Submit" class="pull-right btn btn-primary btn-default"/>
                    </div>
                </div>
            </div>
    	</form>
    </div>
</div>
@endsection


