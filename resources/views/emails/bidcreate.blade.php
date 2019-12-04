@component('mail::message')
# Your bid has been recived

Your bid for the tender : <strong>{{$bid->tender->name}}</strong> has been successfully received.
You can still edit it before <strong>{{$bid->tender->deadline->isoFormat('dddd, D MMMM, Y')}}</strong>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
