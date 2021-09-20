@php
    /**
    * @var App\Models\ZInquiry $zInquiry
    * @var App\Models\ZPackage $zPackage
    * @var App\Models\ZRoom $zRoom
    */
    $zInquiry = $data['zInquiry'];
    $zPackage = $data['zPackage'];
    $zRoom = $data['zRoom'];
@endphp

<p>Dear {{ $zInquiry->getCustomerName() }},</p>
<p>Warmest greeting from Sealife Group!</p>
<p>Your inquiry is successfully submitted. It was a pleasure of Sealife Group to get your interest in our cruises and
    service. Our sale department will response you within 24 hours of receiving them.</p>
<p>Thank for your inquiry. If you demand for any recommendation or if there is anything else we can do to assist, please
    don't hesitate to ask.</p>
<p>A summary of your enquiry is as follows:</p>
<ul>
    <li>Cruise Package: {{ $zPackage->name }}</li>
    <li>Planned cruise date: {{ $zInquiry->getStartDateDisplay() }}</li>
    <li>Cabin type: {{ $zRoom->name }}</li>
    <li>Number of cabins: {{ $zInquiry->getNumberOfRoomText() }}</li>
    <li>Number of guests: {{ $zInquiry->getNumberOfGuestText() }}</li>
    <li>Estimated Room Rate ({{ $zInquiry->promotion_text }}): {{ $zInquiry->promotion_price }}</li>
    <li>Special offers (if any): {{ implode(" - ", $zPackage->zOffersActive->pluck("name")->toArray()) }}</li>

    @if($transfer = $zInquiry->zTransferActive)
        <li>Transfer service: {{ $transfer->name }}</li>
    @endif

    <li>Contact information: {{ $zInquiry->getContactInformation() }}</li>
    <li>Special request (subject to availability): {{ $zInquiry->special_request }}</li>
</ul>

<p>Sincerely,</p>
<p>Sealife Group.</p>
