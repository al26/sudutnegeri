<div id="faq-accordion">
    @for ($i = 1; $i < 6; $i++)
        <div class="card">
        <div class="card-header collapsed" role="button" data-toggle="collapse" data-target="#faq{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}" id="q{{$i}}">
                <h5 class="mb-0"> Question {{$i}}
                    <i class="more-less fas fa-chevron-up float-right" aria-hidden="true"></i>
                </h5>
            </div>
        
            <div id="faq{{$i}}" class="collapse" data-parent="#faq-accordion" aria-labelledby="q{{$i}}">
                <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
    @endfor
</div>