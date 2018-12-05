@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <a href="{{ url('/dependents/create') }}"><button class="btn btn-default btn-primary"><i class="glyphicon glyphicon-plus"></i> Add a Dependent </button></a>
         </div>
    </div>
</div>
@endsection