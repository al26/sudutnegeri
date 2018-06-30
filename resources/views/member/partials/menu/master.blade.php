<section class="m-leftcard">
    <div class="card">
            @yield('menu')
    </div>
</section>

<section class="m-rightcard" id="mr" data-pjax-container>
    @php
        if (empty($section)) {
            switch ($menu) {
                case 'setting':
                    $section = "profile";
                    break;
                case 'sudut':
                    $section = "campaigns";
                    break;
                case 'negeri':
                    $section = "donations";
                    break;
                default:
                    break;
            }
        } 
    @endphp    
    @include('member.partials.main-content.'.$section)
</section>