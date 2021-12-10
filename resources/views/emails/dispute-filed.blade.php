@component('mail::message')
# Dispute Filed

The Dispute is filed against you!.

@component('mail::button', ['url' => $url])
Redirect
@endcomponent

Thanks,<br>
Bluefreelancer
@endcomponent