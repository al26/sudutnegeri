<section class="m-leftcard">
    <div class="card">
        @yield('menu')
    </div>
</section>

<section class="m-rightcard pt-lg-0 {{$menu !== 'overview' ? 'pt-5' : ''}}" id="mr" data-pjax-container>
    @php
        if (empty($section)) {
            switch ($menu) {
                case 'setting':
                    $section = "profile";
                    break;
                case 'sudut':
                    $section = "projects";
                    break;
                case 'negeri':
                    $section = "donations";
                    break;
                default:
                    $section = "overview";
                    break;
            }
        } 
    @endphp    
    @include('member.partials.main-content.'.$section)
</section>