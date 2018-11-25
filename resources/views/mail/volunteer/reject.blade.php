@component('mail::message')
# Maaf, {{ucwords($volunteer->user->profile->name)}}

Anda belum dapat diterima sebagai relawan proyek {{$volunteer->project->project_name}}.

Selanjutnya Anda bisa mendaftar ke proyek lain.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
