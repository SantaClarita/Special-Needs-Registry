@extends('layouts.app')
@section('title', '- Edit '.$user->lname.' User' )
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/updatepersonalinfo') }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="glyphicon glyphicon-edit"></i> {{ $user->fname." ".$user->lname }}</b></div>
        <div class="panel-body">
            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                <label for="fname" class="col-md-4 control-label">First Name</label>
                <div class="col-md-6">
                    <input id="fname" type="text" class="form-control" name="fname" value="{{ $user->fname }}">
                    @if ($errors->has('fname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                <label for="lname" class="col-md-4 control-label">Last Name</label>
                <div class="col-md-6">
                    <input id="lname" type="text" class="form-control" name="lname" value="{{ $user->lname }}">
                    @if ($errors->has('lname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Phone</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 15px;">
                <label class="col-md-4 control-label">Change Password</label>
            </div>
            <div class="form-group{{ $errors->has('old-password') ? ' has-error' : '' }}">
                <label for="old-password" class="col-md-4 control-label">Old Password <font color="red">*</font></label>
                <div class="col-md-6">
                    <input id="old-password" type="password" class="form-control" name="old-password">
                    @if ($errors->has('old-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old-password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">New Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-md-8 col-md-offset-3">
                    <input style=""type="submit" name="submit" value="Submit" class="pull-right btn btn-primary btn-default"/>
                </div>
            </div>
        </div>
    </div>     
</form>
@endsection                 