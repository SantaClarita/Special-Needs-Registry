<div class="form-group row {{ $errors->has('ethnicity1') ? ' has-error' : '' }}">
    <label for="ethnicity1" class="col-md-4 control-label">
        Main Ethnicity <font color="red">*</font></label>
    <div class="col-md-6 form-group">
        <select name="ethnicity1" id="ethnicity1" class="form-control">
            <option disabled selected value>Select an Ethnicity</option>
            <option value="0" {{ (old("ethnicity1") == "0" ? "selected"   : ($participant->getOriginal("ethnicity1") == "0" ?  "selected" :"")) }}>Unknown</option>
            <option value="1" {{ (old("ethnicity1") == "1" ? "selected"   : ($participant->getOriginal("ethnicity1") == "1" ?  "selected" :"")) }}>Asian</option>
            <option value="2" {{ (old("ethnicity1") == "2" ? "selected"   : ($participant->getOriginal("ethnicity1") == "2" ?  "selected" :"")) }}>American Indian</option>
            <option value="3" {{ (old("ethnicity1") == "3" ? "selected"   : ($participant->getOriginal("ethnicity1") == "3" ?  "selected" :"")) }}>Black</option>
            <option value="4" {{ (old("ethnicity1") == "4" ? "selected"   : ($participant->getOriginal("ethnicity1") == "4" ?  "selected" :"")) }}>Chinese</option>
            <option value="5" {{ (old("ethnicity1") == "5" ? "selected"   : ($participant->getOriginal("ethnicity1") == "5" ?  "selected" :"")) }}>Filipino</option>
            <option value="6" {{ (old("ethnicity1") == "6" ? "selected"   : ($participant->getOriginal("ethnicity1") == "6" ?  "selected" :"")) }}>Hispanic</option>
            <option value="7" {{ (old("ethnicity1") == "7" ? "selected"   : ($participant->getOriginal("ethnicity1") == "7" ?  "selected" :"")) }}>Japanese</option>
            <option value="8" {{ (old("ethnicity1") == "8" ? "selected"   : ($participant->getOriginal("ethnicity1") == "8" ?  "selected" :"")) }}>Pacific Islander</option>
            <option value="9" {{ (old("ethnicity1") == "9" ? "selected"   : ($participant->getOriginal("ethnicity1") == "9" ?  "selected" :"")) }}>White</option>
            <option value="11" {{ (old("ethnicity1") == "11" ? "selected" : ($participant->getOriginal("ethnicity1") == "11" ? "selected" :"")) }}>Other</option>
        </select>
        @if ($errors->has('ethnicity1'))
            <span class="help-block">
                <strong>{{ $errors->first('ethnicity1') }}</strong>
            </span>
        @endif
    </div>
</div>    
<div class="form-group row {{ $errors->has('ethnicity2') ? ' has-error' : '' }}">
    <label for="ethnicity2" class="col-md-4 control-label">
        Secondary Ethnicity </label>
    <div class="col-md-6 form-group">
        <select name="ethnicity2" id="ethnicity2" class="form-control">
            <option disabled selected value>Can leave blank</option>
            <option value="0" {{ (old("ethnicity2") == "0" ? "selected" :   ($participant->getOriginal("ethnicity2") == "0" ? "selected" :"")) }}>Unknown</option>
            <option value="1" {{ (old("ethnicity2") == "1" ? "selected" :   ($participant->getOriginal("ethnicity2") == "1" ? "selected" :"")) }}>Asian</option>
            <option value="2" {{ (old("ethnicity2") == "2" ? "selected" :   ($participant->getOriginal("ethnicity2") == "2" ? "selected" :"")) }}>American Indian</option>
            <option value="3" {{ (old("ethnicity2") == "3" ? "selected" :   ($participant->getOriginal("ethnicity2") == "3" ? "selected" :"")) }}>Black</option>
            <option value="4" {{ (old("ethnicity2") == "4" ? "selected" :   ($participant->getOriginal("ethnicity2") == "4" ? "selected" :"")) }}>Chinese</option>
            <option value="5" {{ (old("ethnicity2") == "5" ? "selected" :   ($participant->getOriginal("ethnicity2") == "5" ? "selected" :"")) }}>Filipino</option>
            <option value="6" {{ (old("ethnicity2") == "6" ? "selected" :   ($participant->getOriginal("ethnicity2") == "6" ? "selected" :"")) }}>Hispanic</option>
            <option value="7" {{ (old("ethnicity2") == "7" ? "selected" :   ($participant->getOriginal("ethnicity2") == "7" ? "selected" :"")) }}>Japanese</option>
            <option value="8" {{ (old("ethnicity2") == "8" ? "selected" :   ($participant->getOriginal("ethnicity2") == "8" ? "selected" :"")) }}>Pacific Islander</option>
            <option value="9" {{ (old("ethnicity2") == "9" ? "selected" :   ($participant->getOriginal("ethnicity2") == "9" ? "selected" :"")) }}>White</option>
            <option value="11" {{ (old("ethnicity2") == "11" ? "selected" : ($participant->getOriginal("ethnicity2") == "11"? "selected" :"")) }}>Other</option>
        </select>
        @if ($errors->has('ethnicity2'))
            <span class="help-block">
                <strong>{{ $errors->first('ethnicity2') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('haircolor') ? ' has-error' : '' }}">
    <label for="haircolor" class="col-md-4 control-label">
        Hair Color <font color="red">*</font></label>
    <div class="col-md-6 form-group">
        <input type="text"  class="form-control" list="haircol" id="haircolor" name="haircolor" 
            placeholder="Choose Hair Color" value="{{ old( 'haircolor', $participant->haircolor) }}"/>
        @if ($errors->has('haircolor'))
            <span class="help-block">
                <strong>{{ $errors->first('haircolor') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('eyecolor') ? ' has-error' : '' }}">
    <label for="eyecolor" class="col-md-4 control-label">
        Eye Color <font color="red">*</font></label>
    <div class="col-md-6 form-group">
        <select name="eyecolor" id="eyecolor" class="form-control">
            <option selected value="{{ old( 'eyecolor', $participant->eyecolor) }}">{{ old( 'eyecolor', $participant->eyecolor) }}</option>
            <option value="Amber"     {{ (old("eyecolor") == "Amber" ? "selected" : ($participant->eyecolor == "Amber" ? "selected":"")) }}>Amber</option>
            <option value="Blue"      {{ (old("eyecolor") == "Blue" ? "selected": ($participant->eyecolor == "Blue" ? "selected":"")) }}>Blue</option>
            <option value="Brown"     {{ (old("eyecolor") == "Brown" ? "selected": ($participant->eyecolor == "Brown" ? "selected":"")) }}>Brown</option>
            <option value="Gray"      {{ (old("eyecolor") == "Gray" ? "selected": ($participant->eyecolor == "Gray" ? "selected":"")) }}>Gray</option>
            <option value="Green"     {{ (old("eyecolor") == "Green" ? "selected": ($participant->eyecolor == "Green" ? "selected":"")) }}>Green</option>
            <option value="Red/Violet"{{ (old("eyecolor") == "Red/Violet" ? "selected": ($participant->eyecolor == "Red/Violet" ? "selected":"")) }}>Red/Violet</option>
        </select>
        @if ($errors->has('eyecolor'))
            <span class="help-block">
                <strong>{{ $errors->first('eyecolor') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row {{ $errors->has('heightfeet') ? ' has-error' : ($errors->has('heightinch') ? ' has-error' : '') }}">
    <label for="height" class="col-md-4 control-label">
            Height <font color="red">*</font></label>
    <div class="col-md-8 form-group">
        <div class="row">
            @php
                $value = $participant->getOriginal("height");
                $chk=false;
                $nullchk=false;
                if ( is_numeric($value)){
                    $feet = intval($value/12);
                    $inches = $value%12;
                    $heightft = strval($feet);
                    $heightin = strval($inches);
                    $chk=true;
                }
                if ($value == null)
                    $nullchk=true;
            @endphp
            @if ($chk == true)
            <div class="col-sm-3">
                <select name="heightfeet" class="form-control" style="width:auto;">
                    <option selected value> Ft </option>
                    @for ($i = 1; $i < 9; $i++)
                        <option value='{{$i}}' {{ old("heightfeet") == "$i" ? "selected": ("$heightft" == "$i" ? "selected":"") }}>{{$i}}</option>
                    @endfor
                </select>
                Feet
                @if ($errors->has('heightfeet'))
                <span class="help-block">
                    <strong>{{ $errors->first('heightfeet') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-sm-3">
                <select name="heightinch" class="form-control" style="width:auto;">
                    <option selected value> In </option>
                    @for ($i = 0; $i < 12; $i++)
                        <option value='{{$i}}' {{ old("heightinch") == "$i" ? "selected": ("$heightin" == "$i" ? "selected":"") }}>{{$i}}</option>
                    @endfor
                </select>
                Inches
                @if ($errors->has('heightinch'))
                <span class="help-block">
                    <strong>{{ $errors->first('heightinch') }}</strong>
                </span>
                @endif
            </div>
            @else
                <div class="col-sm-3">
                    <select name="heightfeet" class="form-control">
                        <option selected value> Ft </option>
                        @for ($i = 1; $i < 9; $i++)
                            <option value='{{$i}}' {{ (old("heightfeet") == "$i" ? "selected":"") }}>{{$i}}</option>
                        @endfor
                    </select>
                    Feet
                    @if ($errors->has('heightfeet'))
                    <span class="help-block">
                        <strong>{{ $errors->first('heightfeet') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-sm-3">
                    <select name="heightinch" class="form-control">
                        <option selected value> In </option>
                        @for ($i = 0; $i < 12; $i++)
                            <option value='{{$i}}' {{ (old("heightinch") == "$i" ? "selected":"") }}>{{$i}} </option>
                        @endfor
                    </select>
                    Inches
                    @if ($errors->has('heightinch'))
                    <span class="help-block">
                        <strong>{{ $errors->first('heightinch') }}</strong>
                    </span>
                    @endif
                </div>
                @if ($nullchk == false)
                <div class="col-sm-3">
                    <font color="red">*Bad Data was spat out: "{{ $participant->height }}". Please fix it by using the dropdowns.</font>
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('weight') ? ' has-error' : '' }}">
    <label for="weight" class="col-md-4 control-label">
        Weight (lbs) <font color="red">*</font></label>
    <div>
        <div class="col-md-6 form-group">
            <input type="number" placeholder="Hint: 105" class="form-control" id="weight" name="weight" value="{{ old( 'weight', $participant->getOriginal('weight')) }}"/>
            @if ($errors->has('weight'))
                <span class="help-block">
                    <strong>{{ $errors->first('weight') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('disability') ? ' has-error' : '' }}">
    <label for="disability" class="col-md-4 control-label">
        Diagnosis/Disability <font color="red">*</font></label>
    <div>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="disability" name="disability" value="{{ old( 'disability', $participant->disability) }}" maxlength="50" />
            @if ($errors->has('disability'))
                <span class="help-block">
                    <strong>{{ $errors->first('disability') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1 form-group">
            <i title="This will appear on your ID cards." style="color:red; padding-left:5px;" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('identifyingfeatures') ? ' has-error' : '' }}">
    <label for="identifyingfeatures" class="col-md-4 control-label">
        Indentifying Features <font color="red">*</font></label>
    <div>
        <div class="col-md-6 form-group">
            <textarea type="text" class="form-control" id="identifyingfeatures" name="identifyingfeatures" 
                placeholder="Scars, moles, freckles, etc..."  maxlength="150">{{ old( 'identifyingfeatures', $participant->identifyingfeatures) }}</textarea>
            @if ($errors->has('identifyingfeatures'))
                <span class="help-block">
                    <strong>{{ $errors->first('identifyingfeatures') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('idonparticipant') ? ' has-error' : '' }}">
    <label for="idonparticipant" class="col-md-4 control-label">
        Identification on Participant <font color="red">*</font></label>
    <div>
        <div class="col-md-6 form-group">
            <textarea type="text" class="form-control" id="idonparticipant" name="idonparticipant" 
                placeholder="ID bracelet, necklace, tags, device, etc..."  maxlength="150">{{ old( 'idonparticipant', $participant->idonparticipant) }}</textarea>
            @if ($errors->has('idonparticipant'))
                <span class="help-block">
                    <strong>{{ $errors->first('idonparticipant') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('approachsuggestions') ? ' has-error' : '' }}">
    <label for="approachsuggestions" class="col-md-4 control-label">
        Suggestion for Approaching/Calming Participant <font color="red">*</font></label>
    <div>
        <div class="col-md-6 form-group">
            <textarea type="text" class="form-control" id="approachsuggestions" name="approachsuggestions" 
                placeholder="Enter any suggestions to help approach and calm the participant"  maxlength="300">{{ old( 'approachsuggestions', $participant->approachsuggestions) }}</textarea>
            @if ($errors->has('approachsuggestions'))
                <span class="help-block">
                    <strong>{{ $errors->first('approachsuggestions') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>