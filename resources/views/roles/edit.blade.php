@extends('layouts.app')
@section('title', '- Edit '.$role->name.' Role' )
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/roles/update/'.$role->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="glyphicon glyphicon-edit"></i> {{$role->name}}</b> Role</div>
        <div class="panel-body">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">
                 Role Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Enter Role Name..." value="{{ $role->name }}" />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-md-4 control-label">
                Description</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="description" placeholder="Enter Description..." value="{{ $role->description }}" />
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            @if (count($allpermissions) > 0)
                <label for="allpermissions" class="col-md-4 control-label">
                 Permissions List</label>
                @php ($out = 0)
                @foreach ($allpermissions as $permission)
                    <div class="checkbox col-md-8 col-md-offset-4">
                        @foreach ($permissions as $chk)
                            @if ($chk->id === $permission->id)
                                <label><input type="checkbox" checked name="perm[{{ $permission->id }}]" value="{{ $permission->id }}"
                                        @if(is_array(old('perm')) && in_array($permission->id, old('perm'))) checked @endif>{{ $permission->name }}</label>
                                @php ($out = 1)
                            @endif
                        @endforeach
                        @if ($out == 0)
                            <label><input type="checkbox" name="perm[{{ $permission->id }}]" value="{{ $permission->id }}"
                                    @if(is_array(old('perm')) && in_array($permission->id, old('perm'))) checked @endif>{{ $permission->name }}</label>
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


                    