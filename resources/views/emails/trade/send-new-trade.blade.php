@component('mail::message')
# Hi there,

You have a new trade with reference <strong>{{$trade->reference}}</strong> from  <strong>{{$trade->user->name}}.</strong>.  Log into your dashboard to process the trade.


@component('mail::button', ['url' => route('admin.trade.index')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
