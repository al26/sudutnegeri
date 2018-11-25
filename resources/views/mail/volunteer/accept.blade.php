@component('mail::message')
# Selamat, {{ucwords($volunteer->user->profile->name)}}

Anda diterima sebagai relawan proyek {{$volunteer->project->project_name}}.

Kini Anda dapat berkontribusi untuk menuliskan data historis proyek di <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}">sini</a>.

Informasi tambahan dan hal-hal lain mengenai kegiatan kerelawanan akan diinformasikan dan ditangani langsung oleh pemilik proyek.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
