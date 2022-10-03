@if (isset($error))
<div id="container-social-accounts" class="mt-2">
    <x-alert/>
    <button type="button" 
    class="d-flex justify-content-center align-items-center btn btn-primary position-relative mt-1 mb-1" 
    style="font-size: 15px; height: 40px; width: 250px;">Reconnect Facebook
    </button>
</div>

@endif


@if (isset($fbPage))
<div id="container-social-accounts" class="mt-2">

    

    <div class="card-deck">
        
        <div class="card card-body mb-2" style="max-width: 335px;">
            <div class="d-flex align-items-center mb-2">
                <div class="custom-control custom-switch custom-control-inline mr-50 @if($fbPage['elegible'] == false) d-none @endif">
                    <input type="checkbox" class="switch-account custom-control-input d-none" id="accountSwitchFb" required="required" @if($fbPage['active']) checked @endif>
                    <label class="custom-control-label custom-control-label-influencer" for="accountSwitchFb">
                    </label>
                </div>
                <div class="d-flex flex-column align-items-center mr-1" style="width: 70px;">
                    <img src="{{$fbPage['profile_picture_url']}}" class="img-fluid rounded-circle" height="64" width="64">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 50px;margin-top: -60px;">
                        <circle cx="12" cy="12" r="12" fill="white"></circle>
                        <path d="M12.0007 5.33467C8.31938 5.33467 5.33472 8.31933 5.33472 12.0007C5.33472 15.3273 7.77205 18.0847 10.9594 18.5867V13.928H9.26605V12.0007H10.9594V10.532C10.9594 8.86 11.9547 7.938 13.4767 7.938C14.2061 7.938 14.9701 8.068 14.9701 8.068V9.70733H14.1274C13.3007 9.70733 13.0421 10.222 13.0421 10.7493V11.9993H14.8894L14.5941 13.9267H13.0421V18.5853C16.2294 18.086 18.6667 15.328 18.6667 12.0007C18.6667 8.31933 15.6821 5.33467 12.0007 5.33467Z" fill="#033FFF"></path>
                    </svg>
                    @if ($fbPage['elegible'])
                    <img src="../assets/images/tag-elegible.svg" style="margin-top: 25px;" height="22">
                    @else
                    <img src="../assets/images/tag-not-elegible.svg" style="margin-top: 25px;" height="22">
                    @endif
                </div>
                <div>
                    <a href="{{$fbPage['url']}}" target="_blank"><p class="p-500 primary mb-0">{{$fbPage['page_name']}}</p></a>
                    <p class="mb-0">{{thousandsFormat($fbPage['followers'])}} followers</p>
                    <p class="mb-0" style="font-size: 12px;"><i>more than 5,000 fans</i></p>
                </div>
            </div>
            @if (isset($instagram))
            <div class="d-flex align-items-center">
                <div class="custom-control custom-switch custom-control-inline mr-50 @if($instagram['elegible'] == false) d-none @endif">
                    <input type="checkbox" class="switch-account custom-control-input " id="accountSwitchInsta" required="required" @if($instagram['active']) checked @endif>
                    <label class="custom-control-label custom-control-label-influencer" for="accountSwitchInsta">
                    </label>
                </div>
                <div class="d-flex flex-column align-items-center mr-1" style="width: 70px;">
                    <img src="{{$instagram['profile_picture_url']}}" class="img-fluid rounded-circle" height="64" width="64">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 50px;margin-top: -60px;">
                        <circle cx="12" cy="12" r="12" fill="white"/>
                        <g>
                        <path d="M11.9994 8.918C11.1818 8.918 10.3978 9.24278 9.81964 9.82089C9.24153 10.399 8.91675 11.1831 8.91675 12.0007C8.91675 12.8182 9.24153 13.6023 9.81964 14.1804C10.3978 14.7586 11.1818 15.0833 11.9994 15.0833C12.817 15.0833 13.6011 14.7586 14.1792 14.1804C14.7573 13.6023 15.0821 12.8182 15.0821 12.0007C15.0821 11.1831 14.7573 10.399 14.1792 9.82089C13.6011 9.24278 12.817 8.918 11.9994 8.918ZM11.9994 14.0027C11.4683 14.0027 10.9589 13.7917 10.5833 13.4161C10.2077 13.0405 9.99675 12.5311 9.99675 12C9.99675 11.4689 10.2077 10.9595 10.5833 10.5839C10.9589 10.2083 11.4683 9.99733 11.9994 9.99733C12.5306 9.99733 13.0399 10.2083 13.4155 10.5839C13.7911 10.9595 14.0021 11.4689 14.0021 12C14.0021 12.5311 13.7911 13.0405 13.4155 13.4161C13.0399 13.7917 12.5306 14.0027 11.9994 14.0027Z" fill="#033FFF"/>
                        <path d="M15.204 9.52333C15.6009 9.52333 15.9227 9.20157 15.9227 8.80466C15.9227 8.40776 15.6009 8.086 15.204 8.086C14.8071 8.086 14.4854 8.40776 14.4854 8.80466C14.4854 9.20157 14.8071 9.52333 15.204 9.52333Z" fill="#033FFF"/>
                        <path d="M17.6888 8.074C17.5345 7.67545 17.2986 7.31352 16.9964 7.01137C16.6941 6.70922 16.3321 6.47351 15.9335 6.31933C15.467 6.14424 14.9742 6.04956 14.4761 6.03933C13.8341 6.01133 13.6308 6.00333 12.0028 6.00333C10.3748 6.00333 10.1661 6.00333 9.52946 6.03933C9.03172 6.04904 8.5393 6.14374 8.07346 6.31933C7.67476 6.47333 7.31264 6.70898 7.01035 7.01115C6.70807 7.31333 6.47228 7.67535 6.31813 8.074C6.143 8.54041 6.04854 9.03323 6.0388 9.53133C6.01013 10.1727 6.00146 10.376 6.00146 12.0047C6.00146 13.6327 6.00146 13.84 6.0388 14.478C6.0488 14.9767 6.1428 15.4687 6.31813 15.936C6.47272 16.3345 6.70873 16.6964 7.01109 16.9985C7.31345 17.3006 7.67551 17.5364 8.07413 17.6907C8.53909 17.8728 9.03171 17.9743 9.5308 17.9907C10.1728 18.0187 10.3761 18.0273 12.0041 18.0273C13.6321 18.0273 13.8408 18.0273 14.4775 17.9907C14.9755 17.9805 15.4683 17.8861 15.9348 17.7113C16.3333 17.5568 16.6952 17.3209 16.9974 17.0186C17.2997 16.7164 17.5356 16.3545 17.6901 15.956C17.8655 15.4893 17.9595 14.9973 17.9695 14.4987C17.9981 13.8573 18.0068 13.654 18.0068 12.0253C18.0068 10.3967 18.0068 10.19 17.9695 9.552C17.9617 9.04685 17.8668 8.54683 17.6888 8.074ZM16.8768 14.4287C16.8725 14.8129 16.8024 15.1935 16.6695 15.554C16.5693 15.8132 16.4161 16.0487 16.2195 16.2451C16.0229 16.4416 15.7874 16.5947 15.5281 16.6947C15.1716 16.827 14.795 16.8971 14.4148 16.902C13.7815 16.9313 13.6028 16.9387 11.9788 16.9387C10.3535 16.9387 10.1875 16.9387 9.54213 16.902C9.16208 16.8973 8.78568 16.8272 8.42946 16.6947C8.16926 16.5953 7.9328 16.4425 7.73539 16.246C7.53798 16.0495 7.38402 15.8137 7.28346 15.554C7.15243 15.1974 7.08234 14.8212 7.07613 14.4413C7.04746 13.808 7.0408 13.6293 7.0408 12.0053C7.0408 10.3807 7.0408 10.2147 7.07613 9.56867C7.08044 9.18468 7.15057 8.80428 7.28346 8.444C7.4868 7.918 7.90346 7.504 8.42946 7.30267C8.78586 7.17076 9.16215 7.10064 9.54213 7.09533C10.1761 7.06667 10.3541 7.05867 11.9788 7.05867C13.6035 7.05867 13.7701 7.05867 14.4148 7.09533C14.7951 7.09991 15.1717 7.17005 15.5281 7.30267C15.7874 7.40285 16.0229 7.55614 16.2194 7.75269C16.416 7.94924 16.5693 8.18472 16.6695 8.444C16.8005 8.80063 16.8706 9.17677 16.8768 9.55667C16.9055 10.1907 16.9128 10.3687 16.9128 11.9933C16.9128 13.6173 16.9128 13.792 16.8841 14.4293H16.8768V14.4287Z" fill="#033FFF"/>
                        </g>
                    </svg>
                    @if ($instagram['elegible'])
                    <img src="../assets/images/tag-elegible.svg" style="margin-top: 25px;" height="22">
                    @else
                    <img src="../assets/images/tag-not-elegible.svg" style="margin-top: 25px;" height="22">
                    @endif
                </div>
                <div>
                    <a href="{{$instagram['url']}}" target="_blank"><p class="p-500 primary mb-0">{{'@'.$instagram['page_name']}}</p></a>
                    <p class="mb-0">{{thousandsFormat($instagram['followers'])}} followers</p>
                    <p class="mb-0" style="font-size: 12px;"><i>more than 5,000 fans</i></p>
                </div>
            </div>
            @else 
            No instagram account attached to this facebook page.
            @endif
        </div>
        
    </div>
    
</div>

<div>
    <div class="card">
        <h5 class="card-header">Instagram statistics (last {{$analytics_period}} days).</h5>
        <div class="card-body">
            Number os posts: {{$instagram->postQuant}}
            <br>Total Impressions: {{$instagram->impressions}}
            <br>Average impressions: {{round($instagram->avgImpressions)}}
            <br>Total Reach: {{$instagram->reach}}
            <br>Average reach: {{round($instagram->avgReach)}}
            <br> Average likes & comments: {{round($instagram->avgEngagement,1)}}
            <br>Engagement: {{round($instagram->avgEngagementPercent,2)}}%
        </div>
    </div>
</div>

<!-- Start Modal Deactivate Account -->
@if (isset($fbPage))
<div
  class="modal fade modal_fb"
  id="modal-main-menu-mobile-deactivate-account"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div>
            <div class="card card-body mb-2" style="max-width: 335px;">

                <h3 class="text-center">Are you sure?</h3>

                <div class="d-flex justify-content-center align-items-center mb-2">
                    <div class="mr-50">
                        <p style="font-size: 16px;">Deactivate</p>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-1" style="width: 70px;">
                        <img src="{{$fbPage['profile_picture_url']}}" class="img-fluid rounded-circle" height="64" width="64">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 50px;margin-top: -60px;">
                            <circle cx="12" cy="12" r="12" fill="white"></circle>
                            <path d="M12.0007 5.33467C8.31938 5.33467 5.33472 8.31933 5.33472 12.0007C5.33472 15.3273 7.77205 18.0847 10.9594 18.5867V13.928H9.26605V12.0007H10.9594V10.532C10.9594 8.86 11.9547 7.938 13.4767 7.938C14.2061 7.938 14.9701 8.068 14.9701 8.068V9.70733H14.1274C13.3007 9.70733 13.0421 10.222 13.0421 10.7493V11.9993H14.8894L14.5941 13.9267H13.0421V18.5853C16.2294 18.086 18.6667 15.328 18.6667 12.0007C18.6667 8.31933 15.6821 5.33467 12.0007 5.33467Z" fill="#033FFF"></path>
                        </svg>
                        <img src="../assets/images/tag-elegible.svg" style="margin-top: 25px;" height="22">
                    </div>
                    <div>
                        <p id="modal_page_name" class="p-500 primary mb-0">{{$fbPage['page_name']}}</p>
                        <p id="modal_followers" class="mb-0">{{thousandsFormat($fbPage['followers'])}} followers</p>
                        <p class="mb-0" style="font-size: 12px;"><i>more than 5,000 fans</i></p>
                    </div>
                </div>

                <div class="d-flex">
                    <button type="button" id="btn-deactivate-account-fb-yes" social_media_id="{{$fbPage['id']}}" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 47%; height: 40px; white-space: nowrap;">yes</button>

                    <button type="button" id="btn-deactivate-account-fb-no" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 47%; height: 40px; white-space: nowrap;">no</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endif

@if (isset($instagram))
<div
  class="modal fade modal_insta"
  id="modal-main-menu-mobile-deactivate-account"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div>
            <div class="card card-body mb-2" style="max-width: 335px;">

                <h3 class="text-center">Are you sure?</h3>

                <div class="d-flex justify-content-center align-items-center mb-2">
                    <div class="mr-50">
                        <p style="font-size: 16px;">Deactivate</p>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-1" style="width: 70px;">
                        <img src="{{$instagram['profile_picture_url']}}" class="img-fluid rounded-circle" height="64" width="64">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 50px;margin-top: -60px;">
                            <circle cx="12" cy="12" r="12" fill="white"/>
                            <g>
                            <path d="M11.9994 8.918C11.1818 8.918 10.3978 9.24278 9.81964 9.82089C9.24153 10.399 8.91675 11.1831 8.91675 12.0007C8.91675 12.8182 9.24153 13.6023 9.81964 14.1804C10.3978 14.7586 11.1818 15.0833 11.9994 15.0833C12.817 15.0833 13.6011 14.7586 14.1792 14.1804C14.7573 13.6023 15.0821 12.8182 15.0821 12.0007C15.0821 11.1831 14.7573 10.399 14.1792 9.82089C13.6011 9.24278 12.817 8.918 11.9994 8.918ZM11.9994 14.0027C11.4683 14.0027 10.9589 13.7917 10.5833 13.4161C10.2077 13.0405 9.99675 12.5311 9.99675 12C9.99675 11.4689 10.2077 10.9595 10.5833 10.5839C10.9589 10.2083 11.4683 9.99733 11.9994 9.99733C12.5306 9.99733 13.0399 10.2083 13.4155 10.5839C13.7911 10.9595 14.0021 11.4689 14.0021 12C14.0021 12.5311 13.7911 13.0405 13.4155 13.4161C13.0399 13.7917 12.5306 14.0027 11.9994 14.0027Z" fill="#033FFF"/>
                            <path d="M15.204 9.52333C15.6009 9.52333 15.9227 9.20157 15.9227 8.80466C15.9227 8.40776 15.6009 8.086 15.204 8.086C14.8071 8.086 14.4854 8.40776 14.4854 8.80466C14.4854 9.20157 14.8071 9.52333 15.204 9.52333Z" fill="#033FFF"/>
                            <path d="M17.6888 8.074C17.5345 7.67545 17.2986 7.31352 16.9964 7.01137C16.6941 6.70922 16.3321 6.47351 15.9335 6.31933C15.467 6.14424 14.9742 6.04956 14.4761 6.03933C13.8341 6.01133 13.6308 6.00333 12.0028 6.00333C10.3748 6.00333 10.1661 6.00333 9.52946 6.03933C9.03172 6.04904 8.5393 6.14374 8.07346 6.31933C7.67476 6.47333 7.31264 6.70898 7.01035 7.01115C6.70807 7.31333 6.47228 7.67535 6.31813 8.074C6.143 8.54041 6.04854 9.03323 6.0388 9.53133C6.01013 10.1727 6.00146 10.376 6.00146 12.0047C6.00146 13.6327 6.00146 13.84 6.0388 14.478C6.0488 14.9767 6.1428 15.4687 6.31813 15.936C6.47272 16.3345 6.70873 16.6964 7.01109 16.9985C7.31345 17.3006 7.67551 17.5364 8.07413 17.6907C8.53909 17.8728 9.03171 17.9743 9.5308 17.9907C10.1728 18.0187 10.3761 18.0273 12.0041 18.0273C13.6321 18.0273 13.8408 18.0273 14.4775 17.9907C14.9755 17.9805 15.4683 17.8861 15.9348 17.7113C16.3333 17.5568 16.6952 17.3209 16.9974 17.0186C17.2997 16.7164 17.5356 16.3545 17.6901 15.956C17.8655 15.4893 17.9595 14.9973 17.9695 14.4987C17.9981 13.8573 18.0068 13.654 18.0068 12.0253C18.0068 10.3967 18.0068 10.19 17.9695 9.552C17.9617 9.04685 17.8668 8.54683 17.6888 8.074ZM16.8768 14.4287C16.8725 14.8129 16.8024 15.1935 16.6695 15.554C16.5693 15.8132 16.4161 16.0487 16.2195 16.2451C16.0229 16.4416 15.7874 16.5947 15.5281 16.6947C15.1716 16.827 14.795 16.8971 14.4148 16.902C13.7815 16.9313 13.6028 16.9387 11.9788 16.9387C10.3535 16.9387 10.1875 16.9387 9.54213 16.902C9.16208 16.8973 8.78568 16.8272 8.42946 16.6947C8.16926 16.5953 7.9328 16.4425 7.73539 16.246C7.53798 16.0495 7.38402 15.8137 7.28346 15.554C7.15243 15.1974 7.08234 14.8212 7.07613 14.4413C7.04746 13.808 7.0408 13.6293 7.0408 12.0053C7.0408 10.3807 7.0408 10.2147 7.07613 9.56867C7.08044 9.18468 7.15057 8.80428 7.28346 8.444C7.4868 7.918 7.90346 7.504 8.42946 7.30267C8.78586 7.17076 9.16215 7.10064 9.54213 7.09533C10.1761 7.06667 10.3541 7.05867 11.9788 7.05867C13.6035 7.05867 13.7701 7.05867 14.4148 7.09533C14.7951 7.09991 15.1717 7.17005 15.5281 7.30267C15.7874 7.40285 16.0229 7.55614 16.2194 7.75269C16.416 7.94924 16.5693 8.18472 16.6695 8.444C16.8005 8.80063 16.8706 9.17677 16.8768 9.55667C16.9055 10.1907 16.9128 10.3687 16.9128 11.9933C16.9128 13.6173 16.9128 13.792 16.8841 14.4293H16.8768V14.4287Z" fill="#033FFF"/>
                            </g>
                        </svg>
                        <img src="../assets/images/tag-elegible.svg" style="margin-top: 25px;" height="22">
                    </div>
                    <div>
                        <p id="modal_page_name" class="p-500 primary mb-0">{{'@'.$instagram['page_name']}}</p>
                        <p id="modal_followers" class="mb-0">{{thousandsFormat($instagram['followers'])}} followers</p>
                        <p class="mb-0" style="font-size: 12px;"><i>more than 5,000 fans</i></p>
                    </div>
                </div>

                <div class="d-flex">
                    <button type="button" id="btn-deactivate-account-insta-yes" social_media_id="{{$instagram['id']}}" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 47%; height: 40px; white-space: nowrap;">yes</button>

                    <button type="button" id="btn-deactivate-account-insta-no" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 47%; height: 40px; white-space: nowrap;">no</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div id="retorno-ajax">
</div>

@endif
<!-- End Modal Deactivate Account -->

<script>
    @if (isset($fbPage))
    $('#accountSwitchFb').click(function(e) {
        if ($(this)[0].checked == false) {
            e.preventDefault();
            $(this).addClass('clicked');
            $('.modal_fb').modal();
        } else {
            $.ajax({
                type:'POST',
                url:'/toggle-social-media',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'social_media_id': $('#btn-deactivate-account-fb-yes').attr('social_media_id'), 'action': 'activate'},
                success:function(data){
                }
            });
        }
    });

    $('#btn-deactivate-account-fb-yes').click(function(e) {
        $('.modal_fb').modal('toggle');
        $.ajax({
            type:'POST',
            url:'/toggle-social-media',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'social_media_id': $(this).attr('social_media_id'), 'action': 'deactivate'},
            success:function(data){
                $('#accountSwitchFb.clicked')[0].checked = false;
                $('#accountSwitchFb').removeClass('clicked');
            }
        });
    });

    $('#btn-deactivate-account-fb-no').click(function(e) {
        $('#accountSwitchFb').removeClass('clicked');
        $('.modal_fb').modal('toggle');
    });
    @endif

    @if (isset($instagram))
    $('#accountSwitchInsta').click(function(e) {
        if ($(this)[0].checked == false) {
            e.preventDefault();
            $(this).addClass('clicked');
            $('.modal_insta').modal();
        } else {
            $.ajax({
                type:'POST',
                url:'/toggle-social-media',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'social_media_id': $('#btn-deactivate-account-insta-yes').attr('social_media_id'), 'action': 'activate'},
                success:function(data){

                }
            });
        }
    });

    $('#btn-deactivate-account-insta-yes').click(function(e) {
        $('.modal_insta').modal('toggle');
        $.ajax({
            type:'POST',
            url:'/toggle-social-media',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'social_media_id': $(this).attr('social_media_id'), 'action': 'deactivate'},
            success:function(data){
                $('#accountSwitchInsta.clicked')[0].checked = false;
                $('#accountSwitchInsta').removeClass('clicked');
            }
        });
    });

    $('#btn-deactivate-account-insta-no').click(function(e) {
        $('#accountSwitchInsta').removeClass('clicked');
        $('.modal_insta').modal('toggle');
    });
    @endif

</script>

@endif