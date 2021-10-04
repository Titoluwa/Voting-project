@component('mail::message')
# Candidate Registration

<p><b>Confirmation</b></p>
<p>You (<i>{{ $matricno }}</i>) have just registered to run as a candidate for <b>office</b> for this year's election process.</p>

<p>The date for the election will be communicated on the website</p> 

@component('mail::button', ['url' => ''])
Go to website
@endcomponent

Thanks,<br>
Votingg App
@endcomponent