<form class="form-horizontal" role="form" method="POST" action="{{ url('/emaillists/sendmail') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
    @if (count($emaillists) > 0)
        <label for="emaillist" class="col-md-4 control-label">
    	To Email List: </label>
        <select class="selectpicker" name="emaillist">
        @foreach ($emaillists as $emaillist)
         <option value="{{ $emaillist->id }}">{{ $emaillist->name }}</option>
        @endforeach
        </select>
        @if ($errors->has('emaillist'))
            <span class="help-block">
                <strong>{{ $errors->first('emaillist') }}</strong>
            </span>
        @endif
    @endif
    </div>
    <div class="form-group row {{ $errors->has('subject') ? ' has-error' : '' }}">
        <label for="subject" class="col-md-4 control-label">
            Subject</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="subject" placeholder="" value="{{ old('subject') }}" />
            @if ($errors->has('subject'))
                <span class="help-block">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('body') ? ' has-error' : '' }}">
        <label for="body" class="col-md-4 control-label">
            Body</label>
        <div class="col-md-6 form-group">
            <textarea type="text" class="form-control" name="body" placeholder="" value="{{ old('body') }}"></textarea>
            @if ($errors->has('body'))
                <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('attachment') ? ' has-error' : '' }}">
        <label for="attachment" class="col-md-4 control-label">
            Attachment</label>
        <div class="col-md-6 form-group">
            <input type="file" class="form-control" name="attachment">
            @if ($errors->has('attachment'))
                <span class="help-block">
                    <strong>{{ $errors->first('attachment') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-8 col-md-offset-3">
            <input style=""type="submit" name="submit" value="Submit" class="pull-right btn-primary btn btn-default"/>
        </div>
    </div>
</form>