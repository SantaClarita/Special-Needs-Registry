<form class="form-horizontal" role="form" method="POST" action="{{ url('/roles/store') }}">
    {{ csrf_field() }}
    <div class="form-group row form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">
         Role Name</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">
        Description</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="description" placeholder="" value="{{ old('description') }}" />
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if (count($permissions) > 0)
     <div class="form-group row">
        <label for="permissions" class="col-md-4 control-label">
         Permissions List</label>
        @foreach ($permissions as $permission)
            <div class="checkbox col-md-8 col-md-offset-4">
            <label><input type="checkbox" name="perm[{{ $permission->id }}]" value="{{ $permission->id }}" @if(is_array(old('perm')) && in_array($permission->id, old('perm'))) checked @endif> {{ $permission->name }}</label>
            </div>
        @endforeach
    </div>
    @endif
    <div class="form-group row">
        <div class="col-md-8 col-md-offset-4">
            <input type="submit" name="submit" value="Submit" class="pull-right btn-primary btn btn-default"/>
        </div>
    </div>
</form>


                    