<div id="campaign-{{$campaign->id}}-detail" class="mt-2 guide-campaigns-details d-none">
    <div class="row align-items-center">
        <div class="col-xl-8">
            <div class="d-flex mb-1">
                <div class="d-flex align-items-center mr-2">
                    <div class="mr-1">
                        <img src="../assets/images/icon-nike.png" class="img-fluid">                
                    </div>
                    <div>
                        <p class="title p-500 mb-0" style="font-size: 25px;">{{$campaign->name}}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                        <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                        <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="d-flex justify-content-between mb-1">
                <div class="d-flex align-items-center">
                    <div class="mr-1">
                        <p class="title p-500 mb-0" style="font-size: 25px;">Campaign posts</p>
                    </div>
                    <div>
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.1124 10.8225C9.19819 9.73673 11.0919 9.73673 12.1777 10.8225L12.8552 11.5001L14.2103 10.145L13.5327 9.46743C12.629 8.56277 11.4254 8.06348 10.145 8.06348C8.86469 8.06348 7.66103 8.56277 6.75732 9.46743L4.72373 11.5001C3.82702 12.3997 3.32349 13.6181 3.32349 14.8882C3.32349 16.1584 3.82702 17.3768 4.72373 18.2764C5.16828 18.7216 5.69641 19.0746 6.27778 19.315C6.85916 19.5555 7.48231 19.6787 8.11144 19.6775C8.74074 19.6788 9.36409 19.5557 9.94565 19.3153C10.5272 19.0748 11.0555 18.7218 11.5001 18.2764L12.1777 17.5989L10.8226 16.2438L10.145 16.9214C9.60498 17.459 8.87396 17.7608 8.11192 17.7608C7.34988 17.7608 6.61887 17.459 6.07882 16.9214C5.54072 16.3815 5.23856 15.6504 5.23856 14.8882C5.23856 14.1261 5.54072 13.3949 6.07882 12.8551L8.1124 10.8225Z" fill="#010D33"/>
                            <path d="M11.5 4.72355L10.8224 5.40109L12.1775 6.75617L12.855 6.07863C13.3951 5.541 14.1261 5.23916 14.8881 5.23916C15.6502 5.23916 16.3812 5.541 16.9213 6.07863C17.4594 6.61843 17.7615 7.34954 17.7615 8.11174C17.7615 8.87393 17.4594 9.60504 16.9213 10.1448L14.8877 12.1775C13.8019 13.2633 11.9082 13.2633 10.8224 12.1775L10.1449 11.4999L8.78979 12.855L9.46734 13.5325C10.371 14.4372 11.5747 14.9365 12.855 14.9365C14.1354 14.9365 15.339 14.4372 16.2428 13.5325L18.2763 11.4999C19.1731 10.6003 19.6766 9.38193 19.6766 8.11174C19.6766 6.84154 19.1731 5.62315 18.2763 4.72355C17.377 3.82636 16.1585 3.32251 14.8881 3.32251C13.6178 3.32251 12.3993 3.82636 11.5 4.72355Z" fill="#010D33"/>
                        </svg>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="#" style="text-decoration: underline;">learn more</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        @if ($campaign->status() != 'scheduled')
        <div class="col-xl-8">
            <div class="card card-campaign-active-detail" style="height: 92%;">
                <div class="card-body">
                    <div class="btn-group btn-group-toggle ml-2 mb-1" data-toggle="buttons">
                        {{-- <label class="btn btn-toggle-location btn-toggle-impressions active d-none" onchange="loadChartsImpressionsAndClicks('#campaign-{{$campaign->id}}-detail')">
                        <input type="radio" name="options" id="toggle-impressions" >
                        <div>impressions</div> 
                        </label> --}}
                        <label class="btn btn-toggle-location btn-toggle-clicks" id="campaign-{{$campaign->id}}-chart-clicks" campaign_id="{{$campaign->id}}">
                        <input type="radio" name="options" id="toggle-clicks" checked="">
                        <div>clicks</div> 
                        </label>
                    </div>
                    <div class="d-flex text-center">
                        <div class="ml-2 mr-3">
                            <h2 class="mb-0">{{thousandsFormat($campaign->impressions)}}</h2>
                            <p class="mb-50">impressions</p>
                        </div>
                        <div class="mr-3">
                            <h2 class="mb-0">{{thousandsFormat($clicksData['clicks'])}}</h2>
                            <p class="mb-50">clicks</p>
                        </div>
                        <div class="mr-3">
                            <h2 class="mb-0">{{engagementPercent($campaign->impressions, $campaign->engagement)}}</h2>
                            <p class="mb-50">engagement</p>  
                        </div>
                    </div>
                    {{-- <div id="chart-campaign-active-{{$campaign->id}}-impressions" class="chart chart-campaign-active chart-campaign-impressions"></div> --}}
                    <div id="chart-campaign-active-{{$campaign->id}}-clicks" class="chart chart-campaign-active chart-campaign-clicks"></div>
                </div>
            </div>
        </div>
        @endif

        {{-- job links --}}
        @if ($campaign->status() != 'scheduled')
        <div id="job-links" class="col-xl-4">
            <div class="card text-center" style="height: 92%;">
                <div class="card-body d-flex flex-column justify-content-center">
                    @if ($posts->count())
                    <p>Campaign posts</p>
                    @endif
                    @foreach ($posts as $post)
                    <div class="d-flex justify-content-between mb-1">
                        <div class="w-100 mr-50">
                            <a href="{{$post->permalink}}" target="_blank" class="input-add-link links-jobs">{{$post->permalink}}</a>
                        </div>
                        @if ($campaign->status() == 'active')
                        <div class="div-btn-remove-link-job" post_id="{{$post->id}}">
                            <button type="button" id="" class="btn position-relative m-auto d-flex justify-content-center align-items-center" style="height: 41px; width: 50px; white-space: nowrap; background-color:  transparent; color: #EB5757">
                                <span class="mb-0" style="font-size: 30px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.00293 20C5.00293 21.103 5.89993 22 7.00293 22H17.0029C18.1059 22 19.0029 21.103 19.0029 20V8H21.0029V6H17.0029V4C17.0029 2.897 16.1059 2 15.0029 2H9.00293C7.89993 2 7.00293 2.897 7.00293 4V6H3.00293V8H5.00293V20ZM9.00293 4H15.0029V6H9.00293V4ZM8.00293 8H17.0029L17.0039 20H7.00293V8H8.00293Z" fill="#EB5757"/>
                                        <path d="M9.00293 10H11.0029V18H9.00293V10ZM13.0029 10H15.0029V18H13.0029V10Z" fill="#EB5757"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @if (!$posts->count())
                    <div id="div-no-link-job">
                        <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg" class="my-0 mb-50 no-jobs">
                            <path d="M16.5773 22.1156C18.7961 19.8968 22.6658 19.8968 24.8845 22.1156L26.2691 23.5001L29.0382 20.731L27.6536 19.3465C25.8069 17.4978 23.3473 16.4775 20.7309 16.4775C18.1146 16.4775 15.6549 17.4978 13.8082 19.3465L9.65263 23.5001C7.82021 25.3384 6.79126 27.8282 6.79126 30.4238C6.79126 33.0194 7.82021 35.5092 9.65263 37.3475C10.5611 38.2572 11.6403 38.9785 12.8283 39.4698C14.0163 39.9611 15.2897 40.2129 16.5753 40.2106C17.8613 40.2133 19.1351 39.9617 20.3235 39.4703C21.5119 38.979 22.5914 38.2575 23.5 37.3475L24.8845 35.963L22.1155 33.1939L20.7309 34.5784C19.6273 35.6771 18.1335 36.2939 16.5763 36.2939C15.0191 36.2939 13.5253 35.6771 12.4217 34.5784C11.3221 33.4753 10.7047 31.9813 10.7047 30.4238C10.7047 28.8663 11.3221 27.3723 12.4217 26.2692L16.5773 22.1156Z" fill="#747E9F"/>
                            <path d="M23.5 9.65254L22.1154 11.0371L24.8845 13.8062L26.269 12.4216C27.3726 11.323 28.8664 10.7062 30.4236 10.7062C31.9809 10.7062 33.4747 11.323 34.5782 12.4216C35.6778 13.5247 36.2953 15.0187 36.2953 16.5762C36.2953 18.1338 35.6778 19.6278 34.5782 20.7308L30.4227 24.8845C28.2039 27.1032 24.3342 27.1032 22.1154 24.8845L20.7309 23.4999L17.9618 26.269L19.3463 27.6535C21.193 29.5022 23.6527 30.5225 26.269 30.5225C28.8854 30.5225 31.345 29.5022 33.1917 27.6535L37.3473 23.4999C39.1798 21.6616 40.2087 19.1718 40.2087 16.5762C40.2087 13.9806 39.1798 11.4909 37.3473 9.65254C35.5095 7.81916 33.0196 6.78955 30.4236 6.78955C27.8277 6.78955 25.3378 7.81916 23.5 9.65254Z" fill="#747E9F"/>
                        </svg>
                        <p class="mb-50 no-link-job">You haven't selected any posts</p>
                    </div>
                    @endif
                    @if ($campaign->status() == 'active')
                    <div id="div-btn-add-links-jobs">
                        @if($can_add_posts)
                        <button id="btn-add-links-jobs" class="btn btn-secondary position-relative mx-auto d-flex justify-content-center align-items-center mt-1" style="width: 100%; height: 40px; white-space: nowrap;">
                            <span style="margin-top: 2px;">Select campaign posts</span>
                        </button>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    {{-- end job links --}}

    <div class="row">
        <div class="col-xl-4">
            <div class="card" style="height: 92%;">
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

        <div class="col-xl-8">
            <div class="card" style="height: 92%;">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <p class="p-500 red-hat-text mb-50" style="font-size: 15px">Campaign duration</p>

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

                        <div class="w-50">
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
    ],
    labels: {
        show:false
    }
    },
};

var chart = new ApexCharts(document.querySelector('#chart-campaign-active-{{$campaign->id}}-clicks'), chartOptions);
chart.render();
@endif

$('#btn-add-links-jobs').click(function() {
    $("#modal-select-post-body").load('/influencer-campaign-posts/{{$campaign->id}}');
    $('#modal-select-post').modal({keyboard: true});
});

$(".div-btn-remove-link-job").click(function() {
post_id = $(this).attr('post_id');
console.log(post_id);
$.ajax({
        type: 'POST',
        url: '/detach-post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'post_id': post_id},
        success:function(data){
            if(data.status == 'success'){
                toastr.success(data.message, "Success");
                // $("#job-links").load('/influencer-campaign-posts/{{$campaign->id}}');
            }else if(data.status == 'error'){
                toastr.error(data.message, "Error");
            }  
        },
        error:function(data){
            $.each(data.responseJSON.errors, function(idex, item){
                toastr.warning(item[0], "Warning")
            });
        },
    });
});

</script>
