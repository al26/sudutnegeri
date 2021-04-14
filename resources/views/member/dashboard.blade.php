@extends('layouts.app')

@section('content')
{{-- @include('layouts.partials._alert') --}}
<div class="container p-0 px-lg-3">
    <section class="m-topcard mt-lg-3" id="mt" data-pjax-container>
        @include('member.partials.topcard', ['menu' => $menu, 'section' => $section])        
    </section>
    <section class="m-content my-lg-3 clearfix" id="mc" data-pjax-container>
        {{-- <div class="loader-overlay">
            <div class="loader"></div>
        </div> --}}
        @php
            if (empty($menu)) {
                $menu = "overview";   
            }
        @endphp
        @include('member.partials.menu.'.$menu, ['section' => $section, 'menu' => $menu])
    </section>
    {{-- @include('components.modal') --}}
</div>
@endsection
@section('script')
<script>
        // ClassicEditor
        // .create( document.querySelector('.editor') )
        // .then( editor => {
        //     console.log( editor );
        // } )
        // .catch( error => {
        //     console.error( error );
        // } );
</script>
<script src="{{secure_asset('js/member-dashboard.js')}}"></script>
@endsection