<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/store') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }} row margin-top-sm">
        <label for="fname" class="col-md-4 control-label">First Name</label>

        <div class="col-md-6">
            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}">

            @if ($errors->has('fname'))
                <span class="help-block">
                    <strong>{{ $errors->first('fname') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }} row margin-top-sm">
        <label for="lname" class="col-md-4 control-label">Last Name</label>

        <div class="col-md-6">
            <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}">

            @if ($errors->has('lname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lname') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} row margin-top-sm">
        <label for="phone" class="col-md-4 control-label">Phone</label>

        <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row margin-top-sm">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row margin-top-sm">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} row margin-top-sm">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }} row">
        <label for="roles-confirm" class="col-md-4 control-label">Role List</label>

        <div class="col-md-8">
            @if (count($roles) > 0)
                @foreach ($roles as $role)
                    <div class="checkbox col-md-8 col-md-offset-4">
                        <label><input type="checkbox" name="role[{{ $role->id }}]" value="{{ $role->id }}"
                                @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif>{{ $role->name }}</label>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-btn fa-user"></i> Register
            </button>
        </div>
    </div>
</form>