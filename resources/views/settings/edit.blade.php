@extends('layouts.app')
@section('title', '- Edit Settings' )
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/update/'.$setting->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="glyphicon glyphicon-edit"></i></b> Email List</div>
            <div class="panel-body">
                <div>
                    <label for="name" class="col-md-4 control-label">
                    	Email List Name</label>
                    <div class="col-md-6 form-group">
                        {{ $setting->name }}
                    </div>
                </div>
                <div>
                    <label for="description" class="col-md-4 control-label">
                    	Description</label>
                    <div class="col-md-6 form-group">
                    	{{ $setting->description }}
                    </div>
                </div>
                <div>
	                <label for="settingemaillist" class="col-md-4 control-label">
		                    Add Email List
		            </label>
                    <div class="col-md-6 form-group">
				    	<ul id="addrlist" class="list-unstyled">
				        	<li>
                                @if (count($settingemaillist) > 0)
                                    @php ($out=0)
                                    <select class="selectpicker" name="setting[]" multiple>
                                    @foreach ($emaillists as $i=>$emaillist)
                                        @foreach ($settingemaillist as $j=>$settingemail)
                                            @if ($settingemail->id == $emaillist->id)
                                                <option value="{{$emaillist->id}}" 
                                                {{ ($settingemail->id == $emaillist->id ? "selected":"") }}>
                                                    {{$emaillist->name}}</option>
                                                @php ($out=1)
                                            @endif
                                            @endforeach
                                            @if ($out == 0)
                                                <option value="{{$emaillist->id}}" 
                                                {{ ($settingemail->id == $emaillist->id ? "selected":"") }}>
                                                        {{$emaillist->name}}</option>
                                            @endif
                                            @php ($out = 0)
                                    @endforeach
                                    </select>
                                @else
                                    <select class="selectpicker" name="setting[]" multiple>
                                    @foreach ($emaillists as $i=>$emaillist)
                                     <option value="{{$emaillist->id}}">{{$emaillist->name}}</option>
                                    @endforeach
                                    </select>
                                @endif
				        	</li>
				    	</ul>
				    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <input style=""type="submit" name="submit" value="Submit" class="pull-right btn-primary btn btn-default"/>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</form>
@endsection


                    