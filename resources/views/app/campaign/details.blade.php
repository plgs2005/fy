<div class="modal-header">
    <div class="d-flex">
        <i class="bx bx-paper-plane title pr-50" style="font-size: 20px;"></i>
        <p class="title mb-0" style="font-size: 20px;">Campaign Details</p>
    </div>
    <button type="button" id="btn-close-modal-campaign-details" class="close" data-dismiss="modal" aria-label="Close" style="
    width: auto;">
        <span aria-hidden="true" class="title">×</span>
    </button>
</div>
<div class="modal-body">
    <p class="pt-1" style="font-size: 18px; font-weight: 500;">{{$campaign->name}}</p>

    <div class="card card-body">
        <p class="title mb-0" style="font-size: 15px;">1. Type of campaign</p>
        <p class="mb-0">@if($campaign->type == 'paid') Paid campaign @elseif ($campaign->type == 'trade') Trade Campaign @endif</p>
    </div>

    <div class="card card-body">
        <p class="title mb-0" style="font-size: 15px;">2. Goal</p>
        <p>{{ucfirst($campaign->goal)}}</p>
    </div>

    <div class="card card-body">
        <p class="title mb-0" style="font-size: 15px;">3. Audience</p>

        <p class="mb-0" style="color: #010D33;">Category</p>
        <p>{{$campaign->audience->category->name}}</p>

        <p class="mb-0" style="color: #010D33;">Work it</p>
        <p>@if($campaign->audience->influencer_size == 'medium') Medium-sized influencers @elseif ($campaign->audience->influencer_size == 'micro') Micro influencers @endif</p>

        <p class="mb-0" style="color: #010D33;">Gender</p>
        <p>@if($campaign->audience->audience_gender == 'f') Feminine @elseif($campaign->audience->audience_gender == 'm') Masculine @endif {{$campaign->audience->audience_age}} years</p>

        <p class="mb-0" style="color: #010D33;">Location</p>
        <p class="mb-0">United States</p>

        <p class="mb-0" style="color: #010D33;">Language</p>
        <p>English</p>
    </div>

    <div class="card card-body">
        <p class="title mb-0" style="font-size: 15px;">4. Format</p>
        <p class="mb-0" style="color: #010D33;">Where</p>
        @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
            <p>Instagram & Facebook</p>
        @else
            @if ($campaign->social_platform_instagram)
                <p>Instagram</p>
            @endif
            @if ($campaign->social_platform_facebook)
                <p>Facebook</p>
            @endif
        @endif

        <p class="mb-0" style="color: #010D33;">Format</p>
        <p>{{ucfirst($campaign->format)}}</p>

        <p class="mb-0" style="color: #010D33;">Type</p>
        @if ($campaign->format_type_feed AND $campaign->format_type_story)
        <p>Feed & Stories</p>
        @else
            @if ($campaign->format_type_feed)
                <p>Feed</p>
            @endif
            @if ($campaign->format_type_story)
                <p>Stories</p>
            @endif
        @endif

        <p class="mb-0" style="color: #010D33;">What look/feel/style</p>
        <p>{{ucfirst($campaign->style)}}</p>

    </div>

</div>