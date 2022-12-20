@component('mail::message')
# Hi there,

Someone just traded a gift card that you manage, access your dashboard and process the trade.

@component('mail::button', ['url' => route('admin.trade.index')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
