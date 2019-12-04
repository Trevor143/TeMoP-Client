@component('mail::message')
# Your bid has been updated

Your bid for the tender : <strong>{{$bid->tender->name}}</strong> has been successfully updated.

You can still edit it before <strong class="text-red">{{$bid->tender->deadline->isoFormat('dddd, D MMMM, Y')}}</strong>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
