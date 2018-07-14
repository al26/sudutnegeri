@php
    function pretyDateFormat($date) {
        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Mret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $date = new DateTime($date);
        $date = $date->format('d')." ".$bulan[$date->format('m')]." ".$date->format('Y');

        return $date;
    }
@endphp
<div class="timeline">
    <div class="line text-muted"></div>
    <div class="" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($project->historis as $key => $history)
            <div class="card card-default">
                <div class="card-heading" role="tab" id="heading1">
                    <div class=" icon"><i class="far fa-dot-circle"></i><span class="sr-only">Expand/Collapse</i></div>
                    <p class="card-text"><span class="badge badge-secondary">{{pretyDateFormat($history->created_at)}}</span></p>
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
            <p class="card-text text-capitalize"><span class="badge badge-secondary">{{pretyDateFormat($project->created_at)}}</span></p>
            </div>
            <div class="card-body">
                <h5 class="card-title m-0">Project Dipublikasikan</h5>
            </div>
        </div>
    </div>
</div>