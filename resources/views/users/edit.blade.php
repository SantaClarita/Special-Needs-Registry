@extends('layouts.app')
@section('title', '- Edit '.$user->lname.' User' )
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/update/'.$user->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="glyphicon glyphicon-edit"></i> {{ $user->fname." ".$user->lname }}</b></div>
        <div class="panel-body">
            <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
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
            <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
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
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
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
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
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
            @if (count($allroles) > 0)
                <label for="allroles" class="col-md-4 control-label">
                 Roles List</label>
                @php ($out = 0)
                @foreach ($allroles as $role)
                    <div class="checkbox col-md-8 col-md-offset-4">
                    @foreach ($roles as $chk)
                    @if ($chk->id === $role->id)
                        <label><input type="checkbox" checked name="role[{{ $role->id }}]" value="{{ $role->id }}"
                                @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif>{{ $role->name }}</label>
                        @php ($out = 1)
                    @endif
                    @endforeach
                    @if ($out == 0)
                        <label><input type="checkbox" name="role[{{ $role->id }}]" value="{{ $role->id }}"
                                @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif>{{ $role->name }}</label>
                    @endif
                    @php ($out = 0)
                    </div>
                @endforeach
            @endif
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-md-8 col-md-offset-3">
                    <input style=""type="submit" name="submit" value="Submit" class="pull-right btn-primary btn btn-default"/>
                </div>
            </div>
        </div>
    </div>     
</form>
@endsection


                    