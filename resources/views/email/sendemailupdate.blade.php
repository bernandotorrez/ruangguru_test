@component('mail::message')

Hallo <strong>{{ $data->contact_person }}</strong>,

Your Submission progress has been updated to :
@if ($data->status_submission == 'Dlv')
Delivery

<br>
Pleas wait at home and we're will Deliver your prizes to :

<br>
<br>
{{ $data->delivery_address }}

@elseif ($data->status_submission == 'Rjt')
Rejected

<br>
and Apologize we won't progress your Submission Further.
@endif

<br>
<br>

Thanks,<br>
Ruangguru Marketing Campaign
@endcomponent
