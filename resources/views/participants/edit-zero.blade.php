<div class="form-group row {{ $errors->has('fname') ? ' has-error' : '' }}">
    <label for="fname" class="col-md-4 control-label">
     First Name <font color="red">*</font> </label>
    <div class="col-md-6 form-group">
        @if ($errors->has('fname'))
            <div class="has-error">
                <input type="text" class="form-control has-error" id="fname" name="fname" 
                    value="{{ old( 'fname', $participant->fname) }}" />
            </div>
            <span class="help-block has-warning has-feedback">
                <strong>{{ $errors->first('fname') }}</strong>
            </span>
        @else
            <input type="text" class="form-control" id="fname" name="fname" 
                value="{{ old( 'fname', $participant->fname) }}" />
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('middleinitial') ? ' has-error' : '' }}">
    <label for="middleinitial" class="col-md-4 control-label">
      Middle Initial</label>
    <div class="col-md-6 form-group">
        <input type="text" class="form-control" id="middleinitial" name="middleinitial" 
            value="{{ old( 'middleinitial', $participant->middleinitial) }}" />
        @if ($errors->has('middleinitial'))
            <span class="help-block">
                <strong>{{ $errors->first('middleinitial') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('lname') ? ' has-error' : '' }}">
    <label for="lname" class="col-md-4 control-label">
     Last Name <font color="red">*</font></label>
    <div class="col-md-6 form-group">
        <input type="text" class="form-control" id="lname" name="lname" 
            value="{{ old( 'lname', $participant->lname) }}" />
        @if ($errors->has('lname'))
            <span class="help-block">
                <strong>{{ $errors->first('lname') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('nickname') ? ' has-error' : '' }}">
    <label for="nickname" class="col-md-4 control-label">
        Nickname</label>
    <div class="col-md-6 form-group">
        <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old( 'nickname', $participant->nickname) }}"/>
        @if ($errors->has('nickname'))
            <span class="help-block">
                <strong>{{ $errors->first('nickname') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('month') ? ' has-error' : ($errors->has('day') ? ' has-error' : ($errors->has('year') ? ' has-error' : '')) }}">
    <label for="date" class="col-md-4 control-label">Birthdate <font color="red">*</font></label>
    <div class="col-md-8 form-group">
        <div class="row">
            <div class="col-md-3"  style="width:auto;">
                <select class="form-control" id="date" name="month">
                    <option disabled selected value>Month</option> 
                    <option value="1" {{  old("month") == "1"  ? "selected" : ($participant->birthdate->format("m") == "1"  ? "selected":"") }}>January</option>
                    <option value="2" {{  old("month") == "2"  ? "selected" : ($participant->birthdate->format("m") == "2"  ? "selected":"") }} >February</option>
                    <option value="3" {{  old("month") == "3"  ? "selected" : ($participant->birthdate->format("m") == "3"  ? "selected":"") }}>March</option>
                    <option value="4" {{  old("month") == "4"  ? "selected" : ($participant->birthdate->format("m") == "4"  ? "selected":"") }}>April</option>
                    <option value="5" {{  old("month") == "5"  ? "selected" : ($participant->birthdate->format("m") == "5"  ? "selected":"") }}>May</option>
                    <option value="6" {{  old("month") == "6"  ? "selected" : ($participant->birthdate->format("m") == "6"  ? "selected":"") }}>June</option>
                    <option value="7" {{  old("month") == "7"  ? "selected" : ($participant->birthdate->format("m") == "7"  ? "selected":"") }}>July</option>
                    <option value="8" {{  old("month") == "8"  ? "selected" : ($participant->birthdate->format("m") == "8"  ? "selected":"") }}>August</option>
                    <option value="9" {{  old("month") == "9"  ? "selected" : ($participant->birthdate->format("m") == "9"  ? "selected":"") }}>September</option>
                    <option value="10" {{ old("month") == "10" ? "selected" : ($participant->birthdate->format("m") == "10" ? "selected":"") }}>October</option>
                    <option value="11" {{ old("month") == "11" ? "selected" : ($participant->birthdate->format("m") == "11" ? "selected":"") }}>November</option>
                    <option value="12" {{ old("month") == "12" ? "selected" : ($participant->birthdate->format("m") == "12" ? "selected":"") }}>December</option>
                </select>
                @if ($errors->has('month'))
                <span class="help-block">
                    <strong>{{ $errors->first('month') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-3" style="width:auto;">
                <select class="form-control" name="day" value="{{ old('day') }}">
                    <option disabled selected value>Day</option>
                    @for ($i = 1; $i < 32; $i++)
                        <option value='{{$i}}' {{ old("day") == "$i" ? "selected" : ($participant->birthdate->format("d") == "$i" ? "selected":"") }}>{{$i}}</option>
                    @endfor
                </select>
                @if ($errors->has('day'))
                <span class="help-block">
                    <strong>{{ $errors->first('day') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-3" style="width:auto;">
                <select class="form-control" name="year" value="{{ old('year') }}">
                    <option disabled selected value>Year</option>
                    @for ($j = date("Y"); $j > 1917; $j--)
                        <option value='{{$j}}' {{ old("year") == "$j" ? "selected" : ($participant->birthdate->format("Y") == "$j" ? "selected":"") }}>{{$j}}</option>
                    @endfor
                </select>
                @if ($errors->has('year'))
                <span class="help-block">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('gender') ? ' has-error' : '' }}">
    <label for="gender" class="col-md-4 control-label">
        Gender <font color="red">*</font></label>
    <div class="col-md-8 form-group">
        <label>
            <input type="radio" value="Male" name="gender" {{ old("gender") == "Male" ? "checked": ($participant->gender == "Male" ? "checked":"") }}>
            Male
        </label>
        <label>
            <input type="radio" value="Female" name="gender" {{ old("gender") == "Female" ? "checked" : ($participant->gender == "Female" ? "checked":"") }}>
            Female
        </label>
        @if ($errors->has('gender'))
            <span class="help-block">
                <strong>{{ $errors->first('gender') }}</strong>
            </span>
        @endif
    </div>
</div>