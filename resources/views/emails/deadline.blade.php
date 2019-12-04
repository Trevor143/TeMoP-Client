@component('mail::message')
# Tender deadline has passed.

You placed a bid on the <strong>{{$tender->name}}</strong> tender.
Your bid has been received. You can no longer edit your bid.

You will be notified soon on the next course of action.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
