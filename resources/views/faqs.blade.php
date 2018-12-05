@extends('layouts.app')
@section('title', '- FAQs')
@section('content')
<div class="panel-group" id="faqAccordion">
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
            <h4 class="panel-title">
            	<a href="#" class="ing">Is the Special Needs Registry available to residents everywhere?</a> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
          	</h4>
        </div>
        <div id="question0" class="panel-collapse collapse">
            <div class="panel-body">
                <p>The Special Needs Registry is only available to those served by the Santa Clarita Valley Sheriff’s Station. You may live anywhere in the City of Santa Clarita or in the County area in the Santa Clarita Valley. Residents of Castaic, Stevenson Ranch and Fair Oaks Ranch may use the Special Needs Registry as long as their residence is served by the SCV Sheriff’s Station.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
            <h4 class="panel-title">
            	<a href="#" class="ing">Who is eligible to have a Special Needs Registry Form?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question1" class="panel-collapse collapse">
            <div class="panel-body">
                <p>A person of any age, with any kind of special needs or disability, can be registered if they live an area served by the SCV Sheriff's Station. Enroll someone in the Special Needs Registry if the Sheriffs and the person would benefit by having essential medical and contact information available in case of an emergency. For example, you may wish to fill out a Registry Form for someone of any age who might wander away from home and have limited ability to help himself or herself.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
             	<h4 class="panel-title">
                <a href="#" class="ing">Does a person in the registry get special treatment from the Sheriffs?</a> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
          </h4>
        </div>
        <div id="question2" class="panel-collapse collapse">
            <div class="panel-body">
                <p>The Special Needs Registry (SNR) does not promise or imply preferential treatment from the Los Angeles County Sheriff’s Department. The SNR is a tool available to help Sheriffs be prepared and informed in their response to an individual with special needs, to the best of their ability in a given situation. Being part of the SNR has several potential advantages: Sheriffs can get in contact with caregivers quickly, know ways to communicate and relate with the person, and be aware of medical needs. The Sheriffs will already have a picture on file if the person should become lost. They can use SNR information to have an idea of where to look for them.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
            <h4 class="panel-title">
            	<a href="#" class="ing">How is the confidential information I submit protected?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question3" class="panel-collapse collapse">
            <div class="panel-body">
                <p>There is no public access of any kind to the information in the Special Needs Registry. When you create a Registry Form you protect it with your user ID and password. Deputies and their supervisors must use a secure password to access registry information. Trusted project administrators who assist with the database have access to the registry using a secure password.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question4">
            <h4 class="panel-title">
            	<a href="#" class="ing">How do I update the information on the special needs registry form?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question4" class="panel-collapse collapse">
            <div class="panel-body">
                <p>You can add or change information at anytime. Log in at <a href="https://snr.santa-clarita.com/login">snr.santa-clarita.com/login</a> using your user name and password. Pictures of all the people you have registered will appear at the bottom of the page. Click on the EDIT button to see the information you have already entered. Make any needed changes and complete the bottom of the form. Your updates will be recorded instantly in the registry.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question5">
            <h4 class="panel-title">
            	<a href="#" class="ing">How often do I have to update the registry?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question5" class="panel-collapse collapse">
            <div class="panel-body">
                <p>It is important for the sheriffs to have the most current information and photograph. It is a good idea to update the registry form anytime a major change happens (medication, residence, school etc). Update photos at least once every two years. Out-of-date registration forms are removed from the database and destroyed after two years.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question6">
            <h4 class="panel-title">
            	<a href="#" class="ing">Do I have any other responsibilities when using the SNR?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question6" class="panel-collapse collapse">
            <div class="panel-body">
                <p>It is a great idea to let certain people know that the person is in the registry. For example, if you need to call the SCV Sheriff's Station for help, be sure to tell the operator that the person is in the Special Needs Registry (SNR). If you are with the person during an encounter with deputies, be sure to tell deputies that the person is part of the SNR. You can add the notation "Special Needs Registry" at the top of your student's Emergency Cards so that school personnel can notify deputies if need be.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question7">
            <h4 class="panel-title">
            	<a href="#" class="ing">Why does Santa Clarita have a Special Needs Registry and other communities don’t?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question7" class="panel-collapse collapse">
            <div class="panel-body">
                <p>A proactive group of community organizations in Santa Clarita came together to form the CLEAR committee, Community and Law Enforcement Aware Response.</p>
				<p>Santa Clarita has a special needs registry due to the efforts of the CLEAR partners. Our goal is to increase mutual awareness, understanding and communication between first responders and the special needs community. The Special Needs Registry is CLEAR’s primary project.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question8">
            <h4 class="panel-title">
            	<a href="#" class="ing">Who are the CLEAR partners?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question8" class="panel-collapse collapse">
            <div class="panel-body">
                <p>The SCV Special Needs Registry represents a public/private partnership between the City of Santa Clarita, the Santa Clarita Sheriff’s Department, and the CLEAR Collaborative: community members and organizations working together to improve safety. CLEAR stands for Community and Law Enforcement Aware Response.
                </p>
				<p>CLEAR partners include the City of Santa Clarita, Los Angeles County Sheriff’s Department, SCV Sheriff’s Foundation, North Los Angeles County Regional Center, Los Angeles County Fire Department, SCV Senior Center, The SCV SELPA, BE SAFE The Movie, and the Family Focus Resource Center.
				</p>
				<p>
				 Other organizations and individuals are invited to join CLEAR and support our efforts. For questions about the CLEAR collaborative contact Emily Iland, Project Manager, at {{config('app.adminPhone')}}, email <a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a> or visit <a target="_blank" href="http://www.CLEARscv.org">www.CLEARscv.org</a>
				 </p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question9">
            <h4 class="panel-title">
            	<a href="#" class="ing">What if I can’t fill out a registration form online?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question9" class="panel-collapse collapse">
            <div class="panel-body">

            	<p> For help registering an individual or using the registry form, please contact Family Focus Resource Center at {{config('app.familyFocusPhone')}} or email <u><a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a></u>
            	</p>
            	<p> If you are unable to complete the online version of the the registry form, please visit the Resources page at <u><a target="_blank" href="http://www.CLEARscv.org">www.CLEARscv.org</a></u> where you can access a printable version of the Special Needs Registry Form ("SNR Print & Write") or a form you can type and print out.  You can print either of these forms, attach a photo, and mail it to the address below. Your registration information and photo will be entered in the secure database for you.
            	</p>
            	<p>
            	where you can access a printable version of the Special Needs Registry Form (“SNR Print & Write”) or a form you can type and print out.  You can print either of these forms, attach a photo, and mail it to the address below. Your registration information and photo will be entered in the secure database for you.
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
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-parent="#faqAccordion" data-target="#question10" data-toggle="collapse">
            <h4 class="panel-title">
            	<a href="#" class="ing">¿Que hago si necesito ayuda de alguien de habla hispana?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question10" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Si habla español y necesita ayuda con el formulario del Registro de Necesidades Especiales, favor de contactarse con Family Focus Resource Center, <u>{{config('app.familyFocusPhone')}}</u>.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-parent="#faqAccordion" data-target="#question11" data-toggle="collapse">
            <h4 class="panel-title">
            	<a href="#" class="ing">What if I can't upload the photograph?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question11" class="panel-collapse collapse">
            <div class="panel-body">
                <p>For assistance with this please contact Family Focus Resource Center, <u>{{config('app.familyFocusPhone')}}</u> or email <u><a href="mailto:{{config('app.adminEmail')}}">{{config('app.adminEmail')}}</a></u>.
                </p>
				<p>You can also mail the photograph to the project administrator. Be sure to include the name of the person in the picture. Address the envelope like this:</p>
				Family Focus Resource Center<br>
				Attention SNR<br>
				25360 Magic Mountain Parkway, Suite 150<br>
				Santa Clarita, CA 91355<br>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-parent="#faqAccordion" data-target="#question12" data-toggle="collapse">
            <h4 class="panel-title">
            	<a href="#" class="ing">What is the Special Needs Registry Identification Card?</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question12" class="panel-collapse collapse">
            <div class="panel-body">
                <p>The Special Needs Registry Identification Card helps the sheriffs know who is in the registry. The card includes identifying and behavior information and main emergency contact. You can print out as many copies of the ID card as you need by logging into your registry account and clicking on the "ID" link for the individual.
                </p>
                <p>Carry one card with you. In case of emergency, let first responders know that the person is in the registry and that you are carrying an SNR ID. If the person with special needs carries Registry ID Card, teach them to ask permission before reaching into a pocket to get it out.
                </p>
            </div>
        </div>
    </div>

    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-parent="#faqAccordion" data-target="#question13" data-toggle="collapse">
            <h4 class="panel-title">
            	<a href="#" class="ing">Updated ID Cards</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question13" class="panel-collapse collapse">
            <div class="panel-body">
				<p>The information on the SNR ID card is based on the individual's SNR registration. If you want to change information on the card, first update the registry profile, then print new cards. Be sure to print new IDs whenever you update any important profile information.
				</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-parent="#faqAccordion" data-target="#question14" data-toggle="collapse">
            <h4 class="panel-title">
            	<a href="#" class="ing">Submissions</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question14" class="panel-collapse collapse">
            <div class="panel-body">
                <p>All Registry Form submissions are reviewed by the site administrators. Submissions that are not authentic will be deleted.</p>
            </div>
        </div>
    </div>
</div>
@endsection