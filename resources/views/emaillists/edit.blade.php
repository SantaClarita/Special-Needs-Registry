@extends('layouts.app')
@section('title', '- Edit '.$emaillist->name.' Email List' )
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/emaillists/update/'.$emaillist->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="glyphicon glyphicon-edit"></i> {{$emaillist->name}}</b> Email List</div>
            <div class="panel-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">
                        Email List Name</label>
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="name" placeholder="" value="{{ old( 'name', $emaillist->name) }}" />
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
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="description" placeholder="" value="{{ old( 'description', $emaillist->description) }}" />
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div>
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
                <div>
                    <label for="registeredemails" class="col-md-4 control-label">
                            Add Specific User
                    </label>
                    <div class="col-md-6 form-group">
                        @php ($out=0)
                         <select class="selectpicker form-control" data-live-search="true" data-size="12" data-width="100%" name="registeredemails[]" multiple data-actions-box='true'  data-selected-text-format="count > 3">
                        @foreach ($alluseremails as $i=>$useremail)
                            @if ($useremail["sel"])
                                <option value="{{$useremail["email"]}}" 
                                selected>
                                    {{$useremail["email"]}}</option>
                            @else
                                <option value="{{$useremail["email"]}}" >
                                    {{$useremail["email"]}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label for="useremails" class="col-md-4 control-label">
                            Add Outside Recipient
                    </label>
                    <div class="col-md-6 form-group">
                        <ul id="addrlist" class="list-unstyled">
                            <li>
                                <input class="form-control" list="alluseremails" type="text" name="email[]" id="$i"/>
                            </li>
                        </ul>
                        <button class="btn btn-default" id="addaddr">Add an email recipient</button>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <input type="submit" name="submit" value="Submit" class="pull-right btn-primary btn btn-default" id="submit-edit-emaillist"/>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</form>

<script type="text/javascript">
    var i = document.getElementById("addrlist").children.length; 
    document.getElementById("addaddr").onclick = function() {
        var li = document.createElement("li");
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "email[]");
        input.setAttribute("id", i);
        input.setAttribute("class", "form-control");  
        li.appendChild(input);
        var remove = document.createElement("input");
        remove.onclick = function() {
            this.closest("li").remove();
        }
        remove.setAttribute("type", "button");
        remove.setAttribute("value", "Remove");
        remove.setAttribute("class", "btn btn-danger fa fa-btn fa-trash");
        li.appendChild(remove);

        document.getElementById("addrlist").appendChild(li);
        i++;
        return false;
    }
</script>
@endsection