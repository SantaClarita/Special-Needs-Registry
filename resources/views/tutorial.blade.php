@extends('layouts.app')
@section('title', '- Tutorial')
@section('content')
<div class="panel-group" id="faqAccordion">
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
            <h4 class="panel-title">
            	<a href="#" class="ing">Search Participants - Ability to perform searches for participants</a> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
          	</h4>
        </div>
        <div id="question0" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('video/tutorial.mp4')}}"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
            <h4 class="panel-title">
            	<a href="#" class="ing">View profiles - Ability to view any profiles</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question1" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#337ab7;">
                        <h3 class="panel-title">Click on the Profile Button</h3>
                    </div>
                    <img class="img-responsive" src="{{asset('images/profile_button.png')}}" alt="...">
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
             	<h4 class="panel-title">
                <a href="#" class="ing">View and generate flyers - Ability to view and generate any flyers</a> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
          </h4>
        </div>
        <div id="question2" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#337ab7;">
                        <h3 class="panel-title">First Click on the Flyer Button</h3>
                    </div>
                    <img class="img-responsive" src="{{asset('images/flyer_button.png')}}" alt="...">
                </div>
                 <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:#337ab7;">Then Click on the Generate Flyer Button. This will create a PDF version of the flyer where you can download.</div>
                    <img class="img-responsive" src="{{asset('images/generate_flyer_button.png')}}" alt="...">
                </div>
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
</div>
@endsection