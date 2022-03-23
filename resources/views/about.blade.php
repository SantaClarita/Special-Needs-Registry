@extends('layouts.app')

@section('content')
@if(Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('status') }}</strong>
    </div>
@endif
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading clearfix" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <span role="button" data-toggle="collapse" href="#collapse-0" aria-expanded="true" aria-controls="collapse-0">
                    <div>
                        Special Needs Registry <br>
                        <i>A partnership with the Community and Law Enforcement Aware Response (CLEAR) Initiative</i>
                    </div>
                </span>
            </h4>
        </div>
        <div id="collapse-0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <div class="">
                    <p><img class="img-responsive" src="{{ url('images/people2.jpg') }}" width="412" height="226" style="float:left;padding-right:10px;"></p>
                    <p>The Special Needs Registry is a free, secure safety tool that helps Santa Clarita Sheriffs recognize and respond to people with special needs. 
                    The Special Needs Registry (SNR) is maintained by the City of Santa Clarita in conjunction with the Santa Clarita Sheriff’s Department.</p>
                    <p>SVC residents are invited to proactively provide information about a loved one with special needs of any age, who may require special 
                    assistance in an emergency or interaction with first responders. Deputies can access the information in the secure database when needed to 
                    assist residents with special needs.</p>
                    <br>
                    <p>When families or caregivers voluntarily register an individuals with special needs in the SNR deputies will:
                    <br>1. Have a photograph, description and contact information for the person with special needs
                    <br>2. Have information needed to find those who wander away from home or get lost
                    <br>3. Be aware of special medical, safety and behavioral concerns of individuals with disabilities or medical conditions
                    <br>4. Be aware of accommodations that may be needed in interacting with the person.
                </p>
                <p>
                    <img class="img-responsive" src="{{ url('images/people1.jpg') }}" width="412" height="226" style="float:right">
                </p>
                <p>Parents and caregivers may enroll a person of any age with any type of medical condition or disability, including but not limited to: Autism, 
                    Spectrum Disorder, Alzheimer’s or Dementia, Bipolar Disorder, Down Syndrome, Epilepsy. Adults with special needs may also enroll themselves 
                    to provide important information in case of emergency.</p>
                <p><a href="{{ url('/register') }}">Start by registering a account!</a></p>
                </div>
            </div>
        </div>

        <div class="panel-heading clearfix" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <span role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                    <div>
                        Who Has Access To The Information?
                    </div>
                </span>
            </h4>
        </div>
        <div id="collapse-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <p>The secure information you provide will be instantly available to authorized members of the Sheriff's department for use in an emergency. It is visible only to you, the Sheriffs and the program administrators.</p>
            </div>
        </div>

        <div class="panel-heading clearfix" role="tab" id="headingFour">
            <h4 class="panel-title">
                <span role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="true" aria-controls="collapse-1">
                    <div>
                        What if I can’t fill out a registration form online?
                    </div>
                </span>
            </h4>
        </div>
        <div id="collapse-3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <p> For help registering an individual or using the registry form, please contact Family Focus Resource Center at {{config('app.familyFocusPhone')}} or email <u><a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a></u>
            	</p>
            	<p> If you are unable to complete the online version of the the registry form, <u><a target="_blank" href="{{ url('/documents/SNRSCV_printfill.pdf') }}">download the form instead</a></u>.  You can print this form, attach a photo, and mail it to the address below. Your registration information and photo will be entered in the secure database for you.
            	</p>
            	<p>To mail in the completed SNR form, address the envelope like this:
            	</p>
            	<p>
            		Family Focus Resource Center</br>
					Attention SNR</br>
					25360 Magic Mountain Parkway, Suite 150</br>
					Santa Clarita, CA 91355
            	</p>
            </div>
        </div>

        <div class="panel-heading clearfix" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <span role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                    <div>
                        Terms of Use
                    </div>
                </span>
            </h4>
        </div>
        <div id="collapse-2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <p>Parents or caregivers who register a family member and adults who register themselves in the Santa Clarita Special Needs Registry authorize
                 the release of the personal information to the Los Angeles County Sheriff’s Department. Santa Clarita Station personnel may use the information 
                 to help identify and assist the individual during an emergency or other encounter with first responders. Participation in the Special Needs 
                 Registry is voluntary and does not guarantee any special treatment. Parents, caregivers and adults who register themselves are responsible for 
                 the accuracy of the information and for updating the information when it changes or annually. Registrations will be removed and destroyed if not 
                 updated after two years.</p>
            </div>
        </div>
    </div>
</div>
@endsection
