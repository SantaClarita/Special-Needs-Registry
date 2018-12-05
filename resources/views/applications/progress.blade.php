@if ($participant->status == 0)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
        0%
    </div>
</div>
@endif
@if ($participant->status == 1)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 20%;">
        20%
    </div>
</div>
@endif
@if ($participant->status == 2)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 40%;">
        40%
    </div>
</div>
@endif
@if ($participant->status == 3)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 60%;">
        60%
    </div>
</div>
@endif
@if ($participant->status == 4)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 80%;">
        80%
    </div>
</div>
@endif
@if ($participant->status == 5)
<div class="progress center-block" style="width:96.5%">
    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 100%;">
        100%
    </div>
</div>
@endif