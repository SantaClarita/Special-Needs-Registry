<div class="modal fade" id="confirm-restore-part-{{$participant->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Restore</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to restore a registered participant.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            <form action="{{ url('/participants/restore/'.$participant->id) }}" method="POST">
            {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="restore-participant-{{ $participant->id }}" class="btn btn-success">
                            <i class="fa fa-btn fa-trash"></i>Yes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>