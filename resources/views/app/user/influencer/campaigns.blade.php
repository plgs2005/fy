@extends('layouts.influencer')
@section('content')
{{-- abas --}}
<div id="container-toggle-campaigns">
    <div class="row mt-1 d-flex justify-content-between pl-1 pr-1 align-items-baseline mt-2 mb-1">
        <div class="w-100">
            <div class="btn-group btn-group-toggle mb-1" data-toggle="buttons">
                <label id="campaigns-toggle-jobs" class="btn btn-toggle-custom-alt">
                  <input type="radio" name="options" id="toggle-campaign-jobs">
                  <div>Jobs</div> 
                  <div class="badge-toggle">
                    @php
                        $i=0;
                    @endphp
                    @foreach ($campaigns as $campaign)
                        @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept === NULL)
                            @php
                                $i++;
                            @endphp
                        @endif
                    @endforeach
                    @php
                        echo $i;
                    @endphp
                  </div>
                </label>
                <label id="campaigns-toggle-active" class="btn btn-toggle-custom-alt active">
                  <input type="radio" name="options" id="toggle-campaign-active">
                  <div>Active</div> 
                  <div class="badge-toggle">
                    @php
                        $i=0;
                    @endphp
                    @foreach ($campaigns as $campaign)
                        @if($campaign->status() == 'active' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                            @php
                                $i++;
                            @endphp
                        @endif
                    @endforeach
                    @php
                        echo $i;
                    @endphp
                  </div>
                </label>
                <label id="campaigns-toggle-scheduled" class="btn btn-toggle-custom-alt">
                  <input type="radio" name="options" id="toggle-campaign-scheduled">
                  <div>Scheduled</div>
                  <div class="badge-toggle">
                    @php
                        $i=0;
                    @endphp
                    @foreach ($campaigns as $campaign)
                        @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                            @php
                                $i++;
                            @endphp
                        @endif
                    @endforeach
                    @php
                        echo $i;
                    @endphp
                  </div>
                </label>
                <label id="campaigns-toggle-ended" class="btn btn-toggle-custom-alt">
                    <input type="radio" name="options" id="toggle-campaign-ended">
                    <div>Ended</div>
                    <div class="badge-toggle">
                        @php
                            $i=0;
                        @endphp
                        @foreach ($campaigns as $campaign)
                            @if($campaign->status() == 'ended' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach
                        @php
                            echo $i;
                        @endphp
                      </div>
                  </label>
              </div>
        </div>
    </div>
</div>
{{-- end abas --}}

<div id="none-active-campaigns" class="d-none">
    <svg width="42" height="43" viewBox="0 0 42 43" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-1">
        <path d="M24 0H32.55C34.455 0 36 1.545 36 3.45V12C36 13.035 35.868 14.04 35.622 15H38.274C40.332 15 42 16.668 42 18.726V28.5C42.0002 31.0424 41.2825 33.5331 39.9296 35.6855C38.5766 37.838 36.6433 39.5646 34.3523 40.6667C32.0612 41.7688 29.5055 42.2016 26.9793 41.9153C24.4532 41.6289 22.0592 40.635 20.073 39.048L17.562 41.562C17.2803 41.8433 16.8985 42.0011 16.5004 42.0008C16.1024 42.0006 15.7208 41.8422 15.4395 41.5605C15.1582 41.2788 15.0004 40.897 15.0007 40.4989C15.0009 40.1009 15.1593 39.7193 15.441 39.438L17.952 36.927C16.8888 35.5996 16.0867 34.0829 15.588 32.457C13.7906 33.0202 11.8859 33.1524 10.0279 32.8428C8.16995 32.5333 6.41095 31.7907 4.89323 30.6752C3.37551 29.5597 2.1417 28.1026 1.29162 26.4217C0.441538 24.7409 -0.000934515 22.8836 1.4819e-06 21V12.444C1.4819e-06 10.545 1.545 9 3.45 9H12C12.126 9 12.252 9 12.378 9.006C13.043 6.42902 14.5454 4.14604 16.6491 2.51586C18.7529 0.885678 21.3386 0.000697564 24 0ZM29.562 29.562L22.212 36.912C23.7728 38.0791 25.6277 38.7888 27.569 38.9617C29.5103 39.1345 31.4613 38.7636 33.2038 37.8905C34.9463 37.0174 36.4113 35.6765 37.435 34.0181C38.4587 32.3596 39.0006 30.449 39 28.5V18.723C38.9992 18.531 38.9224 18.3471 38.7863 18.2116C38.6502 18.0761 38.466 18 38.274 18H28.5C26.5513 18 24.641 18.5423 22.983 19.5662C21.325 20.5901 19.9846 22.0552 19.1119 23.7975C18.2391 25.5399 17.8685 27.4907 18.0414 29.4318C18.2143 31.3728 18.924 33.2274 20.091 34.788L27.441 27.438C27.7227 27.1567 28.1045 26.9989 28.5026 26.9992C28.9006 26.9994 29.2822 27.1578 29.5635 27.4395C29.8448 27.7212 30.0026 28.103 30.0023 28.5011C30.0021 28.8991 29.8437 29.2807 29.562 29.562ZM32.487 15C32.817 14.061 33 13.05 33 12V3.45C33 3.33065 32.9526 3.21619 32.8682 3.1318C32.7838 3.04741 32.6693 3 32.55 3H24C22.0532 3.0003 20.1589 3.63165 18.6012 4.7994C17.0435 5.96715 15.9062 7.60837 15.36 9.477C17.0425 9.96937 18.597 10.8235 19.9148 11.9796C21.2326 13.1357 22.2818 14.5659 22.989 16.17C24.7228 15.3954 26.601 14.9966 28.5 15H32.49H32.487ZM20.382 17.712C19.7206 16.0279 18.5671 14.5821 17.072 13.5632C15.5768 12.5443 13.8093 11.9996 12 12H3.45C3.33065 12 3.21619 12.0474 3.1318 12.1318C3.04741 12.2162 3 12.3307 3 12.45V21C2.9996 22.4433 3.3463 23.8655 4.01086 25.1466C4.67542 26.4278 5.63835 27.5304 6.81843 28.3613C7.9985 29.1922 9.3611 29.7272 10.7913 29.921C12.2215 30.1148 13.6773 29.9619 15.036 29.475C14.9599 28.4151 15.0072 27.35 15.177 26.301L9.438 20.562C9.29854 20.4225 9.18791 20.257 9.11243 20.0748C9.03695 19.8925 8.99811 19.6972 8.99811 19.5C8.99811 19.3028 9.03695 19.1075 9.11243 18.9252C9.18791 18.743 9.29854 18.5775 9.438 18.438C9.57747 18.2985 9.74303 18.1879 9.92525 18.1124C10.1075 18.037 10.3028 17.9981 10.5 17.9981C10.6972 17.9981 10.8925 18.037 11.0748 18.1124C11.257 18.1879 11.4225 18.2985 11.562 18.438L16.152 23.031C17.091 20.919 18.555 19.089 20.382 17.712Z" fill="#747E9F"/>
    </svg>
    <p>You don't have active
        <br>campaigns</p>
</div>

{{-- jobs tab --}}
<div id="guide-jobs" class="guide-campaigns guide-jobs d-none">
    <div class="container-jobs">
        <p class="red-hat-display d-none d-sm-block" style="font-size: 25px;">Jobs</p>

        <div class="d-flex flex-wrap">
            {{-- foreach cria 1 card para cada campanha(job) --}}
            @foreach ($campaigns as $campaign)
            @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept === NULL)
            <div id="job-{{$campaign->id}}" class="card card-jobs" onclick="openJob('#job-{{$campaign->id}}-detail')">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-50">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="title mb-0" style="font-size: 20px; color: #FF9933">{{thousandsFormat(stripeNumFormat($campaign->pivot->value))}}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                    <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                    <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                </svg>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                </svg>
                            @else
                                @if ($campaign->social_platform_instagram)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                        <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                        <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                    </svg>
                                @endif
                                @if ($campaign->social_platform_facebook)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                    </svg>
                                @endif
                            @endif
                            
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="mr-1">
                            <img src="../assets/images/icon-nike.png" class="img-fluid">                
                        </div>
                        <div>
                            <p class="title p-500 mb-0" style="font-size: 15px;">{{$campaign->name}}</p>
                        </div>
                    </div>
        
                    <div class="d-flex mt-2">
                        <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Format</p>
                        <p>{{ucfirst($campaign->format)}}</p>
                    </div>

                    <div class="d-flex">
                        <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Type</p>
                        <p>
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
                        </p>
                    </div>

                    <div class="d-flex">
                        <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Period</p>
                        <p>
                            {{$campaign->starts()}} <br>
                            {{$campaign->ends()}}
                    </div>
        
                </div>
                
                <div class="progress" style="background: #FFFFFF;">
                    <div class="progress-bar" style="width: 60%;"></div>
                </div> 
    
                <div class="progress alt">
                    <div class="d-flex justify-content-center align-items-center" style="height: 53px;z-index: 10;width: 100%;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 mr-50">
                            <path d="M12 4C7.121 4 3 8.121 3 13C3 17.879 7.121 22 12 22C16.879 22 21 17.879 21 13C21 8.121 16.879 4 12 4ZM12 20C8.206 20 5 16.794 5 13C5 9.206 8.206 6 12 6C15.794 6 19 9.206 19 13C19 16.794 15.794 20 12 20Z" fill="#033FFF"/>
                            <path d="M13 12V8H11V14H17V12H13Z" fill="#033FFF"/>
                            <path d="M17.284 3.70702L18.696 2.29102L21.706 5.29102L20.293 6.70802L17.284 3.70702Z" fill="#033FFF"/>
                            <path d="M6.69801 3.70695L3.70801 6.70595L2.29001 5.29395L5.28001 2.29395L6.69801 3.70695Z" fill="#033FFF"/>
                        </svg>
                            
                        <p class="title primary mb-0" style="font-size: 16px;">Countdown to accept: 01:13:12</p>
                    </div>
                    <div class="progress-bar alt" style="width: 60%;"></div>
                </div>

            </div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- foreach cria div com detalhes para cada campanha(job) --}}
    @foreach ($campaigns as $campaign)
    @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept === NULL)
    <div id="job-{{$campaign->id}}-detail" class="mt-2 job-details d-none">
        <div class="row align-items-center">
            <div class="col-xl-12 col-md-4 col-sm-6">
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
                        @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                            </svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                            </svg>
                        @else
                            @if ($campaign->social_platform_instagram)
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                    <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                    <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                </svg>
                            @endif
                            @if ($campaign->social_platform_facebook)
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                </svg>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
    
            <div class="col-xl-8">

                <div class="card" style="height: 92%;">

                    <div class="card-body">
    
                        <div class="d-flex">
                            <div class="w-50 mr-5">
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">Period</p>
    
                                <div class="progress mb-50">
                                    <div class="progress-bar" style="width: 60%;"></div>
                                </div> 
                    
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <p>{{$campaign->starts()}}</p>
                                    </div>
                                    <div>
                                        <p>{{$campaign->ends()}}</p>                                 
                                    </div>
                                </div>
        
                                <div class="d-flex">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Where</p>
                                    @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                        <p>Instagram &amp; Facebook</p>
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
                                    <p>{{$campaign->format}}</p>
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
                                    <p>{{$campaign->style}}</p>
                                </div>
                            </div>
    
                            <div class="w-50">
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">What is your brand goal with this campaign?</p>
                                <p>{{$campaign->goal_description}}</p>
    
                                @if ($campaign->goal_images)
                                    <div class="d-flex flex-wrap">
                                        @php
                                            $images = json_decode($campaign->goal_images);
                                        @endphp
                                        @if (!empty($images))
                                        @foreach ($images as $img)
                                            <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="rounded mr-1" width="90" height="90"></a>
                                        @endforeach
                                        @endif
                                    </div>
                                @endif
    
                                <p class="p-500 red-hat-text mb-50" style="font-size: 15px">URL you want influencers to send their followers to:</p>
                                <a href="#" style="text-decoration: underline;">{{$campaign->pivot->tracking_link_url}}</a>
    
                                <div class="d-flex mt-1">
                                    <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Specific instructions:</p>
                                    <p>{{$campaign->instructions}}</p>
                                </div>
                                @if ($campaign->instruction_images)
                                    <div class="d-flex flex-wrap">
                                        @php
                                            $images = json_decode($campaign->instruction_images);
                                        @endphp
                                        @if (!empty($images))
                                        @foreach ($images as $img)
                                            <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="rounded mr-1" width="90" height="90"></a>
                                        @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card" style="height: 92%;">
                    
                    <div class="progress" style="background: #FFFFFF;">
                        <div class="progress-bar" style="width: 60%;"></div>
                    </div> 
        
                    <div class="progress alt">
                        <div class="d-flex justify-content-center align-items-center" style="height: 53px;z-index: 10;width: 100%;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 mr-50">
                                <path d="M12 4C7.121 4 3 8.121 3 13C3 17.879 7.121 22 12 22C16.879 22 21 17.879 21 13C21 8.121 16.879 4 12 4ZM12 20C8.206 20 5 16.794 5 13C5 9.206 8.206 6 12 6C15.794 6 19 9.206 19 13C19 16.794 15.794 20 12 20Z" fill="#033FFF"/>
                                <path d="M13 12V8H11V14H17V12H13Z" fill="#033FFF"/>
                                <path d="M17.284 3.70702L18.696 2.29102L21.706 5.29102L20.293 6.70802L17.284 3.70702Z" fill="#033FFF"/>
                                <path d="M6.69801 3.70695L3.70801 6.70595L2.29001 5.29395L5.28001 2.29395L6.69801 3.70695Z" fill="#033FFF"/>
                            </svg>
                                
                            <p class="title primary mb-0" style="font-size: 16px;">Countdown to accept: 01:13:12</p>
                        </div>
                        <div class="progress-bar alt" style="width: 60%;"></div>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <div class="w-100 mr-50">
                                <button id="btn-accept-job" type="button" onclick="acceptJob('#job-{{$campaign->id}}-detail', '{{$campaign->id}}', '{{$campaign->name}}')"
                                 class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 100%; height: 31px; white-space: nowrap;">
                                    <span style="margin-top: 2px; font-size: 13px;">Accept job</span>
                                </button>
                            </div>
                            <div>
                                <button type="button" id="btn-decline-job" onclick="declineJob('#job-{{$campaign->id}}-detail', '{{$campaign->id}}', '{{$campaign->name}}')" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="height: 31px; white-space: nowrap;">
                                    <span style="margin-top: 2px; font-size: 13px;">No, thanks</span>
                                </button>
                            </div>
                        </div>

                        <p class="p-500 red-hat-text mb-0 mt-1" style="font-size: 15px">Payment method</p>
                        <p class="mb-2">
                            @if($campaign->type == 'paid')
                                <p>Cash</p>
                            @else
                                <p>Product</p>
                            @endif
                        </p>
    
                        <p class="p-500 red-hat-text mb-0" style="font-size: 15px">What product / service will the brand give me?</p>
                        <p>{{$campaign->product_description}}</p>
    
                        @if ($campaign->product_images)
                        <div class="d-flex flex-wrap">
                            @php
                                $images = json_decode($campaign->product_images);
                            @endphp
                            @foreach ($images as $img)
                                <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="rounded mr-1" width="90" height="90"></a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    
    </div>
    @endif
    @endforeach

    {{-- desktop decline job --}}
    <div id="div-decline-job" class="mt-2 d-none">
        <div class="row align-items-center">
            <div class="col-xl-12 col-md-4 col-sm-6">
                <div class="d-flex mb-1">
                    <div class="d-flex align-items-center mr-2">
                        <div>
                            <p id="decline_campaign_name" class="title p-500 mb-0" style="font-size: 25px;">N</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="container-decline-job">
            <form id="decline_form" method="POST" action="{{ route('job.decline') }}">
                @csrf
                <input type="hidden" id="campaign_id" name="campaign_id" value="">
                <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36.0002 45.6C37.2732 45.6 38.4941 45.0943 39.3943 44.1941C40.2945 43.2939 40.8002 42.073 40.8002 40.8C40.8002 39.527 40.2945 38.3061 39.3943 37.4059C38.4941 36.5057 37.2732 36 36.0002 36C34.7272 36 33.5063 36.5057 32.6061 37.4059C31.7059 38.3061 31.2002 39.527 31.2002 40.8C31.2002 42.073 31.7059 43.2939 32.6061 44.1941C33.5063 45.0943 34.7272 45.6 36.0002 45.6Z" fill="#010D33"/>
                    <path d="M64.8002 40.8C64.8002 42.073 64.2945 43.2939 63.3943 44.1941C62.4941 45.0943 61.2732 45.6 60.0002 45.6C58.7272 45.6 57.5063 45.0943 56.6061 44.1941C55.7059 43.2939 55.2002 42.073 55.2002 40.8C55.2002 39.527 55.7059 38.3061 56.6061 37.4059C57.5063 36.5057 58.7272 36 60.0002 36C61.2732 36 62.4941 36.5057 63.3943 37.4059C64.2945 38.3061 64.8002 39.527 64.8002 40.8Z" fill="#010D33"/>
                    <path d="M65.0965 64.272C64.6022 64.6671 63.9717 64.851 63.3424 64.7836C62.7132 64.7161 62.136 64.4029 61.7365 63.912L61.7221 63.8976C61.5142 63.6674 61.2947 63.4479 61.0645 63.24C60.3162 62.5664 59.5007 61.9713 58.6309 61.464C56.4181 60.168 52.9333 58.8 48.0085 58.8C43.0837 58.8 39.5941 60.1632 37.3717 61.4688C36.5006 61.9763 35.6836 62.5714 34.9333 63.2448C34.7016 63.4527 34.4805 63.6721 34.2709 63.9024L34.2565 63.9168C34.058 64.1617 33.8131 64.3651 33.536 64.5153C33.2588 64.6656 32.9548 64.7598 32.6412 64.7926C32.3276 64.8253 32.0107 64.796 31.7084 64.7063C31.4062 64.6165 31.1246 64.4682 30.8797 64.2696C30.6348 64.071 30.4315 63.8262 30.2812 63.549C30.1309 63.2719 30.0367 62.9678 30.004 62.6543C29.9712 62.3407 30.0005 62.0238 30.0903 61.7215C30.18 61.4193 30.3284 61.1377 30.5269 60.8928L32.3989 62.4L30.5269 60.8976V60.8928L30.5365 60.888L30.5461 60.8784L30.5701 60.8496L30.6373 60.7632L30.8725 60.504C31.0645 60.2976 31.3429 60.0144 31.7077 59.688C32.4373 59.0256 33.5077 58.1712 34.9429 57.3312C37.8229 55.6368 42.1429 54 48.0085 54C53.8693 54 58.1845 55.632 61.0645 57.3312C62.5045 58.176 63.5701 59.0256 64.2949 59.6832C64.6696 60.0252 65.0253 60.3873 65.3605 60.768L65.4325 60.8496L65.4565 60.8784L65.4661 60.8928C65.4661 60.8928 65.4709 60.9024 63.5989 62.4L65.4709 60.9024C65.8674 61.3992 66.0507 62.0329 65.9805 62.6646C65.9103 63.2963 65.5924 63.8744 65.0965 64.272Z" fill="#010D33"/>
                    <path d="M48.0001 9.6001C37.8158 9.6001 28.0486 13.6458 20.8472 20.8472C13.6458 28.0486 9.6001 37.8158 9.6001 48.0001C9.6001 58.1844 13.6458 67.9516 20.8472 75.153C28.0486 82.3544 37.8158 86.4001 48.0001 86.4001C58.1844 86.4001 67.9516 82.3544 75.153 75.153C82.3544 67.9516 86.4001 58.1844 86.4001 48.0001C86.4001 37.8158 82.3544 28.0486 75.153 20.8472C67.9516 13.6458 58.1844 9.6001 48.0001 9.6001ZM14.4001 48.0001C14.4001 43.5877 15.2692 39.2185 16.9577 35.1419C18.6463 31.0654 21.1213 27.3614 24.2413 24.2413C27.3614 21.1213 31.0654 18.6463 35.1419 16.9577C39.2185 15.2692 43.5877 14.4001 48.0001 14.4001C52.4125 14.4001 56.7817 15.2692 60.8583 16.9577C64.9348 18.6463 68.6388 21.1213 71.7589 24.2413C74.8789 27.3614 77.3539 31.0654 79.0424 35.1419C80.731 39.2185 81.6001 43.5877 81.6001 48.0001C81.6001 56.9114 78.0601 65.4577 71.7589 71.7589C65.4577 78.0601 56.9114 81.6001 48.0001 81.6001C39.0888 81.6001 30.5425 78.0601 24.2413 71.7589C17.9401 65.4577 14.4001 56.9114 14.4001 48.0001Z" fill="#010D33"/>
                </svg>
                <h3>We're sorry to hear that</h3>
                <p>Quae tibi placent quicunq prosunt aut diligebat multum, quod memor sis ad</p>
                <textarea class="textarea-influencer mb-50" id="textarea-decline-job" name="textarea-decline-job" resizable="false" placeholder="" required></textarea>
                <div class="d-flex justify-content-center">
                    <div class="mr-50">
                        <button id="btn-decline-job-send" type="submit" id="" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 172px; height: 40px; white-space: nowrap;">
                            <span style="margin-top: 2px; font-size: 15px;">send</span>
                        </button>
                    </div>
                    <div>
                        <button id="btn-decline-job-back" type="button" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 172px; height: 40px; white-space: nowrap;">
                            <span style="margin-top: 2px; font-size: 15px;">back</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- desktop accept job --}}
    <div id="div-accept-job" class="mt-2 d-none">
        <div class="row align-items-center">
            <div class="col-xl-12 col-md-4 col-sm-6">
                <div class="d-flex mb-1">
                    <div class="d-flex align-items-center mr-2">
                        <div>
                            <p id="accept_campaign_name" class="title p-500 mb-0" style="font-size: 25px;">N</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="container-accept-job">
            <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M48.0002 7.99609C70.0962 7.99609 88.0082 25.9081 88.0082 48.0041C88.0082 70.0961 70.0962 88.0081 48.0002 88.0081C25.9042 88.0081 7.99219 70.0961 7.99219 48.0041C7.99219 25.9081 25.9042 7.99609 48.0002 7.99609ZM48.0002 13.9961C43.5034 13.9473 39.0416 14.7909 34.8731 16.478C30.7045 18.1651 26.9119 20.6622 23.7148 23.8248C20.5178 26.9874 17.9797 30.7526 16.2475 34.9027C14.5153 39.0527 13.6234 43.5051 13.6234 48.0021C13.6234 52.4991 14.5153 56.9515 16.2475 61.1015C17.9797 65.2516 20.5178 69.0168 23.7148 72.1794C26.9119 75.342 30.7045 77.8391 34.8731 79.5262C39.0416 81.2133 43.5034 82.0569 48.0002 82.0081C56.9283 81.8711 65.4443 78.2284 71.7096 71.8663C77.9749 65.5042 81.4866 56.9332 81.4866 48.0041C81.4866 39.075 77.9749 30.504 71.7096 24.1419C65.4443 17.7798 56.9283 14.137 48.0002 14.0001V13.9961ZM33.8482 59.1361C35.5312 61.2801 37.68 63.0131 40.1319 64.2037C42.5838 65.3943 45.2745 66.0113 48.0002 66.0081C50.7225 66.0111 53.4099 65.3956 55.8594 64.2079C58.309 63.0202 60.4566 61.2914 62.1402 59.1521C62.6335 58.5278 63.3546 58.125 64.1449 58.0323C64.9352 57.9397 65.7299 58.1648 66.3542 58.6581C66.9785 59.1514 67.3813 59.8725 67.4739 60.6628C67.5666 61.4531 67.3415 62.2478 66.8482 62.8721C64.6031 65.7224 61.7401 68.0257 58.4752 69.6083C55.2102 71.1909 51.6285 72.0115 48.0002 72.0081C44.3672 72.0111 40.7811 71.188 37.513 69.601C34.245 68.0141 31.3805 65.7049 29.1362 62.8481C28.665 62.2215 28.4578 61.4354 28.5589 60.6579C28.66 59.8805 29.0615 59.1735 29.6774 58.6884C30.2932 58.2032 31.0745 57.9784 31.854 58.0621C32.6336 58.1458 33.3493 58.5313 33.8482 59.1361ZM36.0002 35.0001C36.6684 34.9812 37.3337 35.0965 37.9566 35.3391C38.5795 35.5818 39.1474 35.9469 39.6268 36.4129C40.1061 36.8789 40.4872 37.4363 40.7473 38.0521C41.0075 38.6679 41.1416 39.3296 41.1416 39.9981C41.1416 40.6666 41.0075 41.3283 40.7473 41.9441C40.4872 42.5599 40.1061 43.1173 39.6268 43.5833C39.1474 44.0493 38.5795 44.4144 37.9566 44.657C37.3337 44.8997 36.6684 45.015 36.0002 44.9961C34.6991 44.9593 33.4637 44.4166 32.5564 43.4833C31.6492 42.55 31.1416 41.2997 31.1416 39.9981C31.1416 38.6965 31.6492 37.4462 32.5564 36.5129C33.4637 35.5796 34.6991 35.0369 36.0002 35.0001ZM60.0002 35.0001C60.6684 34.9812 61.3337 35.0965 61.9566 35.3391C62.5795 35.5818 63.1474 35.9469 63.6268 36.4129C64.1061 36.8789 64.4872 37.4363 64.7473 38.0521C65.0075 38.6679 65.1416 39.3296 65.1416 39.9981C65.1416 40.6666 65.0075 41.3283 64.7473 41.9441C64.4872 42.5599 64.1061 43.1173 63.6268 43.5833C63.1474 44.0493 62.5795 44.4144 61.9566 44.657C61.3337 44.8997 60.6684 45.015 60.0002 44.9961C58.6991 44.9593 57.4637 44.4166 56.5564 43.4833C55.6492 42.55 55.1416 41.2997 55.1416 39.9981C55.1416 38.6965 55.6492 37.4462 56.5564 36.5129C57.4637 35.5796 58.6991 35.0369 60.0002 35.0001Z" fill="#010D33"/>
            </svg>
            <h3>Great!</h3>
            <p>Quae tibi placent quicunq prosunt aut diligebat multum, quod memor sis ad</p>
            <div class="d-flex justify-content-center">
                <div class="mr-50">
                    <button id="btn-return-to-campaign" type="button" id="" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 250px; height: 40px; white-space: nowrap;">
                        <span style="margin-top: 2px; font-size: 15px;">Return to campaigns</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- end jobs tab --}}

{{-- active tab --}}
<div id="guide-active" class="guide-campaigns guide-active">

    <div class="container-card-campaign-active">
        <p class="red-hat-display d-none d-sm-block" style="font-size: 25px;">Active campaigns</p>

        <div class="d-flex flex-wrap">
    
            {{-- list active campaigns --}}
            @foreach ($campaigns as $campaign)
            @if($campaign->status() == 'active' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                <div id="campaign-{{$campaign->id}}" class="card card-campaign-active" onclick="openCampaignDetails('#campaign-{{$campaign->id}}-detail', '{{$campaign->id}}', 'active')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-50">
                            <div class="d-flex align-items-center">
                                <div class="mr-1">
                                    <img src="../assets/images/icon-nike.png" class="img-fluid">                
                                </div>
                                <div>
                                    <p class="title p-500 mb-0" style="font-size: 15px;">{{$campaign->name}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                        <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                        <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                    </svg>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                    </svg>
                                @else
                                    @if ($campaign->social_platform_instagram)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                            <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                            <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                    @if ($campaign->social_platform_facebook)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </div>
            
                        <div class="d-flex justify-content-between text-center">
                            <div>
                                @if($campaign->impressions > 0)
                                <h2 class="mb-0">{{thousandsFormat($campaign->impressions)}}</h2>
                                <p class="mb-50">@if($campaign->impressions == 1) impression @else impressions @endif</p>
                                @endif
                            </div>
                            <div>
                                @if($campaign->clicks > 0)
                                <h2 class="mb-0">{{thousandsFormat($campaign->clicks)}}</h2>
                                <p class="mb-50">@if($campaign->clicks == 1)click @else clicks @endif</p>
                                @endif
                            </div>
                            <div>
                                @if($campaign->impressions > 0)
                                <h2 class="mb-0">{{engagementPercent($campaign->impressions, $campaign->engagement)}}</h2>
                                <p class="mb-50">engagement</p>
                                @endif 
                            </div>
                        </div>
                        
                        <div class="progress mb-50">
                            <div class="progress-bar" style="width: 60%;"></div>
                        </div> 
            
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{$campaign->starts(true)}}</p>
                            </div>
                            <div>
                                <p>{{$campaign->ends(true)}}</p>                                 
                            </div>
                        </div>
            
                    </div>
                </div>
            @endif
            @endforeach
        
        </div>
    </div>
    
    {{-- active details desktop - ajax loaded --}}
    <div id="campaign_details_active">
    </div>
    
</div>
{{-- end active tab --}}

{{-- Scheduled tab --}}
<div id="guide-scheduled" class="guide-campaigns guide-scheduled d-none">
    <div class="container-card-campaign-active">
        <p class="red-hat-display d-none d-sm-block" style="font-size: 25px;">Scheduled campaigns</p>

        <div class="d-flex flex-wrap">
    
            {{-- list active campaigns --}}
            @foreach ($campaigns as $campaign)
            @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                <div id="campaign-{{$campaign->id}}" class="card card-campaign-active" onclick="openCampaignDetails('#campaign-{{$campaign->id}}-detail', '{{$campaign->id}}', 'scheduled')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-50">
                            <div class="d-flex align-items-center">
                                <div class="mr-1">
                                    <img src="../assets/images/icon-nike.png" class="img-fluid">                
                                </div>
                                <div>
                                    <p class="title p-500 mb-0" style="font-size: 15px;">{{$campaign->name}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                        <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                        <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                    </svg>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                    </svg>
                                @else
                                    @if ($campaign->social_platform_instagram)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                            <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                            <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                    @if ($campaign->social_platform_facebook)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </div>
            
                        <div class="d-flex justify-content-between text-center">
                            <div>
                                <h2 class="mb-0">{{thousandsFormat($campaign->impressions)}}</h2>
                                <p class="mb-50">impressions</p>
                            </div>
                            <div>
                                <h2 class="mb-0">{{thousandsFormat($campaign->clicks)}}</h2>
                                <p class="mb-50">clicks</p>
                            </div>
                            <div>
                                <h2 class="mb-0">{{engagementPercent($campaign->impressions, $campaign->engagement)}}</h2>
                                <p class="mb-50">engagement</p>  
                            </div>
                        </div>
                        
                        <div class="progress mb-50">
                            <div class="progress-bar" style="width: 60%;"></div>
                        </div> 
            
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{$campaign->starts(true)}}</p>
                            </div>
                            <div>
                                <p>{{$campaign->ends(true)}}</p>                                 
                            </div>
                        </div>
            
                    </div>
                </div>
            @endif
            @endforeach
        
        </div>
    </div>
    
    {{-- schedules details desktop - ajax loaded --}}
    <div id="campaign_details_scheduled">
    </div>
</div>
{{-- end scheduled tab --}}

{{-- Ended tab --}}
<div id="guide-ended" class="guide-campaigns guide-ended d-none">
    <div class="container-card-campaign-active">
        <p class="red-hat-display d-none d-sm-block" style="font-size: 25px;">Ended campaigns</p>

        <div class="d-flex flex-wrap">
    
            {{-- list active campaigns --}}
            @foreach ($campaigns as $campaign)
            @if($campaign->status() == 'ended' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept == 1)
                <div id="campaign-{{$campaign->id}}" class="card card-campaign-active" onclick="openCampaignDetails('#campaign-{{$campaign->id}}-detail', '{{$campaign->id}}', 'ended')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-50">
                            <div class="d-flex align-items-center">
                                <div class="mr-1">
                                    <img src="../assets/images/icon-nike.png" class="img-fluid">                
                                </div>
                                <div>
                                    <p class="title p-500 mb-0" style="font-size: 15px;">{{$campaign->name}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                        <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                        <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                    </svg>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                    </svg>
                                @else
                                    @if ($campaign->social_platform_instagram)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.999 7.37695C10.7726 7.37695 9.59651 7.86412 8.72934 8.73129C7.86217 9.59846 7.375 10.7746 7.375 12.001C7.375 13.2273 7.86217 14.4034 8.72934 15.2706C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2706C16.1358 14.4034 16.623 13.2273 16.623 12.001C16.623 10.7746 16.1358 9.59846 15.2687 8.73129C14.4015 7.86412 13.2254 7.37695 11.999 7.37695ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5607 8.995 12.7967 8.995 12C8.995 11.2032 9.31149 10.4392 9.87485 9.8758C10.4382 9.31245 11.2023 8.99595 11.999 8.99595C12.7957 8.99595 13.5598 9.31245 14.1231 9.8758C14.6865 10.4392 15.003 11.2032 15.003 12C15.003 12.7967 14.6865 13.5607 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#010D33"/>
                                            <path d="M16.806 8.28491C17.4014 8.28491 17.884 7.80227 17.884 7.20691C17.884 6.61154 17.4014 6.12891 16.806 6.12891C16.2106 6.12891 15.728 6.61154 15.728 7.20691C15.728 7.80227 16.2106 8.28491 16.806 8.28491Z" fill="#010D33"/>
                                            <path d="M20.533 6.11088C20.3015 5.51306 19.9477 4.97017 19.4943 4.51694C19.0409 4.06372 18.4979 3.71015 17.9 3.47888C17.2003 3.21624 16.4612 3.07422 15.714 3.05888C14.751 3.01688 14.446 3.00488 12.004 3.00488C9.562 3.00488 9.249 3.00488 8.294 3.05888C7.54739 3.07344 6.80876 3.21548 6.11 3.47888C5.51193 3.70988 4.96876 4.06335 4.51533 4.51661C4.0619 4.96987 3.70823 5.51291 3.477 6.11088C3.2143 6.8105 3.07261 7.54972 3.058 8.29688C3.015 9.25888 3.002 9.56388 3.002 12.0069C3.002 14.4489 3.002 14.7599 3.058 15.7169C3.073 16.4649 3.214 17.2029 3.477 17.9039C3.70888 18.5016 4.0629 19.0445 4.51643 19.4977C4.96997 19.9509 5.51306 20.3045 6.111 20.5359C6.80843 20.8091 7.54737 20.9613 8.296 20.9859C9.259 21.0279 9.564 21.0409 12.006 21.0409C14.448 21.0409 14.761 21.0409 15.716 20.9859C16.4631 20.9707 17.2022 20.829 17.902 20.5669C18.4998 20.3351 19.0426 19.9812 19.496 19.5279C19.9493 19.0745 20.3032 18.5316 20.535 17.9339C20.798 17.2339 20.939 16.4959 20.954 15.7479C20.997 14.7859 21.01 14.4809 21.01 12.0379C21.01 9.59488 21.01 9.28488 20.954 8.32788C20.9424 7.57016 20.7999 6.82013 20.533 6.11088ZM19.315 15.6429C19.3085 16.2192 19.2034 16.7901 19.004 17.3309C18.8538 17.7198 18.6239 18.0729 18.3291 18.3676C18.0342 18.6622 17.681 18.8919 17.292 19.0419C16.7572 19.2403 16.1924 19.3455 15.622 19.3529C14.672 19.3969 14.404 19.4079 11.968 19.4079C9.53 19.4079 9.281 19.4079 8.313 19.3529C7.74293 19.3459 7.17832 19.2407 6.644 19.0419C6.25369 18.8929 5.899 18.6636 5.60289 18.3688C5.30678 18.0741 5.07583 17.7205 4.925 17.3309C4.72845 16.7959 4.62331 16.2317 4.614 15.6619C4.571 14.7119 4.561 14.4439 4.561 12.0079C4.561 9.57088 4.561 9.32188 4.614 8.35288C4.62046 7.77691 4.72565 7.2063 4.925 6.66588C5.23 5.87688 5.855 5.25588 6.644 4.95388C7.17859 4.75602 7.74302 4.65085 8.313 4.64288C9.264 4.59988 9.531 4.58788 11.968 4.58788C14.405 4.58788 14.655 4.58788 15.622 4.64288C16.1924 4.64974 16.7574 4.75495 17.292 4.95388C17.6809 5.10416 18.0341 5.33408 18.329 5.62891C18.6238 5.92374 18.8537 6.27695 19.004 6.66588C19.2006 7.20083 19.3057 7.76504 19.315 8.33488C19.358 9.28588 19.369 9.55288 19.369 11.9899C19.369 14.4259 19.369 14.6879 19.326 15.6439H19.315V15.6429Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                    @if ($campaign->social_platform_facebook)
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.001 2.00195C6.479 2.00195 2.002 6.47895 2.002 12.001C2.002 16.991 5.658 21.127 10.439 21.88V14.892H7.899V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z" fill="#010D33"/>
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </div>
            
                        <div class="d-flex justify-content-between text-center">
                            <div>
                                @if($campaign->impressions > 0)
                                <h2 class="mb-0">{{thousandsFormat($campaign->impressions)}}</h2>
                                <p class="mb-50">@if($campaign->impressions == 1) impression @else impressions @endif</p>
                                @endif
                            </div>
                            <div>
                                @if($campaign->clicks > 0)
                                <h2 class="mb-0">{{thousandsFormat($campaign->clicks)}}</h2>
                                <p class="mb-50">@if($campaign->clicks == 1)click @else clicks @endif</p>
                                @endif
                            </div>
                            <div>
                                @if($campaign->impressions > 0)
                                <h2 class="mb-0">{{engagementPercent($campaign->impressions, $campaign->engagement)}}</h2>
                                <p class="mb-50">engagement</p>
                                @endif 
                            </div>
                        </div>
                        
                        <div class="progress mb-50">
                            <div class="progress-bar" style="width: 60%;"></div>
                        </div> 
            
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{$campaign->starts(true)}}</p>
                            </div>
                            <div>
                                <p>{{$campaign->ends(true)}}</p>                                 
                            </div>
                        </div>
            
                    </div>
                </div>
            @endif
            @endforeach
        
        </div>
    </div>
    
    {{-- ended details desktop - ajax loaded --}}
    <div id="campaign_details_ended">
    </div>
</div>
{{-- end ended tab --}}

{{-- cria 1 modal para cada job --}}
@foreach ($campaigns as $campaign)
    @if($campaign->status() == 'scheduled' AND $campaign->pivot->brand_accept == 1 AND $campaign->pivot->influencer_accept === NULL)
        <!-- Start Modal Jobs -->
        <div
        class="modal fade campaign-modal"
        id="job-{{$campaign->id}}-detail-mobile"
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
                        <a class='btn-back-jobs' campaign_id="{{$campaign->id}}">
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
                        Jobs
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
                    <div class="guide-campaigns-details">
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
                    
                        <div class="row">
                            <div id="guide-jobs" class="col-xl-12 col-md-4 col-sm-6 p-0">
                                <div class="card mb-0">
                                    
                                    <div class="progress" style="background: #FFFFFF;">
                                        <div class="progress-bar" style="width: 60%;"></div>
                                    </div> 
                        
                                    <div class="progress alt">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 53px;z-index: 10;width: 100%;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 mr-50">
                                                <path d="M12 4C7.121 4 3 8.121 3 13C3 17.879 7.121 22 12 22C16.879 22 21 17.879 21 13C21 8.121 16.879 4 12 4ZM12 20C8.206 20 5 16.794 5 13C5 9.206 8.206 6 12 6C15.794 6 19 9.206 19 13C19 16.794 15.794 20 12 20Z" fill="#033FFF"></path>
                                                <path d="M13 12V8H11V14H17V12H13Z" fill="#033FFF"></path>
                                                <path d="M17.284 3.70702L18.696 2.29102L21.706 5.29102L20.293 6.70802L17.284 3.70702Z" fill="#033FFF"></path>
                                                <path d="M6.69801 3.70695L3.70801 6.70595L2.29001 5.29395L5.28001 2.29395L6.69801 3.70695Z" fill="#033FFF"></path>
                                            </svg>
                                                
                                            <p class="title primary mb-0" style="font-size: 16px;">Countdown to accept: 01:13:12</p>
                                        </div>
                                        <div class="progress-bar alt" style="width: 60%;"></div>
                                    </div>
                
                                    <div class="card-body">
                
                                        <div class="d-flex justify-content-between">
                                            <div class="w-100 mr-50">
                                                <button type="button" campaign_id="{{$campaign->id}}" onclick="acceptJob('#job-{{$campaign->id}}-detail-mobile', '{{$campaign->id}}', '{{$campaign->name}}')" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center btn-jobs-accept-job" data-toggle="modal" style="width: 100%; height: 31px; white-space: nowrap;">
                                                    <span style="margin-top: 2px; font-size: 13px;">Accept job</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button type="button" onclick="declineJob('#job-{{$campaign->id}}-detail', '{{$campaign->id}}', '{{$campaign->name}}')" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="height: 31px; white-space: nowrap;">
                                                    <span style="margin-top: 2px; font-size: 13px;">No, thanks</span>
                                                </button>
                                            </div>
                                        </div>
                
                                        <p class="p-500 red-hat-text mb-0 mt-1" style="font-size: 15px">Payment method</p>
                                        @if($campaign->type == 'paid')
                                            <p class="mb-2">Cash</p>
                                        @else
                                            <p class="mb-2">Product</p>
                                        @endif
                    
                                        <p class="p-500 red-hat-text mb-0" style="font-size: 15px">What product / service will the brand give me?</p>
                                        <p>{{$campaign->product_description}}</p>
                    
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
                                            <p class="p-500 red-hat-text mb-50" style="font-size: 15px">Period</p>
                
                                            <div class="progress mb-50">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div> 
                                
                                            <div class="d-flex justify-content-between mb-2">
                                                <div>
                                                    <p>{{$campaign->starts(true)}}</p>
                                                </div>
                                                <div>
                                                    <p>{{$campaign->starts(true)}}</p>                                 
                                                </div>
                                            </div>
                    
                                            <div class="d-flex">
                                                <p class="p-500 red-hat-text mb-1 mr-2" style="font-size: 15px">Where</p>
                                                @if ($campaign->social_platform_instagram AND $campaign->social_platform_facebook)
                                                    <p>Instagram &amp; Facebook</p>
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
                                                <p>{{$campaign->format}}</p>
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
                                                <p>{{$campaign->style}}</p>
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
                                                    <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="rounded mr-1" style="box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.1);" width="90" height="90"></a>
                                                @endforeach
                                                @endif
                                            </div>
                
                                            <p class="p-500 red-hat-text mb-50" style="font-size: 15px">URL you want influencers to send their followers to:</p>
                                            <a href="#" style="text-decoration: underline;">{{$campaign->pivot->tracking_link_url}}</a>
                
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
                                                    <a href="{{URL::asset("/storage/$img")}}" target="_blank"><img src="{{URL::asset("/storage/$img")}}" class="rounded mr-1" style="box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.1);" width="90" height="90"></a>
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
        <!-- End Modal Jobs -->
    @endif
@endforeach

<!-- Start Modal Decline Job -->
<div
  class="modal fade"
  id="modal-main-menu-mobile-decline-job"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-hidden="true"
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
                  <a id="btn-back-decline-job">
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
                  Decline job
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
        <div class="d-flex w-100 h-100">
            <div class="container-decline-job-mobile text-center">
                <form id="decline_form" method="POST" action="{{ route('job.decline') }}">
                    @csrf
                    <input type="hidden" id="campaign_id" name="campaign_id" value="">
                    <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.0002 45.6C37.2732 45.6 38.4941 45.0943 39.3943 44.1941C40.2945 43.2939 40.8002 42.073 40.8002 40.8C40.8002 39.527 40.2945 38.3061 39.3943 37.4059C38.4941 36.5057 37.2732 36 36.0002 36C34.7272 36 33.5063 36.5057 32.6061 37.4059C31.7059 38.3061 31.2002 39.527 31.2002 40.8C31.2002 42.073 31.7059 43.2939 32.6061 44.1941C33.5063 45.0943 34.7272 45.6 36.0002 45.6Z" fill="#010D33"></path>
                        <path d="M64.8002 40.8C64.8002 42.073 64.2945 43.2939 63.3943 44.1941C62.4941 45.0943 61.2732 45.6 60.0002 45.6C58.7272 45.6 57.5063 45.0943 56.6061 44.1941C55.7059 43.2939 55.2002 42.073 55.2002 40.8C55.2002 39.527 55.7059 38.3061 56.6061 37.4059C57.5063 36.5057 58.7272 36 60.0002 36C61.2732 36 62.4941 36.5057 63.3943 37.4059C64.2945 38.3061 64.8002 39.527 64.8002 40.8Z" fill="#010D33"></path>
                        <path d="M65.0965 64.272C64.6022 64.6671 63.9717 64.851 63.3424 64.7836C62.7132 64.7161 62.136 64.4029 61.7365 63.912L61.7221 63.8976C61.5142 63.6674 61.2947 63.4479 61.0645 63.24C60.3162 62.5664 59.5007 61.9713 58.6309 61.464C56.4181 60.168 52.9333 58.8 48.0085 58.8C43.0837 58.8 39.5941 60.1632 37.3717 61.4688C36.5006 61.9763 35.6836 62.5714 34.9333 63.2448C34.7016 63.4527 34.4805 63.6721 34.2709 63.9024L34.2565 63.9168C34.058 64.1617 33.8131 64.3651 33.536 64.5153C33.2588 64.6656 32.9548 64.7598 32.6412 64.7926C32.3276 64.8253 32.0107 64.796 31.7084 64.7063C31.4062 64.6165 31.1246 64.4682 30.8797 64.2696C30.6348 64.071 30.4315 63.8262 30.2812 63.549C30.1309 63.2719 30.0367 62.9678 30.004 62.6543C29.9712 62.3407 30.0005 62.0238 30.0903 61.7215C30.18 61.4193 30.3284 61.1377 30.5269 60.8928L32.3989 62.4L30.5269 60.8976V60.8928L30.5365 60.888L30.5461 60.8784L30.5701 60.8496L30.6373 60.7632L30.8725 60.504C31.0645 60.2976 31.3429 60.0144 31.7077 59.688C32.4373 59.0256 33.5077 58.1712 34.9429 57.3312C37.8229 55.6368 42.1429 54 48.0085 54C53.8693 54 58.1845 55.632 61.0645 57.3312C62.5045 58.176 63.5701 59.0256 64.2949 59.6832C64.6696 60.0252 65.0253 60.3873 65.3605 60.768L65.4325 60.8496L65.4565 60.8784L65.4661 60.8928C65.4661 60.8928 65.4709 60.9024 63.5989 62.4L65.4709 60.9024C65.8674 61.3992 66.0507 62.0329 65.9805 62.6646C65.9103 63.2963 65.5924 63.8744 65.0965 64.272Z" fill="#010D33"></path>
                        <path d="M48.0001 9.6001C37.8158 9.6001 28.0486 13.6458 20.8472 20.8472C13.6458 28.0486 9.6001 37.8158 9.6001 48.0001C9.6001 58.1844 13.6458 67.9516 20.8472 75.153C28.0486 82.3544 37.8158 86.4001 48.0001 86.4001C58.1844 86.4001 67.9516 82.3544 75.153 75.153C82.3544 67.9516 86.4001 58.1844 86.4001 48.0001C86.4001 37.8158 82.3544 28.0486 75.153 20.8472C67.9516 13.6458 58.1844 9.6001 48.0001 9.6001ZM14.4001 48.0001C14.4001 43.5877 15.2692 39.2185 16.9577 35.1419C18.6463 31.0654 21.1213 27.3614 24.2413 24.2413C27.3614 21.1213 31.0654 18.6463 35.1419 16.9577C39.2185 15.2692 43.5877 14.4001 48.0001 14.4001C52.4125 14.4001 56.7817 15.2692 60.8583 16.9577C64.9348 18.6463 68.6388 21.1213 71.7589 24.2413C74.8789 27.3614 77.3539 31.0654 79.0424 35.1419C80.731 39.2185 81.6001 43.5877 81.6001 48.0001C81.6001 56.9114 78.0601 65.4577 71.7589 71.7589C65.4577 78.0601 56.9114 81.6001 48.0001 81.6001C39.0888 81.6001 30.5425 78.0601 24.2413 71.7589C17.9401 65.4577 14.4001 56.9114 14.4001 48.0001Z" fill="#010D33"></path>
                    </svg>
                    <h3>We're sorry to hear that</h3>
                    <p>Quae tibi placent quicunq prosunt aut diligebat multum, quod memor sis ad</p>
                    <textarea class="textarea-influencer mb-50" id="textarea-decline-job" name="textarea-decline-job" resizable="false" placeholder=""></textarea>
                    <div class="d-flex justify-content-center">
                        <div class="mr-50">
                            <button id="btn-decline-job-send-mobile" type="submit" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 100%; height: 40px; white-space: nowrap;">
                                <span style="margin-top: 2px; font-size: 15px;">send</span>
                            </button>
                        </div>
                        <div>
                            <button id="btn-decline-job-back-mobile" type="button" onclick="declineJobBack('#job-1-detail')" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 100%; height: 40px; white-space: nowrap;">
                                <span style="margin-top: 2px; font-size: 15px;">back</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Decline Job -->

<!-- Start Modal Accept Job -->
<div
  class="modal fade"
  id="modal-main-menu-mobile-accept-job"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-hidden="true"
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
                  <a id="btn-back-accept-job">
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
                  Accept job
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
        <div class="d-flex w-100 h-100">
            <div class="container-accept-job-mobile text-center">
                <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M48.0002 7.99609C70.0962 7.99609 88.0082 25.9081 88.0082 48.0041C88.0082 70.0961 70.0962 88.0081 48.0002 88.0081C25.9042 88.0081 7.99219 70.0961 7.99219 48.0041C7.99219 25.9081 25.9042 7.99609 48.0002 7.99609ZM48.0002 13.9961C43.5034 13.9473 39.0416 14.7909 34.8731 16.478C30.7045 18.1651 26.9119 20.6622 23.7148 23.8248C20.5178 26.9874 17.9797 30.7526 16.2475 34.9027C14.5153 39.0527 13.6234 43.5051 13.6234 48.0021C13.6234 52.4991 14.5153 56.9515 16.2475 61.1015C17.9797 65.2516 20.5178 69.0168 23.7148 72.1794C26.9119 75.342 30.7045 77.8391 34.8731 79.5262C39.0416 81.2133 43.5034 82.0569 48.0002 82.0081C56.9283 81.8711 65.4443 78.2284 71.7096 71.8663C77.9749 65.5042 81.4866 56.9332 81.4866 48.0041C81.4866 39.075 77.9749 30.504 71.7096 24.1419C65.4443 17.7798 56.9283 14.137 48.0002 14.0001V13.9961ZM33.8482 59.1361C35.5312 61.2801 37.68 63.0131 40.1319 64.2037C42.5838 65.3943 45.2745 66.0113 48.0002 66.0081C50.7225 66.0111 53.4099 65.3956 55.8594 64.2079C58.309 63.0202 60.4566 61.2914 62.1402 59.1521C62.6335 58.5278 63.3546 58.125 64.1449 58.0323C64.9352 57.9397 65.7299 58.1648 66.3542 58.6581C66.9785 59.1514 67.3813 59.8725 67.4739 60.6628C67.5666 61.4531 67.3415 62.2478 66.8482 62.8721C64.6031 65.7224 61.7401 68.0257 58.4752 69.6083C55.2102 71.1909 51.6285 72.0115 48.0002 72.0081C44.3672 72.0111 40.7811 71.188 37.513 69.601C34.245 68.0141 31.3805 65.7049 29.1362 62.8481C28.665 62.2215 28.4578 61.4354 28.5589 60.6579C28.66 59.8805 29.0615 59.1735 29.6774 58.6884C30.2932 58.2032 31.0745 57.9784 31.854 58.0621C32.6336 58.1458 33.3493 58.5313 33.8482 59.1361ZM36.0002 35.0001C36.6684 34.9812 37.3337 35.0965 37.9566 35.3391C38.5795 35.5818 39.1474 35.9469 39.6268 36.4129C40.1061 36.8789 40.4872 37.4363 40.7473 38.0521C41.0075 38.6679 41.1416 39.3296 41.1416 39.9981C41.1416 40.6666 41.0075 41.3283 40.7473 41.9441C40.4872 42.5599 40.1061 43.1173 39.6268 43.5833C39.1474 44.0493 38.5795 44.4144 37.9566 44.657C37.3337 44.8997 36.6684 45.015 36.0002 44.9961C34.6991 44.9593 33.4637 44.4166 32.5564 43.4833C31.6492 42.55 31.1416 41.2997 31.1416 39.9981C31.1416 38.6965 31.6492 37.4462 32.5564 36.5129C33.4637 35.5796 34.6991 35.0369 36.0002 35.0001ZM60.0002 35.0001C60.6684 34.9812 61.3337 35.0965 61.9566 35.3391C62.5795 35.5818 63.1474 35.9469 63.6268 36.4129C64.1061 36.8789 64.4872 37.4363 64.7473 38.0521C65.0075 38.6679 65.1416 39.3296 65.1416 39.9981C65.1416 40.6666 65.0075 41.3283 64.7473 41.9441C64.4872 42.5599 64.1061 43.1173 63.6268 43.5833C63.1474 44.0493 62.5795 44.4144 61.9566 44.657C61.3337 44.8997 60.6684 45.015 60.0002 44.9961C58.6991 44.9593 57.4637 44.4166 56.5564 43.4833C55.6492 42.55 55.1416 41.2997 55.1416 39.9981C55.1416 38.6965 55.6492 37.4462 56.5564 36.5129C57.4637 35.5796 58.6991 35.0369 60.0002 35.0001Z" fill="#010D33"></path>
                </svg>
                <h3>Great!</h3>
                <p>Quae tibi placent quicunq prosunt aut diligebat multum, quod memor sis ad</p>
                <div class="d-flex justify-content-center">
                    <div>
                        <button id="btn-accept-job-return-to-campaign" type="button" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 250px; height: 40px; white-space: nowrap;">
                            <span style="margin-top: 2px; font-size: 15px;">Return to campaigns</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Accept Job -->

{{-- carrega modal com detalhes da campanha (mobile) --}}
<div id="campaign_details_modal">

</div>


<!-- Start Modal New Add Your Job Link -->
<div
  class="modal fade"
  id="modal-select-post"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id='modal-select-post-body'>
        list of influencers posts
    </div>
  </div>
</div>
</div>
<!-- End Modal New Add Your Job Link -->

@endsection

@section('view-js')
<script>
$("#dashboard-header-title").html('Campaigns');

$("#campaigns-toggle-active").click();

$('#btn-decline-job-back').click(function() {
    var job = '#job-'+$(this).attr('campaign_id')+'-detail';
    var viewportWidth = $(window).width();
    if (viewportWidth > 575.98) {
        $(job).removeClass('d-none');
        $('#div-decline-job').addClass('d-none');
        $('#dashboard-header-title')[0].innerText = 'Jobs';
    }
});

$( "#decline_form" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'/decline-job',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'influencer_decline_motive': $('#textarea-decline-job').val(), 'campaign_id': $('#campaign_id').val()},
        success:function(data){
            if(data.status == 'success'){
                document.location.href = '/influencer-campaigns';
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

    //abas
    $('#toggle-campaign-jobs').click(function() {
        $('.guide-campaigns').addClass('d-none');
        $('#guide-jobs').removeClass('d-none');
    });

    $('#toggle-campaign-active').click(function() {
        $('.guide-campaigns').addClass('d-none');
        $('#guide-active').removeClass('d-none');
    });

    $('#toggle-campaign-scheduled').click(function() {
        $('.guide-campaigns').addClass('d-none');
        $('#guide-scheduled').removeClass('d-none');
    });

    $('#toggle-campaign-ended').click(function() {
        $('.guide-campaigns').addClass('d-none');
        $('#guide-ended').removeClass('d-none');
    });

    @if($tab)
    $('#toggle-campaign-{{$tab}}').click();
    @endif
    //abas end

    //return to campaign button after job accepted or refused
    $('#btn-return-to-campaign').click(function() {
        document.location.href = '/influencer-campaigns';
    });


    $('#btn-back-campaigns').click(function() {
        $('#btn-back-campaigns').addClass('d-none');
        $('#container-toggle-campaigns').removeClass('d-none');
        $('#guide-jobs .container-jobs').removeClass('d-none');
        $('#guide-jobs .job-details').addClass('d-none');
        $('#guide-active .container-card-campaign-active').removeClass('d-none');
        $('#guide-active .guide-campaigns-details').addClass('d-none');
        $('#guide-scheduled .container-card-campaign-active').removeClass('d-none');
        $('#guide-scheduled .guide-campaigns-details').addClass('d-none');
        $('#guide-ended .container-card-campaign-active').removeClass('d-none');
        $('#guide-ended .guide-campaigns-details').addClass('d-none');
        $('#div-accept-job').addClass('d-none');
        $('#div-decline-job').addClass('d-none');
        $('#dashboard-header-title')[0].innerText = 'Campaigns';
     });


    $('.btn-back-jobs').click(function() {
        var campaignId = $(this).attr('campaign_id');
        $('#job-'+campaignId+'-detail-mobile').modal('toggle')
    });

    // $('#btn-back-jobs').click(function() {
    //     $('#modal-main-menu-mobile-jobs').modal('toggle')
    // });

    // $('.btn-jobs-decline-job').click(function() {
    //     $('#modal-main-menu-mobile-decline-job').modal()
    // });


    $('#btn-back-decline-job').click(function() {
        $('#modal-main-menu-mobile-decline-job').modal('toggle')
    });

    $('#btn-back-accept-job').click(function() {
        document.location.href = '/influencer-campaigns';
    });

    $('#btn-accept-job-return-to-campaign').click(function() {
        document.location.href = '/influencer-campaigns';
    });
    
    $('#btn-decline-job-send-mobile').click(function() {
        $('#modal-main-menu-mobile-decline-job').modal('toggle')
        $('#modal-main-menu-mobile-jobs').modal('toggle')
    });

    $('#btn-decline-job-back-mobile').click(function() {
        $('#modal-main-menu-mobile-decline-job').modal('toggle')
    });
 </script>
@endsection