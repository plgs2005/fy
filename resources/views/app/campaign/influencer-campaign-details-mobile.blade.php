<div
class="modal fade campaign-modal"
id="campaign-{{$campaign->id}}-detail-mobile"
data-backdrop="static"
data-keyboard="false"
tabindex="-1"
aria-hidden="true"
style="overflow: auto;"
>
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-body">
    <nav
        class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top pt-2"
    >
        <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
            <div
                id="container-navbar-mobile"
                class="bookmark-wrapper d-flex align-items-center w-100"
            >
                <a id="btn-back-active-campaigns" campaign_id="{{$campaign->id}}">
                <svg
                    width="25"
                    height="22"
                    viewBox="0 0 25 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="btn-arrow-back m-0"
                >
                    <path
                    d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z"
                    fill="#010D33"
                    />
                </svg>
                </a>
                <p
                id="dashboard-header-title-menu-withdraw"
                class="title mb-0"
                style="font-size: 20px"
                >
                Active campaigns
                </p>
                <div style="width: 25px"></div>
            </div>
            </div>
        </div>
        </div>
        <hr
        class="m-0 mt-auto w-100 d-block d-sm-none"
        style="
            height: 2px;
            background: #033fff;
            border-radius: 0px 5px 5px 0px;
        "
        />
    </nav>
    <div class="mt-2">
        <div id="campaign-{{$campaign->id}}-detail-mobile" class="guide-campaigns-details">
            <div class="row align-items-center">
                <div class="col-xl-12 col-md-4 col-sm-6 p-0">
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="mr-50">
                                <img src="../assets/images/icon-nike.png" class="img-fluid">                
                            </div>
                            <div>
                                <p class="title mb-0" style="font-size: 15px;">{{$campaign->name}}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"></path>
                                <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"></path>
                                <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"></path>
                            </svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"></path>
                            </svg>
                        </div>
                    </div>
                </div>
    
            </div>
        
            @if ($campaign->status() != 'scheduled')
            <div class="row">
                <div class="col-xl-12 col-md-4 col-sm-6 p-0">
                    <div class="card card-campaign-active-detail mb-0">
                        <div class="card-body" style="position: relative;">
                            <div class="btn-group btn-group-toggle ml-2 mb-1" data-toggle="buttons">
                                {{-- <label class="btn btn-toggle-location btn-toggle-impressions active" onchange="loadChartsImpressionsAndClicks('#campaign-{{$campaign->id}}-detail-mobile')">
                                    <input type="radio" name="options" id="toggle-impressions" checked="">
                                    <div>impressions</div> 
                                </label> --}}
                                <label class="btn btn-toggle-location btn-toggle-clicks" id="campaign-{{$campaign->id}}-chart-clicks" campaign_id="{{$campaign->id}}">
                                    <input type="radio" name="options" id="toggle-clicks" checked="">
                                    <div>clicks</div> 
                                </label>
                            </div>
                            {{-- <div id="chart-campaign-active-{{$campaign->id}}-impressions" class="chart chart-campaign-active chart-campaign-impressions"></div> --}}
                            <div id="chart-campaign-active-{{$campaign->id}}-clicks" class="chart chart-campaign-active chart-campaign-clicks"></div>
                            <div class="d-flex justify-content-around text-center">
                                <div>
                                    <h2 class="mb-0">{{thousandsFormat($campaign->impressions)}}</h2>
                                    <p class="mb-50">impressions</p>
                                </div>
                                <div>
                                    <h2 class="mb-0">{{thousandsFormat($clicksData['clicks'])}}</h2>
                                    <p class="mb-50">clicks</p>
                                </div>
                                <div>
                                    <h2 class="mb-0">{{engagementPercent($campaign->impressions, $campaign->engagement)}}</h2>
                                    <p class="mb-50">engagement</p>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($campaign->status() == 'active')
            <div class="row mt-2 mb-2">
                <div class="col-xl-12 col-md-4 col-sm-6 p-0 d-flex align-items-center">
                    <div style="width: 70%;">
                        @if($can_add_posts)
                        <button id="btn-add-links-jobs" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center" style="width: 100%; height: 40px; white-space: nowrap;">
                            <span style="margin-top: 2px;">Select campaign posts</span>
                        </button>
                        @endif
                    </div>
                    <div class="d-flex align-items-center" style="width: 30%">
                        <a href="#" class="ml-auto" style="text-decoration: underline;">learn more</a>
                    </div>
                </div>
            </div>
            @endif
        
            <div class="row mt-1">
        
                <div class="col-xl-12 col-md-4 col-sm-6 p-0">
                    <div class="card mb-0">
                        <div class="card-body">
                            <p class="p-500 red-hat-text mb-0" style="font-size: 15px">Payment method</p>
                            @if($campaign->type == 'paid')
                                <p class="mb-2">Cash</p>
                            @else
                                <p class="mb-2">Product</p>
                            @endif
        
                            <p class="p-500 red-hat-text mb-0" style="font-size: 15px">What product / service will the brand give me?</p>
                            <p>{{$campaign->produc_description}}</p>
        
                            <div class="d-flex flex-wrap">
                                @php
                                    $images = json_decode($campaign->product_images);
                                @endphp
                                @if (!empty($images))
                                    @foreach ($images as $img)
                                        <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="img-active-campaign mb-1 mr-1 rounded" width="94" height="94"></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-2 mt-2">
                <div class="col-xl-12 col-md-4 col-sm-6 p-0">
                    <div>
                        <p class="title mb-0" style="font-size: 15px;">Campaign details</p>
                    </div>
                </div>
            </div>

                        
            <div id="campaign-details-mobile" class="row mb-2">
                <div class="col-xl-12 col-md-4 col-sm-6 p-0">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div>
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">Campaign Duration</p>
    
                                <div class="progress mb-50">
                                    <div class="progress-bar" style="width: 60%;"></div>
                                </div> 
                    
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <p>{{$campaign->starts(true)}}</p>
                                    </div>
                                    <div>
                                        <p>{{$campaign->ends(true)}}</p>                                 
                                    </div>
                                </div>
        
                                <div class="d-flex">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Where</p>
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
                                </div>
        
                                <div class="d-flex">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Format</p>
                                    <p>{{ucfirst($campaign->format)}}</p>
                                </div>
        
                                <div class="d-flex">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Type</p>
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
                                </div>
        
                                <div class="d-flex">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">What look/feel/style</p>
                                    <p>{{ ucfirst($campaign->style) }}</p>
                                </div>
                            </div>
    
                            <div>
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">What is your brand goal with this campaign?</p>
                                <p>{{$campaign->goal_description}}</p>
    
                                <div class="d-flex flex-wrap">
                                    @php
                                        $images = json_decode($campaign->goal_images);
                                    @endphp
                                    @if (!empty($images))
                                        @foreach ($images as $img)
                                            <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="img-active-campaign mb-1 mr-1 rounded" style="box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.1);" width="94" height="94"></a>
                                        @endforeach
                                    @endif
                                </div>
    
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">URL you want influencers to send their followers to:</p>
                                <a href="{{$campaign->pivot->tracking_link_url}}" target="_blank" style="text-decoration: underline;">{{$campaign->pivot->tracking_link_url}}</a>
    
                                <div class="d-flex mt-1">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Specific instructions:</p>
                                    <p>{{$campaign->instructions}}</p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    @php
                                        $images = json_decode($campaign->instruction_images);
                                    @endphp
                                    @if (!empty($images))
                                        @foreach ($images as $img)
                                            <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="img-active-campaign mb-1 mr-1 rounded" style="box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.1);" width="94" height="94"></a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    </div>
</div>
</div>
</div>

<script>
@if ($campaign->status() != 'scheduled' AND isset($clicksData['chartData']))
var chartOptions = {
    chart: {
    height: 280,
    type: "area",
    toolbar: {
        show: false
    }
    },
    colors: ["#033FFF"],
    dataLabels: {
    enabled: true
    },
    series: [
    {
        name: "Clicks",
        data: [
            @foreach ($clicksData['chartData'] as $data)
            "{{$data}}",
            @endforeach
        ] 
    }
    ],
    fill: {
    type: "gradient",
    gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        stops: [0, 90, 100]
    }
    },
    grid: {
    show: false
    },
    xaxis: {
    categories: [
        @foreach ($clicksData['chartData'] as $key=>$data)
            "{{$key}}",
        @endforeach
    ]
    },
};

var chart = new ApexCharts(document.querySelector('#chart-campaign-active-{{$campaign->id}}-clicks'), chartOptions);
chart.render();
@endif

$('#btn-back-active-campaigns').click(function() {
    var campaignId = $(this).attr('campaign_id');
    $('#campaign-'+campaignId+'-detail-mobile').modal('toggle')
});

$('#btn-add-links-jobs').click(function() {
    $("#modal-select-post-body").load('/influencer-campaign-posts/{{$campaign->id}}');
    $('#modal-select-post').modal({keyboard: true});
});

</script>