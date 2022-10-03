<div id="campaign-{{$campaign->id}}" class="card">
    <div class="card-body">
        {{-- duplicate & campaign details --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="title">{{$campaign->name}}</p>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex pr-1">
                            <i class="bx bx-layer-plus" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            <a class="btn-duplicate" href="{{url("campaign-create/$campaign->id")}}" style="text-decoration: underline;">duplicate</a>
                        </div>
                        <div class="d-flex btn-campaign-details" campaignId="{{$campaign->id}}">
                            <i class="bx bxs-info-circle" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            <a href="#" style="text-decoration: underline;">campaign details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end duplicate & campaign details --}}
        {{-- card main row --}}
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xl-2 col-md-2 col-sm-6">
                <img src="../assets/images/campaign-img.png" class="img-fluid image-campaign">
            </div>
            <div class="col-xl-3 col-md-3 col-sm-6">
                <div class="d-flex">
                    <div class="pr-50">
                        <p class="title" style="font-size: 15px;">Created</p>
                        <p class="title" style="font-size: 15px;">Starts</p>
                        <p class="title" style="font-size: 15px;">Ends</p>
                    </div>
                    <div>
                        <p>{{$campaign->created_at()}}</p>
                        <p>{{$campaign->starts()}}</p>
                        <p>{{$campaign->ends()}}</p>
                    </div>
                </div>
                @if ($campaign->status() == 'scheduled' AND $campaign->manual_select_influencers)
                @php
                    $selected_influencers_quant = $campaign->selectedInfluencersCount();
                @endphp
                <div>
                    <button type="button" id="btn-select-influencers" class="btn btn-secondary position-relative font-weight-normal mt-1 @if($selected_influencers_quant) btn-select-influencers-clicked @endif" style="white-space: nowrap;" campaignId="{{$campaign->id}}">
                        @if($selected_influencers_quant)
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="#747E9F" style="margin-right: 6px;" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.75 15C15.716 15 16.5 15.784 16.5 16.75L16.499 17.712C16.616 19.902 14.988 21.009 12.067 21.009C9.157 21.009 7.5 19.919 7.5 17.75V16.75C7.5 15.784 8.284 15 9.25 15H14.75ZM14.75 16.5H9.25C9.18369 16.5 9.12011 16.5263 9.07322 16.5732C9.02634 16.6201 9 16.6837 9 16.75V17.75C9 18.926 9.887 19.509 12.067 19.509C14.235 19.509 15.062 18.945 15 17.752V16.75C15 16.6837 14.9737 16.6201 14.9268 16.5732C14.8799 16.5263 14.8163 16.5 14.75 16.5ZM3.75 10H8.126C8 10.4895 7.96777 10.9985 8.031 11.5H3.75C3.6837 11.5 3.62011 11.5263 3.57322 11.5732C3.52634 11.6201 3.5 11.6837 3.5 11.75V12.75C3.5 13.926 4.387 14.509 6.567 14.509C7.029 14.509 7.43 14.483 7.774 14.432C7.20183 14.7945 6.78401 15.3559 6.601 16.008L6.567 16.009C3.657 16.009 2 14.919 2 12.75V11.75C2 10.784 2.784 10 3.75 10ZM20.25 10C21.216 10 22 10.784 22 11.75L21.999 12.712C22.116 14.902 20.488 16.009 17.567 16.009L17.398 16.007C17.2094 15.337 16.7743 14.7633 16.18 14.401C16.567 14.473 17.027 14.509 17.567 14.509C19.735 14.509 20.562 13.945 20.5 12.752V11.75C20.5 11.6837 20.4737 11.6201 20.4268 11.5732C20.3799 11.5263 20.3163 11.5 20.25 11.5H15.97C16.0319 10.9984 15.9993 10.4896 15.874 10H20.25ZM12 8C12.394 8 12.7841 8.0776 13.148 8.22836C13.512 8.37912 13.8427 8.6001 14.1213 8.87868C14.3999 9.15725 14.6209 9.48797 14.7716 9.85195C14.9224 10.2159 15 10.606 15 11C15 11.394 14.9224 11.7841 14.7716 12.148C14.6209 12.512 14.3999 12.8427 14.1213 13.1213C13.8427 13.3999 13.512 13.6209 13.148 13.7716C12.7841 13.9224 12.394 14 12 14C11.2043 14 10.4413 13.6839 9.87868 13.1213C9.31607 12.5587 9 11.7956 9 11C9 10.2043 9.31607 9.44129 9.87868 8.87868C10.4413 8.31607 11.2043 8 12 8ZM12 9.5C11.803 9.5 11.608 9.5388 11.426 9.61418C11.244 9.68956 11.0786 9.80005 10.9393 9.93934C10.8 10.0786 10.6896 10.244 10.6142 10.426C10.5388 10.608 10.5 10.803 10.5 11C10.5 11.197 10.5388 11.392 10.6142 11.574C10.6896 11.756 10.8 11.9214 10.9393 12.0607C11.0786 12.1999 11.244 12.3104 11.426 12.3858C11.608 12.4612 11.803 12.5 12 12.5C12.3978 12.5 12.7794 12.342 13.0607 12.0607C13.342 11.7794 13.5 11.3978 13.5 11C13.5 10.6022 13.342 10.2206 13.0607 9.93934C12.7794 9.65803 12.3978 9.5 12 9.5ZM6.5 3C7.29565 3 8.05871 3.31607 8.62132 3.87868C9.18393 4.44129 9.5 5.20435 9.5 6C9.5 6.79565 9.18393 7.55871 8.62132 8.12132C8.05871 8.68393 7.29565 9 6.5 9C5.70435 9 4.94129 8.68393 4.37868 8.12132C3.81607 7.55871 3.5 6.79565 3.5 6C3.5 5.20435 3.81607 4.44129 4.37868 3.87868C4.94129 3.31607 5.70435 3 6.5 3ZM17.5 3C18.2956 3 19.0587 3.31607 19.6213 3.87868C20.1839 4.44129 20.5 5.20435 20.5 6C20.5 6.79565 20.1839 7.55871 19.6213 8.12132C19.0587 8.68393 18.2956 9 17.5 9C16.7043 9 15.9413 8.68393 15.3787 8.12132C14.8161 7.55871 14.5 6.79565 14.5 6C14.5 5.20435 14.8161 4.44129 15.3787 3.87868C15.9413 3.31607 16.7043 3 17.5 3ZM6.5 4.5C6.10217 4.5 5.72064 4.65803 5.43934 4.93934C5.15803 5.22064 5 5.60217 5 6C5 6.39782 5.15803 6.77936 5.43934 7.06066C5.72064 7.34196 6.10217 7.5 6.5 7.5C6.89782 7.5 7.27936 7.34196 7.56066 7.06066C7.84196 6.77936 8 6.39782 8 6C8 5.60217 7.84196 5.22064 7.56066 4.93934C7.27936 4.65803 6.89782 4.5 6.5 4.5ZM17.5 4.5C17.1022 4.5 16.7206 4.65803 16.4393 4.93934C16.158 5.22064 16 5.60217 16 6C16 6.39782 16.158 6.77936 16.4393 7.06066C16.7206 7.34196 17.1022 7.5 17.5 7.5C17.8978 7.5 18.2794 7.34196 18.5607 7.06066C18.842 6.77936 19 6.39782 19 6C19 5.60217 18.842 5.22064 18.5607 4.93934C18.2794 4.65803 17.8978 4.5 17.5 4.5Z"/>
                            </svg>
                            {{$selected_influencers_quant}} selected Influencers
                        @else
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-right: 3px;">
                                <path d="M14.75 15C15.716 15 16.5 15.784 16.5 16.75L16.499 17.712C16.616 19.902 14.988 21.009 12.067 21.009C9.157 21.009 7.5 19.919 7.5 17.75V16.75C7.5 15.784 8.284 15 9.25 15H14.75ZM14.75 16.5H9.25C9.18369 16.5 9.12011 16.5263 9.07322 16.5732C9.02634 16.6201 9 16.6837 9 16.75V17.75C9 18.926 9.887 19.509 12.067 19.509C14.235 19.509 15.062 18.945 15 17.752V16.75C15 16.6837 14.9737 16.6201 14.9268 16.5732C14.8799 16.5263 14.8163 16.5 14.75 16.5ZM3.75 10H8.126C8 10.4895 7.96777 10.9985 8.031 11.5H3.75C3.6837 11.5 3.62011 11.5263 3.57322 11.5732C3.52634 11.6201 3.5 11.6837 3.5 11.75V12.75C3.5 13.926 4.387 14.509 6.567 14.509C7.029 14.509 7.43 14.483 7.774 14.432C7.20183 14.7945 6.78401 15.3559 6.601 16.008L6.567 16.009C3.657 16.009 2 14.919 2 12.75V11.75C2 10.784 2.784 10 3.75 10ZM20.25 10C21.216 10 22 10.784 22 11.75L21.999 12.712C22.116 14.902 20.488 16.009 17.567 16.009L17.398 16.007C17.2094 15.337 16.7743 14.7633 16.18 14.401C16.567 14.473 17.027 14.509 17.567 14.509C19.735 14.509 20.562 13.945 20.5 12.752V11.75C20.5 11.6837 20.4737 11.6201 20.4268 11.5732C20.3799 11.5263 20.3163 11.5 20.25 11.5H15.97C16.0319 10.9984 15.9993 10.4896 15.874 10H20.25ZM12 8C12.394 8 12.7841 8.0776 13.148 8.22836C13.512 8.37912 13.8427 8.6001 14.1213 8.87868C14.3999 9.15725 14.6209 9.48797 14.7716 9.85195C14.9224 10.2159 15 10.606 15 11C15 11.394 14.9224 11.7841 14.7716 12.148C14.6209 12.512 14.3999 12.8427 14.1213 13.1213C13.8427 13.3999 13.512 13.6209 13.148 13.7716C12.7841 13.9224 12.394 14 12 14C11.2043 14 10.4413 13.6839 9.87868 13.1213C9.31607 12.5587 9 11.7956 9 11C9 10.2043 9.31607 9.44129 9.87868 8.87868C10.4413 8.31607 11.2043 8 12 8ZM12 9.5C11.803 9.5 11.608 9.5388 11.426 9.61418C11.244 9.68956 11.0786 9.80005 10.9393 9.93934C10.8 10.0786 10.6896 10.244 10.6142 10.426C10.5388 10.608 10.5 10.803 10.5 11C10.5 11.197 10.5388 11.392 10.6142 11.574C10.6896 11.756 10.8 11.9214 10.9393 12.0607C11.0786 12.1999 11.244 12.3104 11.426 12.3858C11.608 12.4612 11.803 12.5 12 12.5C12.3978 12.5 12.7794 12.342 13.0607 12.0607C13.342 11.7794 13.5 11.3978 13.5 11C13.5 10.6022 13.342 10.2206 13.0607 9.93934C12.7794 9.65803 12.3978 9.5 12 9.5ZM6.5 3C7.29565 3 8.05871 3.31607 8.62132 3.87868C9.18393 4.44129 9.5 5.20435 9.5 6C9.5 6.79565 9.18393 7.55871 8.62132 8.12132C8.05871 8.68393 7.29565 9 6.5 9C5.70435 9 4.94129 8.68393 4.37868 8.12132C3.81607 7.55871 3.5 6.79565 3.5 6C3.5 5.20435 3.81607 4.44129 4.37868 3.87868C4.94129 3.31607 5.70435 3 6.5 3ZM17.5 3C18.2956 3 19.0587 3.31607 19.6213 3.87868C20.1839 4.44129 20.5 5.20435 20.5 6C20.5 6.79565 20.1839 7.55871 19.6213 8.12132C19.0587 8.68393 18.2956 9 17.5 9C16.7043 9 15.9413 8.68393 15.3787 8.12132C14.8161 7.55871 14.5 6.79565 14.5 6C14.5 5.20435 14.8161 4.44129 15.3787 3.87868C15.9413 3.31607 16.7043 3 17.5 3ZM6.5 4.5C6.10217 4.5 5.72064 4.65803 5.43934 4.93934C5.15803 5.22064 5 5.60217 5 6C5 6.39782 5.15803 6.77936 5.43934 7.06066C5.72064 7.34196 6.10217 7.5 6.5 7.5C6.89782 7.5 7.27936 7.34196 7.56066 7.06066C7.84196 6.77936 8 6.39782 8 6C8 5.60217 7.84196 5.22064 7.56066 4.93934C7.27936 4.65803 6.89782 4.5 6.5 4.5ZM17.5 4.5C17.1022 4.5 16.7206 4.65803 16.4393 4.93934C16.158 5.22064 16 5.60217 16 6C16 6.39782 16.158 6.77936 16.4393 7.06066C16.7206 7.34196 17.1022 7.5 17.5 7.5C17.8978 7.5 18.2794 7.34196 18.5607 7.06066C18.842 6.77936 19 6.39782 19 6C19 5.60217 18.842 5.22064 18.5607 4.93934C18.2794 4.65803 17.8978 4.5 17.5 4.5Z"/>
                            </svg> 
                            Select influencers
                        @endif
                    </button>
                </div>
                @endif
            </div>
            {{-- card body second part --}}
            <div class="col-xl-7 col-md-7 col-sm-6 d-flex justify-content-around" style="border-radius: 10px;">
                @if ($campaign->status() == 'scheduled')
                    <div class="d-flex justify-content-center align-items-center w-100 h-100" style="position: absolute;">
                        <p class="mb-0 red-hat-text" style="color: #010D33; font-size: 18px;">Your campaign statistics will appear here</p>
                    </div>
                @endif
                @if ($campaign->status() == 'ended' AND $campaign->fundsReleased()==false)
                    <div class="text-center btn-secondary d-flex flex-column justify-content-around btn-release-funds" style="padding: 10px; cursor: pointer; height: auto;" campaignId="{{$campaign->id}}">
                        <svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M34.5 4C35.2223 4 35.9375 4.14226 36.6048 4.41866C37.272 4.69506 37.8784 5.10019 38.3891 5.61091C38.8998 6.12163 39.3049 6.72795 39.5813 7.39524C39.8577 8.06253 40 8.77773 40 9.5V24.308C39.0382 23.9681 38.0057 23.8793 37 24.05V9.5C37 8.12 35.88 7 34.5 7H9.5C8.12 7 7 8.12 7 9.5V34.5C7 35.88 8.12 37 9.5 37H28.4C28.144 37.604 28 38.268 28 38.968C28 39.318 28.02 39.664 28.054 40H9.5C8.77773 40 8.06253 39.8577 7.39524 39.5813C6.72795 39.3049 6.12163 38.8998 5.61091 38.3891C5.10019 37.8784 4.69506 37.272 4.41866 36.6048C4.14226 35.9375 4 35.2223 4 34.5V9.5C4 8.04131 4.57946 6.64236 5.61091 5.61091C6.64236 4.57946 8.04131 4 9.5 4H34.5ZM18 26.878L30.94 13.938C31.2076 13.6696 31.567 13.5125 31.9457 13.4983C32.3245 13.484 32.6946 13.6137 32.9817 13.8612C33.2687 14.1087 33.4514 14.4558 33.493 14.8325C33.5347 15.2093 33.4321 15.5878 33.206 15.892L33.06 16.06L19.06 30.06C18.806 30.314 18.4693 30.4685 18.1111 30.4953C17.7529 30.5221 17.3969 30.4194 17.108 30.206L16.94 30.06L10.94 24.06C10.6741 23.792 10.519 23.4336 10.5057 23.0563C10.4924 22.679 10.6219 22.3105 10.8683 22.0245C11.1147 21.7385 11.4599 21.5558 11.835 21.5131C12.2102 21.4704 12.5876 21.5707 12.892 21.794L13.06 21.94L18 26.878Z"/>
                            <path d="M38 32C38 32.5304 37.7893 33.0391 37.4142 33.4142C37.0391 33.7893 36.5304 34 36 34C35.4696 34 34.9609 33.7893 34.5858 33.4142C34.2107 33.0391 34 32.5304 34 32C34 31.4696 34.2107 30.9609 34.5858 30.5858C34.9609 30.2107 35.4696 30 36 30C36.5304 30 37.0391 30.2107 37.4142 30.5858C37.7893 30.9609 38 31.4696 38 32ZM37 32C37 31.7348 36.8946 31.4804 36.7071 31.2929C36.5196 31.1054 36.2652 31 36 31C35.7348 31 35.4804 31.1054 35.2929 31.2929C35.1054 31.4804 35 31.7348 35 32C35 32.2652 35.1054 32.5196 35.2929 32.7071C35.4804 32.8946 35.7348 33 36 33C36.2652 33 36.5196 32.8946 36.7071 32.7071C36.8946 32.5196 37 32.2652 37 32Z"/>
                            <path d="M30 29.25C30 28.56 30.56 28 31.25 28H40.75C41.44 28 42 28.56 42 29.25V34.75C42 35.44 41.44 36 40.75 36H31.25C30.56 36 30 35.44 30 34.75V29.25ZM31.25 29C31.1837 29 31.1201 29.0263 31.0732 29.0732C31.0263 29.1201 31 29.1837 31 29.25V30H31.5C31.6326 30 31.7598 29.9473 31.8536 29.8536C31.9473 29.7598 32 29.6326 32 29.5V29H31.25ZM31 34.75C31 34.888 31.112 35 31.25 35H32V34.5C32 34.3674 31.9473 34.2402 31.8536 34.1464C31.7598 34.0527 31.6326 34 31.5 34H31V34.75ZM33 34.5V35H39V34.5C39 34.1022 39.158 33.7206 39.4393 33.4393C39.7206 33.158 40.1022 33 40.5 33H41V31H40.5C40.1022 31 39.7206 30.842 39.4393 30.5607C39.158 30.2794 39 29.8978 39 29.5V29H33V29.5C33 29.8978 32.842 30.2794 32.5607 30.5607C32.2794 30.842 31.8978 31 31.5 31H31V33H31.5C31.8978 33 32.2794 33.158 32.5607 33.4393C32.842 33.7206 33 34.1022 33 34.5ZM40 35H40.75C40.8163 35 40.8799 34.9737 40.9268 34.9268C40.9737 34.8799 41 34.8163 41 34.75V34H40.5C40.3674 34 40.2402 34.0527 40.1464 34.1464C40.0527 34.2402 40 34.3674 40 34.5V35ZM41 30V29.25C41 29.1837 40.9737 29.1201 40.9268 29.0732C40.8799 29.0263 40.8163 29 40.75 29H40V29.5C40 29.6326 40.0527 29.7598 40.1464 29.8536C40.2402 29.9473 40.3674 30 40.5 30H41Z"/>
                            <path d="M33.5002 38C33.1835 38.0001 32.8748 37.8999 32.6184 37.7138C32.3621 37.5277 32.1712 37.2652 32.0732 36.964C32.2122 36.988 32.3542 37 32.5002 37H40.7502C41.347 37 41.9193 36.7629 42.3412 36.341C42.7632 35.919 43.0002 35.3467 43.0002 34.75V30.085C43.2928 30.1884 43.5461 30.38 43.7252 30.6335C43.9043 30.8869 44.0004 31.1896 44.0002 31.5V34.75C44.0002 35.1768 43.9162 35.5994 43.7529 35.9937C43.5895 36.388 43.3501 36.7463 43.0483 37.0481C42.7465 37.3498 42.3883 37.5892 41.994 37.7526C41.5997 37.9159 41.177 38 40.7502 38H33.5002Z"/>
                        </svg>
                        <button type="submit" class="btn btn-primary position-relative font-weight-normal w-100" style="margin-top: 2px; height: auto;">Release funds</button>
                    </div>
                @endif
                <div class="text-center influencers-selected @if ($campaign->status() == 'scheduled') pending-campaign @endif" onclick="seeHideInfluencers('#campaign-{{$campaign->id}}')" style="margin-left: 5px; cursor: pointer; height: auto;">
                    <div style="margin-top: @if ($campaign->status() == 'ended' AND $campaign->fundsReleased()==false)30px @else 16px @endif;">
                    <div class="d-flex justify-content-center" style="margin-top: 12px;">
                        @foreach ($campaign->influencers as $influencer)
                            @if ($loop->first)
                                <img src="{{$influencer->avatarImg()}}" class="img-influencer rounded-circle" height="48px" width="48px">
                            @else
                                <img src="{{$influencer->avatarImg()}}" class="img-influencer rounded-circle" height="48px" width="48px" style="margin-left: -20px;" >
                            @endif
                        @endforeach
                    </div>
                    <p style="font-size: 20px;font-weight: 500; margin-top: 2px;">{{$campaign->influencers->count()}} @if($campaign->influencers->count()==1) influencer @else influencers @endif</p>
                    </div>
                </div>
                <div id="div-impressions-clicks" class="d-flex justify-content-around w-50 h-100 my-auto p-1 impressions-clicks-selected @if ($campaign->status() == 'scheduled') pending-campaign @endif" onclick="seeHideAnalytics('#campaign-{{$campaign->id}}','{{$campaign->id}}')" style="cursor: pointer;">
                    <div class="text-center mr-50" style="margin-top: 12px;">
                        <p class="title-item-campaign-selected" style="font-size: 40px;">{{thousandsFormat($campaign->impression_count())}}</p>
                        <p style="font-size: 20px; font-weight: 500; margin-bottom: 0;">impressions</p>
                    </div>
                    @php
                        $clicksConversions = $campaign->clicks();
                    @endphp
                    @if($clicksConversions)
                        <div class="text-center" style="margin-top: 12px;">
                            <p class="title-item-campaign-selected" style="font-size: 40px;">{{thousandsFormat($clicksConversions['clicks'])}}</p>
                            <p style="font-size: 20px; font-weight: 500; margin-bottom: 0;">clicks</p>
                        </div>
                        @if($campaign->goal == 'purchase' OR $campaign->goal == 'registrations')
                        <div class="text-center" style="margin-top: 12px;">
                            <p class="title-item-campaign-selected" style="font-size: 40px;">{{thousandsFormat($clicksConversions['conversions'])}}</p>
                            <p style="font-size: 20px; font-weight: 500; margin-bottom: 0;">conversions</p>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="d-flex justify-content-around w-50 h-100 my-auto p-1 @if ($campaign->status() == 'scheduled') pending-campaign @endif">
                    <div class="text-center mr-50" style="margin-top: 12px;">
                        <p class="title-item-campaign-selected" style="font-size: 40px;">${{thousandsFormat($campaign->budget, true)}}</p>
                        <p style="font-size: 20px; font-weight: 500; margin-bottom: 0;">Spent</p>
                    </div>
                </div>
            </div>{{-- card body second part end--}}
            
        </div>{{-- end card main row --}}
        {{-- see analytics --}}
        @if ($campaign->status() != 'scheduled')
        <div class="row mt-n2">
            <div class="col-xl-2 col-md-2 col-sm-6"></div>
            <div class="col-xl-10 col-md-3 col-sm-6">
                <div class="d-flex pt-1">
                    <i class="bx bx-line-chart" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                    <a href="javascript:seeHideAnalytics('#campaign-{{$campaign->id}}','{{$campaign->id}}');" class="see-hide-analytics" style="text-decoration: underline;">see analytics</a>
                </div>
            </div>
        </div>
        {{-- end see analytics --}}
        <hr class="mt-2 mb-2 d-none" style="border: solid 1px #000000; opacity: 0.1;">
        {{-- influencer posts list --}}
        <div class="container-influencers d-none">
            <div class="d-flex overflow-auto">
                @foreach ($campaign->influencers as $influencer)
                @php
                    $posts = $influencer->influencerCampaignPosts($campaign->id);
                @endphp
                <div>
                  <div class="card-influencer d-flex justify-content-between align-items-center m-1 p-2">
                      <div class="pr-1">
                        <img src="{{$influencer->avatarImg()}}" class="rounded-circle" width="72" height="72">
                      </div>
                      <div>
                        <p class="mb-0 red-hat-text" style="font-size: 15px; font-weight: 500 !important; color: #010D33;">{{$influencer->name}}</p>
                        @if ($posts)
                        {{-- atalho do tracking link deste influencer para esta campanha para testes --}}
                        <div class="d-flex pr-1 mb-1">
                            <i class="bx bx-link-alt" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            <a href="{{$influencer->pivot->tracking_link_url}}" target="_blank" style="text-decoration: underline;">Tracking Link</a>
                        </div>
                        {{-- atalho do tracking link deste influencer para esta campanha para testes --}}
                        @foreach ($posts as $post)
                          <div class="d-flex pr-1">
                            <i class="bx bx-link-alt" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            <a href="{{$post->permalink}}" target="_blank" style="text-decoration: underline;">View post {{$loop->iteration}}</a>
                          </div>
                          @endforeach
                          @else
                            <div class="d-flex pr-1">
                                No post yet
                            </div>
                          @endif
                      </div>
                  </div>
                </div>
                @endforeach

              </div>
        </div>
        {{-- end influencer posts list --}}
        <div id="container-analytics{{$campaign->id}}" analytics-loaded="false" class="container-analytics">
            {{-- ajax loaded --}}
        </div>
        {{-- analytics end--}}
        @endif
    </div>{{-- end card-body --}}
</div>