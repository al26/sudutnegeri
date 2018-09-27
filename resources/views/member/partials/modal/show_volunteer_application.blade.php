<dl class="row">
    <dt class="col-sm-3">Dari</dt>
    <dd class="col-sm-9">{{$volunteer->user->profile->name}}</dd>

    <dt class="col-sm-3">Kepada</dt>
    <dd class="col-sm-9">{{$volunteer->project->user->profile->name}}</dd>
    
    <dt class="col-sm-3">Subyek</dt>
    <dd class="col-sm-9">{{$volunteer->project->project_name}}</dd>
    
    <dt class="col-12">Apa motivasi Anda untuk menjadi relawan untuk proyek ini ?</dt>
    <dd class="col-12">{{$volunteer->motivation}}</dd>
    
    <dt class="col-12">Yakinkan kami bahwa Anda akan menjadi relawan yang tepat untuk proyek ini !</dt>
    <dd class="col-12">{{$volunteer->eligibility}}</dd>
    
    @foreach($answers as $q)
        <dt class="col-12">{{$q->question->question}}</dt>
        <dd class="col-12">{{$q->answer}}</dd>
    @endforeach
</dl>

{{-- <a href="{{route('volunteer.accept', ['id' => $volunteer->id])}}" class="mbtn btn btn-success btn-sm" onclick="event.preventDefault();
    document.getElementById('form-accept').submit();" target="_blank"><i class='fas fa-check'></i> Terima</a>
<a href="{{route('volunteer.reject', ['id' => $volunteer->id])}}" class="mbtn btn btn-danger btn-sm" onclick="event.preventDefault();
    document.getElementById('form-reject').submit();" target="_blank"><i class='fas fa-times'></i> Tolak</a>

<form id="form-accept" action="{{route('volunteer.accept', ['id' => $volunteer->id])}}" method="POST" style="display: none;">
    @csrf
    @method('PUT')
</form>

<form id="form-reject" action="{{route('volunteer.reject', ['id' => $volunteer->id])}}" method="POST" style="display: none;">
    @csrf
    @method('PUT')
</form> --}}