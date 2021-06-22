@extends('layouts.app')
@section('title', '- FAQs')
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
                <p>Video 1</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
            <h4 class="panel-title">
            	<a href="#" class="ing">View ALL participant profiles - Ability to view any participant profiles</a><i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
        	</h4>
        </div>
        <div id="question1" class="panel-collapse collapse">
            <div class="panel-body">
                <p>
                    zaa

                </p>
            </div>
        </div>
    </div>
    <div class="panel panel-default ">
        <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
             	<h4 class="panel-title">
                <a href="#" class="ing">View ALL participant flyers - Ability to view any participant flyers</a> <i class="fa fa-caret-down pull-right" aria-hidden="true"></i>
          </h4>
        </div>
        <div id="question2" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Video 3.</p>
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