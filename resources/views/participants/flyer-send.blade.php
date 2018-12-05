<div class="modal fade" id="confirm-email-flyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Email Flyer</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to send a mass email flyer.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            <form action="{{ url('/participants/flyer/'.$participant->id) }}" method="POST">
            {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="confirm-email-flyer" onclick="myFunction()" id="emailButton" class="btn btn-success">
                            <i class="fa fa-envelope"></i> Yes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>