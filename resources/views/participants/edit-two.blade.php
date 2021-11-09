<div class="panel-heading" data-toggle="collapse" data-target="#part21">
    <h3 class="panel-title">Participant's Address<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part21">
    <div class="form-group row {{ $errors->has('livealone') ? ' has-error' : '' }}">
        <label for="livealone" class="col-md-4 control-label">
            Does the individual live alone? <font color="red">*</font></label>
        <div class="col-md-8 form-group ml-2">
            <label>
                <input type="radio" value="1" name="livealone" 
                    {{ old("livealone") == "1" ? "checked": ($participant->getOriginal("livealone") == "1" ? "checked":"") }}>
                Yes
            </label>
            <label>
                <input type="radio" value="0" name="livealone" 
                    {{ old("livealone") == "0" ? "checked": ($participant->getOriginal("livealone") == "0" ? "checked":"") }}>
                No
            </label>
            @if ($errors->has('livealone'))
                <span class="help-block">
                    <strong>{{ $errors->first('livealone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row{{ $errors->has('typeofresidence') ? ' has-error' : '' }}">
        <label for="typeofresidence" class="col-md-4 control-label">
            The address is which type of residence? <font color="red">*</font></label>
        <div class="col-md-8 form-group ml-2">
            <label>
                <input type="radio" value="1" name="typeofresidence" 
                    {{ old("typeofresidence") == "1" ? "checked": ($participant->getOriginal("typeofresidence") == "1" ? "checked":"") }}>
                Family Home
            </label>
            <label>
                <input type="radio" value="2" name="typeofresidence" 
                    {{ old("typeofresidence") == "2" ? "checked": ($participant->getOriginal("typeofresidence") == "2" ? "checked":"") }}>
                Group Home
            </label>
            <label>
                <input type="radio" value="3" name="typeofresidence" 
                    {{ old("typeofresidence") == "3" ? "checked": ($participant->getOriginal("typeofresidence") == "3" ? "checked":"") }}>
                Other
            </label>
            @if ($errors->has('typeofresidence'))
                <span class="help-block">
                    <strong>{{ $errors->first('typeofresidence') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('address1') ? ' has-error' : ($errors->has('address2') ? ' has-error' : '') }}">
        <label for="address1" class="col-md-4 control-label">
            Street Address <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="address1" name="address1" 
                placeholder="Number and Street, P.O. Box " value="{{ old( 'address1', $participant->address1) }}" />
            @if ($errors->has('address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
            @endif
        </div>
        <label for="address2" class="col-md-4 control-label"></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="address2" name="address2" 
                placeholder="Apartment, suite, unit, building, floor, etc. " value="{{ old( 'address2', $participant->address2) }}" />
            @if ($errors->has('address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('city') ? ' has-error' : '' }}">
        <label for="city" class="col-md-4 control-label">
            City <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="city" name="city" value="{{ old( 'city', $participant->city) }}" />
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('state') ? ' has-error' : '' }}">
        <label for="state" class="col-md-4 control-label">
            State <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <select name="state" class="form-control" id="state">
                <option selected value="CA">California</option>
            </select>
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('zip') ? ' has-error' : '' }}">
        <label for="zip" class="col-md-4 control-label">
            Zip Code <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="zip" name="zip" value="{{ old( 'zip', $participant->zip) }}" />
            @if ($errors->has('zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('homephone') ? ' has-error' : '' }}">
        <label for="homephone" class="col-md-4 control-label">
            Home Phone <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Must Input At Least One 13 Digit Phone Number"></i></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="homephone" name="homephone" value="{{ old( 'homephone', $participant->homephone) }}" />
            @if ($errors->has('homephone'))
                <span class="help-block">
                    <strong>{{ $errors->first('homephone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('cellphone') ? ' has-error' : '' }}">
        <label for="cellphone" class="col-md-4 control-label">
            Cell Phone <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Must Input At Least One 13 Digit Phone Number"></i></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ old( 'cellphone', $participant->cellphone) }}" />
            @if ($errors->has('cellphone'))
                <span class="help-block">
                    <strong>{{ $errors->first('cellphone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="panel-footer">
</div>

<div class="panel-heading" data-toggle="collapse" data-target="#part22" >
    <h3 class="panel-title">Main Emergency Contact Information<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part22">
    <div class="form-group row {{ $errors->has('eme_relation') ? ' has-error' : '' }}">
        <label for="eme_relation" class="col-md-4 control-label">
            Relationship to Participant <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <select name="eme_relation" class="form-control" id="eme_relation">
                <option disabled selected value> -- Relationship to Participant -- </option>
                <option value="1" {{ old("eme_relation") == "1" ? "selected": ($participant->getOriginal("eme_relation") == "1" ? "selected":"") }}>Parent</option>
                <option value="2" {{ old("eme_relation") == "2" ? "selected": ($participant->getOriginal("eme_relation") == "2" ? "selected":"") }}>Guardian/Caregiver</option>
                <option value="3" {{ old("eme_relation") == "3" ? "selected": ($participant->getOriginal("eme_relation") == "3" ? "selected":"") }}>Spouse</option>
                <option value="4" {{ old("eme_relation") == "4" ? "selected": ($participant->getOriginal("eme_relation") == "4" ? "selected":"") }}>Son/Daughter</option>
                <option value="5" {{ old("eme_relation") == "5" ? "selected": ($participant->getOriginal("eme_relation") == "5" ? "selected":"") }}>Brother/Sister</option>
                <option value="6" {{ old("eme_relation") == "6" ? "selected": ($participant->getOriginal("eme_relation") == "6" ? "selected":"") }}>Other</option>
            </select>
            @if ($errors->has('eme_relation'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_relation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_name') ? ' has-error' : '' }}">
        <label for="eme_name" class="col-md-4 control-label">
            Contact Name <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_name" name="eme_name" value="{{ old( 'eme_name', $participant->eme_name) }}" />
            @if ($errors->has('eme_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_address1') ? ' has-error' : ($errors->has('eme_address2') ? ' has-error' : '') }}">
        <label for="eme_address1" class="col-md-4 control-label">
            Street Address <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_address1" name="eme_address1" 
                placeholder="Number and Street, P.O. Box " value="{{ old( 'eme_address1', $participant->eme_address1) }}" />
            @if ($errors->has('eme_address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_address1') }}</strong>
                </span>
            @endif
        </div>
        <label for="eme_address2" class="col-md-4 control-label"></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_address2" name="eme_address2" 
                placeholder="Apartment, suite, unit, building, floor, etc. " value="{{ old( 'eme_address2', $participant->eme_address2) }}" />
            @if ($errors->has('eme_address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_address2') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_city') ? ' has-error' : '' }}">
        <label for="eme_city" class="col-md-4 control-label">
            City <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_city" name="eme_city" value="{{ old( 'eme_city', $participant->eme_city) }}" />
            @if ($errors->has('eme_city'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_city') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_state') ? ' has-error' : '' }}">
        <label for="eme_state" class="col-md-4 control-label">
            State <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <select name="eme_state" class="form-control"  id="eme_state">
                <option selected value="CA">California</option>
            </select>
            @if ($errors->has('eme_state'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_state') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_zip') ? ' has-error' : '' }}">
        <label for="eme_zip" class="col-md-4 control-label">
            Zip Code <font color="red">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_zip" name="eme_zip" value="{{ old( 'eme_zip', $participant->eme_zip) }}" />
            @if ($errors->has('eme_zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_zip') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_homephone') ? ' has-error' : '' }}">
        <label for="eme_homephone" class="col-md-4 control-label">
            Home Phone <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Must Input At Least One 13 Digit Phone Number"></i></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_homephone" name="eme_homephone" value="{{ old( 'eme_homephone', $participant->eme_homephone) }}" />
            @if ($errors->has('eme_homephone'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_homephone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('eme_cellphone') ? ' has-error' : '' }}">
        <label for="eme_cellphone" class="col-md-4 control-label">
            Cell Phone <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Must Input At Least One 13 Digit Phone Number"></i></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="eme_cellphone" name="eme_cellphone" value="{{ old( 'eme_cellphone', $participant->eme_cellphone) }}" />
            @if ($errors->has('eme_cellphone'))
                <span class="help-block">
                    <strong>{{ $errors->first('eme_cellphone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="panel-footer">
</div>

<div class="panel-heading" data-toggle="collapse" data-target="#part23" >
    <h3 class="panel-title">Alternative Emergency Contact Information<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part23">
    <div class="form-group row {{ $errors->has('alt_eme_relation') ? ' has-error' : '' }}">
        <label for="alt_eme_relation" class="col-md-4 control-label">
            Relationship to Participant <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="If you choose 'None' as a relationship, then no fields below are required."></i></label>
        <div class="col-md-6 form-group">
            <select name="alt_eme_relation" id="alt_eme_relation" class="form-control">
                <option disabled selected value> -- Relationship to Participant -- </option>
                <option value="1" {{ old("alt_eme_relation") == "1" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "1" ? "selected":"") }}>Parent</option>
                <option value="2" {{ old("alt_eme_relation") == "2" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "2" ? "selected":"") }}>Guardian/Caregiver</option>
                <option value="3" {{ old("alt_eme_relation") == "3" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "3" ? "selected":"") }}>Spouse</option>
                <option value="4" {{ old("alt_eme_relation") == "4" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "4" ? "selected":"") }}>Son/Daughter</option>
                <option value="5" {{ old("alt_eme_relation") == "5" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "5" ? "selected":"") }}>Brother/Sister</option>
                <option value="6" {{ old("alt_eme_relation") == "6" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "6" ? "selected":"") }}>Other</option>
                <option value="0" {{ old("alt_eme_relation") == "0" ? "selected": ( $participant->getOriginal("alt_eme_relation") == "0" ? "selected":"") }}>None</option>
            </select>
            @if ($errors->has('alt_eme_relation'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_relation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_name') ? ' has-error' : '' }}">
        <label for="alt_eme_name" class="col-md-4 control-label">
            Contact Name <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_name" name="alt_eme_name" value="{{ old( 'alt_eme_name', $participant->alt_eme_name) }}" />
            @if ($errors->has('alt_eme_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_address1') ? ' has-error' : ($errors->has('alt_eme_address2') ? ' has-error' : '') }}">
        <label for="alt_eme_address1" class="col-md-4 control-label">
            Street Address <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_address1" name="alt_eme_address1" 
                placeholder="Number and Street, P.O. Box " value="{{ old( 'alt_eme_address1', $participant->alt_eme_address1) }}" />
            @if ($errors->has('alt_eme_address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_address1') }}</strong>
                </span>
            @endif
        </div>
        <label for="alt_eme_address2" class="col-md-4 control-label"></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_address2" name="alt_eme_address2" 
                placeholder="Apartment, suite, unit, building, floor, etc. " value="{{ old( 'alt_eme_address2', $participant->alt_eme_address2) }}" />
            @if ($errors->has('alt_eme_address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_address2') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_city') ? ' has-error' : '' }}">
        <label for="alt_eme_city" class="col-md-4 control-label">
            City <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_city" name="alt_eme_city" value="{{ old( 'alt_eme_city', $participant->alt_eme_city) }}" />
            @if ($errors->has('alt_eme_city'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_city') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_state') ? ' has-error' : '' }}">
        <label for="alt_eme_state" class="col-md-4 control-label">
            State <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <select name="alt_eme_state" class="form-control" id="alt_eme_state">
                <option selected value="CA">California</option>
            </select>
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_zip') ? ' has-error' : '' }}">
        <label for="alt_eme_zip" class="col-md-4 control-label">
            Zip Code <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_zip" name="alt_eme_zip" value="{{ old( 'alt_eme_zip', $participant->alt_eme_zip) }}" />
            @if ($errors->has('alt_eme_zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_zip') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_homephone') ? ' has-error' : '' }}">
        <label for="alt_eme_homephone" class="col-md-4 control-label">
            Home Phone <font color="blue">*</font></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_homephone" name="alt_eme_homephone" value="{{ old( 'alt_eme_homephone', $participant->alt_eme_homephone) }}" />
            @if ($errors->has('alt_eme_homephone'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_homephone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alt_eme_cellphone') ? ' has-error' : '' }}">
        <label for="alt_eme_cellphone" class="col-md-4 control-label">
            Cell Phone</label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="alt_eme_cellphone" name="alt_eme_cellphone" value="{{ old( 'alt_eme_cellphone', $participant->alt_eme_cellphone) }}" />
            @if ($errors->has('alt_eme_cellphone'))
                <span class="help-block">
                    <strong>{{ $errors->first('alt_eme_cellphone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>