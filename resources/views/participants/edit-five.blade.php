<div class="panel-heading" data-toggle="collapse" data-target="#part5">
    <h3 class="panel-title">Preparer's Name and Authorization<i class="fa fa-caret-down pull-right" aria-hidden="true"></i></h3>
</div>

<div class="collapse in panel-body" id="part5">
    <div class="form-group row {{ $errors->has('digitalsig') ? ' has-error' : '' }}">
        <label for="digitalsig" class="col-md-4 control-label">
            Digital Signature - Preparer's Name <i style="color:red" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Name of person responsible for filling the form"></i></label>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" id="digitalsig" name="digitalsig" value="{{ old( 'digitalsig', $participant->digitalsig) }}" />
            @if ($errors->has('digitalsig'))
                <span class="help-block">
                    <strong>{{ $errors->first('digitalsig') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row {{ $errors->has('authorize') ? ' has-error' : '' }}">
        <label for="authorize" class="col-md-4 control-label">
            Authorize Release of Information <font color="red">*</font></label>
        <div class="col-md-8 col-md-offset-4 checkbox">
            <label class="col-md-8"><input type="checkbox" name="authorize" value="1"><b>Yes — I authorize the release of this information to Sheriff 
                    Department personnel for official use to help identify and assist me, my family member, ward or 
                    client during an emergency. It may also be used by CLEAR representatives for administrative 
                    purposes. I understand that completion of this form is voluntary and does not guarantee any special 
                    treatment. I acknowledge that I am responsible for the accuracy of the information and for updating 
                    the information when it changes or annually, and that it will be removed and destroyed if not 
                    updated after two years.</b></label>
        </div>
        <div class="col-md-8 col-md-offset-4">
            @if ($errors->has('authorize'))
                <span class="help-block">
                    <strong>{{ $errors->first('authorize') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>