@component('mail::message')

Hello {{ $username }}

@component('mail::button',['url'=> route('getreset-password',$token)])
    Click Here To Reset Your Password
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('getreset-password',$token)}}">{{route('getreset-password',$token)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
