<div class="timeline">
    <div class="line text-muted"></div>
    <div class="" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($project->historis as $key => $history)
            <div class="card card-default">
                <div class="card-heading" role="tab" id="heading1">
                    <div class=" icon"><i class="far fa-dot-circle"></i><span class="sr-only">Expand/Collapse</i></div>
                    <p class="card-text"><span class="badge badge-secondary">{{Idnme::print_date($history->created_at)}}</span></p>
                </div>
                <div class="card-body p-0 pt-2">
                    <div class="timeline-article">
                        <h5 class="card-title" id="timeline-heading{{$history->id}}"><a class="text-default decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$history->id}}" aria-expanded="true" aria-controls="collapse{{$history->id}}">{{$history->title}}</a></h5>
                        <div id="collapse{{$history->id}}" class="card-collapse collapse in" role="tabpanel" aria-labelledby="timeline-heading{{$history->id}}">
                            {!! $history->body !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="card card-default">
            <div class="card-heading" role="tab" id="heading1">
                <div class=" icon"><i class="far fa-dot-circle"></i></div>
            <p class="card-text text-capitalize"><span class="badge badge-secondary">{{Idnme::print_date($project->created_at)}}</span></p>
            </div>
            <div class="card-body">
                <h5 class="card-title m-0">Project Dipublikasikan</h5>
            </div>
        </div>
    </div>
</div>