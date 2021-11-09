<div class="panel-heading" data-toggle="collapse" data-target="#part31" >
    <h3 class="panel-title">Participant's Common Patterns and Behaviors<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part31">
    <div class="form-group row {{ $errors->has('wanders') ? ' has-error' : '' }}">
        <label for="wanders" class="col-md-4 control-label">
            Does participant tend to wander off or elope? <font color="red">*</font></label>
        <div class="col-md-8 form-group ml-2">
            <label>
                <input type="radio" value="1" name="wanders" {{ old("wanders") == "1" ? "checked": ( $participant->getOriginal("wanders") == "1" ? "checked":"") }}>
                Yes
            </label>
            <label>
                <input type="radio" value="2" name="wanders" {{ old("wanders") == "2" ? "checked": ( $participant->getOriginal("wanders") == "2" ? "checked":"") }}>
                No
            </label>
            <label>
                <input type="radio" value="3" name="wanders" {{ old("wanders") == "3" ? "checked": ( $participant->getOriginal("wanders") == "3" ? "checked":"") }}>
                Sometimes
            </label>
            @if ($errors->has('wanders'))
                <span class="help-block">
                    <strong>{{ $errors->first('wanders') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('possiblelocations') ? ' has-error' : '' }}">
        <label for="possiblelocations" class="col-md-4 control-label">
            Favorite Attractions/Locations where the individual might wander/elope to</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="possiblelocations" name="possiblelocations" 
                value="{{ old( 'possiblelocations', $participant->possiblelocations) }}" maxlength="50" />
            @if ($errors->has('possiblelocations'))
                <span class="help-block">
                    <strong>{{ $errors->first('possiblelocations') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('behaviorialhazards') ? ' has-error' : '' }}">
        <label for="behaviorialhazards" class="col-md-4 control-label">
                Describe any behaviors or characteristics that may attract attention or endanger this person</label>
        <div>
            <div class="col-md-6 form-group">
                <textarea type="text" class="form-control" id="behaviorialhazards" name="behaviorialhazards" 
                    placeholder="" maxlength="150">{{ old( 'behaviorialhazards', $participant->behaviorialhazards) }}</textarea>
                @if ($errors->has('behaviorialhazards'))
                    <span class="help-block">
                        <strong>{{ $errors->first('behaviorialhazards') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-1 form-group">
                <i  title="This will appear on your ID cards." style="color:red; padding-left:5px;" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
            </div>
        </div>
    </div>
    <div class="form-group row {{ $errors->has('otherinfo') ? ' has-error' : '' }}">
        <label for="otherinfo" class="col-md-4 control-label">
                Other important information or suggested accommodations</label>
        <div>
            <div class="col-md-6 form-group">
                <textarea type="text" class="form-control" id="otherinfo" name="otherinfo" 
                    placeholder="" maxlength="300">{{ old( 'otherinfo', $participant->otherinfo) }}</textarea>
                @if ($errors->has('otherinfo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('otherinfo') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="panel-footer">
</div>

<div class="panel-heading" data-toggle="collapse" data-target="#part32" >
    <h3 class="panel-title">Participant's Communication Information<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part32">
    <div class="form-group row {{ $errors->has('primarylang') ? ' has-error' : '' }}">
        <label for="primarylang" class="col-md-4 control-label">
            Primary Language</label>
        <div class="col-md-6 form-group">
            <input type="text"  class="form-control" list="lang" id="primarylang" name="primarylang" 
                placeholder="Choose a primary language" value="{{ old( 'primarylang', $participant->primarylang) }}"/>
            </select>

            @if ($errors->has('primarylang'))
                <span class="help-block">
                    <strong>{{ $errors->first('primarylang') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('secondarylang') ? ' has-error' : '' }}">
        <label for="secondarylang" class="col-md-4 control-label">
            Secondary Language</label>
        <div class="col-md-6 form-group">
            <input type="text"  class="form-control" list="lang" id="secondarylang" name="secondarylang" 
                placeholder="Choose a secondary language" value="{{ old( 'secondarylang', $participant->secondarylang) }}"/>

            @if ($errors->has('secondarylang'))
                <span class="help-block">
                    <strong>{{ $errors->first('secondarylang') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('communicationmethod') ? ' has-error' : '' }}">
        <label for="communicationmethod" class="col-md-4 control-label">
            Special Communication Methods</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="communicationmethod" name="communicationmethod" 
                placeholder="Picture Cards, Sign Language, Written Words, Communication Device, Etc." 
                    value="{{ old( 'communicationmethod', $participant->communicationmethod) }}" maxlength="150" />
            @if ($errors->has('communicationmethod'))
                <span class="help-block">
                    <strong>{{ $errors->first('communicationmethod') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>