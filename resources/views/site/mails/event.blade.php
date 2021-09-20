@php
    /**
    * @var App\Models\ZEvent $zEvent
    */
    $zEvent = $data['zEvent'];
@endphp

<p>Dear valued client,</p>
<p>Warmest greeting from Sealife Group!</p>
<p>Your inquiry of mice and charter service is successfully submitted. We truly appreciate your email asking for
    information about our service.</p>
<p>Our sale department will response you within 24 hours of receiving your request.</p>
<p>Thank you for your time and your consideration. We look forward to hearing from you soon. </p>
<p><strong>Our Sale Department’s email</strong>: sales@sealifegroup.com</p>
<p><strong>Hotline</strong>: 0936 995 636 - 0934 367 168</p>
<p>A summary of your enquiry is as follows:</p>
<ul>
    <li>Contact information: {{ $zEvent->email }}</li>
    <li>Purpose: {{ $zEvent->service }}</li>
    <li>Estimated group size: {{ $zEvent->group_size }}</li>
    <li>Event details: {{ $zEvent->event_detail }}</li>
</ul>
<p>Sincerely,</p>
<p>Sealife Group.</p>
