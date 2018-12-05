<div class="panel-heading" data-toggle="collapse" data-target="#part41" >
    <h3 class="panel-title">Physician Contact Information<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part41">
    <div class="form-group row {{ $errors->has('physicianname1') ? ' has-error' : '' }}">
        <label for="physicianname1" class="col-md-4 control-label">
            Main Physician Name </label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="physicianname1" name="physicianname1" value="{{ old( 'physicianname1', $participant->physicianname1) }}" />
            @if ($errors->has('physicianname1'))
                <span class="help-block">
                    <strong>{{ $errors->first('physicianname1') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('physicianphone1') ? ' has-error' : '' }}">
        <label for="physicianphone1" class="col-md-4 control-label">
            Main Physician Phone Number </label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="physicianphone1" name="physicianphone1" value="{{ old( 'physicianphone1', $participant->physicianphone1) }}" />
            @if ($errors->has('physicianphone1'))
                <span class="help-block">
                    <strong>{{ $errors->first('physicianphone1') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('physicianname2') ? ' has-error' : '' }}">
        <label for="physicianname2" class="col-md-4 control-label">
            Secondary Physician Name </label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="physicianname2" name="physicianname2" value="{{ old( 'physicianname2', $participant->physicianname2) }}" />
            @if ($errors->has('physicianname2'))
                <span class="help-block">
                    <strong>{{ $errors->first('physicianname2') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row{{ $errors->has('physicianphone2') ? ' has-error' : '' }}">
        <label for="physicianphone2" class="col-md-4 control-label">
            Secondary Physician Phone Number </label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="physicianphone2" name="physicianphone2" value="{{ old( 'physicianphone2', $participant->physicianphone2) }}" />
            @if ($errors->has('physicianphone2'))
                <span class="help-block">
                    <strong>{{ $errors->first('physicianphone2') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="panel-footer">
</div>

<div class="panel-heading" data-toggle="collapse" data-target="#part42">
    <h3 class="panel-title"><a>Medical Condition</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part42">
    @if (count($alldisabilities) > 0)
        <div class="form-group {{ $errors->has('disab') ? ' has-error' : '' }}">
            <label for="disabilities" class="col-md-4 control-label">
            Indicate Any Medical Conditions that may apply <font color="red">*</font></label>
       
            <div class="col-md-8 col-md-offset-4">
                @php ($out = 0)
                @foreach ($alldisabilities as $disability)
                    <div class="checkbox col-md-6">
                    @foreach ($disabilities as $chk)
                        @if ($chk->id === $disability->id)
                        <label><input type="checkbox" checked name="disab[{{ $disability->id }}]" value="{{ $disability->id }}" 
                            @if(is_array(old('disab')) && in_array($disability->id, old('disab'))) checked @endif> {{ $disability->name }}</label>
                        @php ($out = 1)
                        @endif
                    @endforeach
                    @if ($out == 0)
                        <label><input type="checkbox" name="disab[{{ $disability->id }}]" value="{{ $disability->id }}" 
                            @if(is_array(old('disab')) && in_array($disability->id, old('disab'))) checked @endif> {{ $disability->name }}</label>
                    @endif
                    @php ($out = 0)
                    </div>
                @endforeach
            </div>
                @if ($errors->has('disab'))
                <div class="col-md-8 col-md-offset-4">
                    <span class="help-block">
                        <strong>{{ $errors->first('disab') }}</strong>
                    </span>
                </div>
                @endif
        </div>
    @endif
    <div class="form-group row {{ $errors->has('otherconditions') ? ' has-error' : '' }}">
        <label for="otherconditions" class="col-md-4 control-label">
            Other Conditions? </label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="otherconditions" name="otherconditions" value="{{ old( 'otherconditions', $participant->otherconditions) }}" />
            @if ($errors->has('otherconditions'))
                <span class="help-block">
                    <strong>{{ $errors->first('otherconditions') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('medication') ? ' has-error' : '' }}">
        <label for="medication" class="col-md-4 control-label">
            Medication and Dosage</label>
        <div>
            <div class="col-md-6 form-group">
                <textarea type="text" class="form-control" id="medication" name="medication" 
                    maxlength="50">{{ old( 'medication', $participant->medication) }}</textarea>
                @if ($errors->has('medication'))
                    <span class="help-block">
                        <strong>{{ $errors->first('medication') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group row {{ $errors->has('medicalrequirements') ? ' has-error' : '' }}">
        <label for="medicalrequirements" class="col-md-4 control-label">
            Medical, Dietary, Sensory Issues, and Requirements</label>
        <div>
            <div class="col-md-6 form-group">
                <textarea type="text" class="form-control" id="medicalrequirements" name="medicalrequirements"
                    maxlength="300">{{ old( 'medicalrequirements', $participant->medicalrequirements) }}</textarea>
                @if ($errors->has('medicalrequirements'))
                    <span class="help-block">
                        <strong>{{ $errors->first('medicalrequirements') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group row {{ $errors->has('medicaldevices') ? ' has-error' : '' }}">
        <label for="medicaldevices" class="col-md-4 control-label">
            Medical Devices or Equipment Used</label>
        <div>
            <div class="col-md-6 form-group">
                <textarea type="text" class="form-control" id="medicaldevices" name="medicaldevices"
                    maxlength="300">{{ old( 'medicaldevices', $participant->medicaldevices) }}</textarea>
                @if ($errors->has('medicaldevices'))
                    <span class="help-block">
                        <strong>{{ $errors->first('medicaldevices') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>