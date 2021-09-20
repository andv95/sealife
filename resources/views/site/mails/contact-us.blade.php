@php
    /**
    * @var App\Models\ZContact $zContact
    */
    $zContact = $data['zContact'];
@endphp

<p>Dear Mr./Ms. {{ $zContact->getFullName() }},</p>
<p>Warmest greeting from Sealife Group!</p>
<p>Thank you for your interest in our service.</p>
<p>If you have any question or need more details, we are always ready to provide.</p>
<p><strong>Our Sale Department’s email</strong>: sales@sealifegroup.com</p>
<p><strong>Hotline</strong>: 0936 995 636 - 0934 367 168</p>
<p>A summary of your enquiry is as follows:</p>
<ul>
    <li>Contact information: {{ $zContact->getContactInformation() }}</li>
    <li>Planned travel date (if any): {{ $zContact->looking_for }}</li>
    <li>Interested cruise option: {{ $zContact->interested_in }}</li>
    <li>Message (if any): {{ $zContact->something_else }}</li>
</ul>
<p>Sincerely,</p>
<p>Sealife Group.</p>
