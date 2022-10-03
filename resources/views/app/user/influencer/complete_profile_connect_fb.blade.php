@extends('layouts.newCampaign')

@section('content')
<div class="mb-0 background-main">
    <div id="login-timeline" class="">

        <div class="login-header--logo text-center d-none d-sm-block">
            <img class="img-fluid" src="../assets/images/logo_horizontal_influencify_02.svg" alt="logo brand" style="width: 268px; height: 124px;">
        </div>

        <div class="timeline-login-influencer-mobile d-block d-sm-none">
            <svg id="btn-arrow-back-div-1a" width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back ml-2 mt-2">
                <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"/>
            </svg>
            <svg id="btn-arrow-back-div-1b" width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back ml-2 mt-2 d-none">
                <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"/>
            </svg>
            <svg id="btn-arrow-back-div-2" width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back ml-2 mt-2 d-none">
                <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"/>
            </svg>
            <svg id="btn-arrow-back-div-3" width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back ml-2 mt-2 d-none">
                <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"/>
            </svg>
            <svg id="btn-arrow-back-div-4" width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-arrow-back ml-2 mt-2 d-none">
                <path d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z" fill="#010D33"/>
            </svg>
            <hr id="hr-timeline-login-mobile" class="ml-0" style="height: 2px; background: linear-gradient(90deg, #033FFF 1.3%, #02EEFD 98.85%); border-radius: 0px 5px 5px 0px;">
        </div>

        <div class="justify-content-center timeline-login-influencer d-none d-sm-flex">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-1" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-1" class="badge-circle badge-circle-lg-influencer badge-circle-primary mx-auto my-0">1</div>
                <p class="primary">Connect your<br>
                    accounts</p>
            </div>

            <hr id="hr-1" class="gradient-line" style="margin-left: -17px; margin-right: -20px;">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-2" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-2" class="badge-circle badge-circle-lg-influencer badge-circle-secondary mx-auto my-0">2</div>
                <p>Receive cash &<br>
                    products</p>
            </div>

            <hr id="hr-2" style="margin-left: -20px; margin-right: 4px;">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-3" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-3" class="badge-circle badge-circle-lg-influencer badge-circle-secondary mx-auto my-0">3</div>
                <p>Select<br>
                    niches</p>
            </div>

            <hr id="hr-3" style="margin-left: 3px; margin-right: -20px;">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-4" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-4" class="badge-circle badge-circle-lg-influencer badge-circle-secondary mx-auto my-0">4</div>
                <p>Place your<br>
                    measurements</p>
            </div>

            <hr id="hr-4" style="margin-left: -21px; margin-right: -10px;">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-5" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-5" class="badge-circle badge-circle-lg-influencer badge-circle-secondary mx-auto my-0">5</div>
                <p>Finish<br>
                    onboarding</p>
            </div>

        </div>

        <div id="div-1a" class="text-center">
            <x-alert/>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.999 7.377C10.7726 7.377 9.59651 7.86417 8.72934 8.73134C7.86217 9.59851 7.375 10.7746 7.375 12.001C7.375 13.2274 7.86217 14.4035 8.72934 15.2707C9.59651 16.1378 10.7726 16.625 11.999 16.625C13.2254 16.625 14.4015 16.1378 15.2687 15.2707C16.1358 14.4035 16.623 13.2274 16.623 12.001C16.623 10.7746 16.1358 9.59851 15.2687 8.73134C14.4015 7.86417 13.2254 7.377 11.999 7.377ZM11.999 15.004C11.2023 15.004 10.4382 14.6875 9.87485 14.1241C9.31149 13.5608 8.995 12.7967 8.995 12C8.995 11.2033 9.31149 10.4392 9.87485 9.87585C10.4382 9.31249 11.2023 8.996 11.999 8.996C12.7957 8.996 13.5598 9.31249 14.1231 9.87585C14.6865 10.4392 15.003 11.2033 15.003 12C15.003 12.7967 14.6865 13.5608 14.1231 14.1241C13.5598 14.6875 12.7957 15.004 11.999 15.004Z" fill="#033FFF"/>
                <path d="M16.806 8.285C17.4014 8.285 17.884 7.80236 17.884 7.207C17.884 6.61163 17.4014 6.129 16.806 6.129C16.2107 6.129 15.728 6.61163 15.728 7.207C15.728 7.80236 16.2107 8.285 16.806 8.285Z" fill="#033FFF"/>
                <path d="M20.533 6.111C20.3015 5.51319 19.9477 4.97029 19.4943 4.51706C19.0409 4.06384 18.4979 3.71028 17.9 3.479C17.2003 3.21636 16.4611 3.07435 15.714 3.059C14.751 3.017 14.446 3.005 12.004 3.005C9.56195 3.005 9.24895 3.005 8.29395 3.059C7.54734 3.07356 6.80871 3.21561 6.10995 3.479C5.51189 3.71001 4.96872 4.06348 4.51529 4.51673C4.06186 4.96999 3.70818 5.51303 3.47695 6.111C3.21426 6.81062 3.07257 7.54984 3.05795 8.297C3.01495 9.259 3.00195 9.564 3.00195 12.007C3.00195 14.449 3.00195 14.76 3.05795 15.717C3.07295 16.465 3.21395 17.203 3.47695 17.904C3.70883 18.5018 4.06285 19.0446 4.51639 19.4978C4.96993 19.951 5.51302 20.3046 6.11095 20.536C6.80839 20.8092 7.54732 20.9614 8.29595 20.986C9.25895 21.028 9.56395 21.041 12.006 21.041C14.448 21.041 14.761 21.041 15.716 20.986C16.4631 20.9708 17.2022 20.8291 17.902 20.567C18.4997 20.3352 19.0426 19.9813 19.4959 19.528C19.9493 19.0746 20.3031 18.5318 20.535 17.934C20.798 17.234 20.939 16.496 20.954 15.748C20.997 14.786 21.01 14.481 21.01 12.038C21.01 9.59501 21.01 9.285 20.954 8.328C20.9423 7.57028 20.7999 6.82025 20.533 6.111ZM19.315 15.643C19.3085 16.2193 19.2033 16.7902 19.004 17.331C18.8538 17.7199 18.6239 18.073 18.329 18.3677C18.0342 18.6624 17.6809 18.8921 17.292 19.042C16.7572 19.2405 16.1923 19.3456 15.622 19.353C14.672 19.397 14.404 19.408 11.968 19.408C9.52995 19.408 9.28095 19.408 8.31295 19.353C7.74288 19.346 7.17828 19.2408 6.64395 19.042C6.25364 18.893 5.89895 18.6637 5.60284 18.369C5.30673 18.0742 5.07579 17.7206 4.92495 17.331C4.7284 16.7961 4.62326 16.2318 4.61395 15.662C4.57095 14.712 4.56095 14.444 4.56095 12.008C4.56095 9.571 4.56095 9.322 4.61395 8.353C4.62042 7.77703 4.72561 7.20642 4.92495 6.666C5.22995 5.877 5.85495 5.256 6.64395 4.954C7.17854 4.75614 7.74298 4.65097 8.31295 4.643C9.26395 4.6 9.53095 4.588 11.968 4.588C14.405 4.588 14.655 4.588 15.622 4.643C16.1924 4.64987 16.7573 4.75508 17.292 4.954C17.6809 5.10428 18.0341 5.33421 18.3289 5.62903C18.6238 5.92386 18.8537 6.27708 19.004 6.666C19.2005 7.20095 19.3056 7.76516 19.315 8.335C19.358 9.28601 19.369 9.553 19.369 11.99C19.369 14.426 19.369 14.688 19.326 15.644H19.315V15.643Z" fill="#033FFF"/>
            </svg>
                

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.001 2.002C6.47895 2.002 2.00195 6.479 2.00195 12.001C2.00195 16.991 5.65795 21.127 10.439 21.88V14.892H7.89895V12.001H10.439V9.798C10.439 7.29 11.932 5.907 14.215 5.907C15.309 5.907 16.455 6.102 16.455 6.102V8.561H15.191C13.951 8.561 13.563 9.333 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.479 17.523 2.002 12.001 2.002Z" fill="#033FFF"/>
            </svg>

            <h3>Connect your accounts</h3>
            
            <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>

            <div class="card card-body">
                <p class="p-500">To connect an Instagram Account:</p>

                <div class="d-flex text-left">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 mr-1" style="min-width: 24px; min-height: 24px">
                        <circle cx="12" cy="12" r="12" fill="#033FFF"/>
                        <path d="M13.0689 7.9V17H11.2879V9.707L9.50689 10.435V8.888L11.9379 7.9H13.0689Z" fill="white"/>
                    </svg>
                    <p>You must have a Business or Content Creator account</p> 
                </div>

                <div class="d-flex text-left">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 mr-1" style="min-width: 24px; min-height: 24px">
                        <circle cx="12" cy="12" r="12" fill="#033FFF"/>
                        <path d="M8.76793 17V15.752L12.3559 12.541C12.7633 12.1683 13.0536 11.8433 13.2269 11.566C13.4003 11.28 13.4869 10.9853 13.4869 10.682C13.4869 10.2833 13.3309 9.954 13.0189 9.694C12.7069 9.434 12.3169 9.304 11.8489 9.304C11.4156 9.304 11.0083 9.39067 10.6269 9.564C10.2543 9.73733 9.84693 10.0233 9.40493 10.422L8.40393 9.226C8.93259 8.74933 9.49159 8.38967 10.0809 8.147C10.6703 7.90433 11.2769 7.783 11.9009 7.783C12.3863 7.783 12.8326 7.85233 13.2399 7.991C13.6559 8.121 14.0069 8.30733 14.2929 8.55C14.5876 8.79267 14.8129 9.08733 14.9689 9.434C15.1336 9.78067 15.2159 10.1577 15.2159 10.565C15.2159 11.085 15.0859 11.566 14.8259 12.008C14.5659 12.45 14.1153 12.957 13.4739 13.529L11.2509 15.505H15.3329V17H8.76793Z" fill="white"/>
                    </svg>
                        
                    <p>It is necessary to have a FanPage linked on Facebook</p>
                </div>

                <p class="p-500">If you want to advertise using Facebook you just need to have a FanPage</p>
                <a href="{{ url('auth/facebook') }}">
                    <button type="button" id="btn-connect-account" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center mw-100" data-toggle="modal" style="height: 44px; white-space: nowrap;">
                        <i class="bx bxl-facebook-circle" style="margin-right: 10px; margin-bottom: 7px; font-size: 22px;"></i>
                        <span>Connect using Facebook</span>
                    </button>
                </a>
            </div>
                    
        </div>

    </div>
</div>
@endsection
