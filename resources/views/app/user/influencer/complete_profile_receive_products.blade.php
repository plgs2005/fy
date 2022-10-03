@extends('layouts.register')

@section('content')
<div class="mb-0 background-main">
    <div id="login-timeline">
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
                <img id="icon-check-1" src="../assets/images/icon-check-small.png" class="img-fluid">
                <p class="primary">Connect your<br>
                    accounts</p>
            </div>

            <hr id="hr-1" class="primary-line" style="margin-left: -17px; margin-right: -20px;">

            <div class="container-marker-timeline-login-influencer text-center">
                <img id="icon-check-2" src="../assets/images/icon-check-small.png" class="img-fluid d-none">
                <div id="marker-timeline-login-influencer-2" class="badge-circle badge-circle-lg-influencer badge-circle-primary mx-auto my-0">2</div>
                <p>Receive cash &<br>
                    products</p>
            </div>

            <hr id="hr-2" class="gradient-line" style="margin-left: -20px; margin-right: 4px;">

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

        <div id="div-2" class="text-center">
            <div class="card card-body mb-2">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-50">
                    <path d="M28.8002 4.8C29.9149 4.79966 31.0076 5.10985 31.9559 5.69578C32.9041 6.2817 33.6704 7.1202 34.1688 8.11725C34.6672 9.1143 34.878 10.2305 34.7776 11.3406C34.6772 12.4508 34.2694 13.511 33.6002 14.4024L38.4002 14.4C39.0367 14.4 39.6472 14.6529 40.0973 15.1029C40.5473 15.553 40.8002 16.1635 40.8002 16.8V24C40.8002 24.6365 40.5473 25.247 40.0973 25.6971C39.6472 26.1471 39.0367 26.4 38.4002 26.4V37.2C38.4002 38.7913 37.7681 40.3174 36.6428 41.4426C35.5176 42.5679 33.9915 43.2 32.4002 43.2H15.6002C14.0089 43.2 12.4828 42.5679 11.3576 41.4426C10.2323 40.3174 9.6002 38.7913 9.6002 37.2V26.4C8.96368 26.4 8.35323 26.1471 7.90314 25.6971C7.45305 25.247 7.2002 24.6365 7.2002 24V16.8C7.2002 16.1635 7.45305 15.553 7.90314 15.1029C8.35323 14.6529 8.96368 14.4 9.6002 14.4L14.4002 14.4024C13.9274 13.7721 13.5835 13.0548 13.3879 12.2915C13.1924 11.5282 13.1491 10.7339 13.2605 9.95387C13.3719 9.17386 13.6359 8.42343 14.0373 7.74543C14.4388 7.06744 14.9699 6.47515 15.6002 6.0024C16.2305 5.52964 16.9478 5.18566 17.7111 4.99011C18.4744 4.79456 19.2687 4.75127 20.0487 4.8627C20.8287 4.97413 21.5792 5.2381 22.2572 5.63955C22.9352 6.041 23.5274 6.57205 24.0002 7.2024C24.5575 6.45539 25.2819 5.8491 26.1153 5.43196C26.9487 5.01482 27.8682 4.7984 28.8002 4.8ZM22.8002 26.4H12.0002V37.2C12.0002 38.1548 12.3795 39.0704 13.0546 39.7456C13.7297 40.4207 14.6454 40.8 15.6002 40.8H22.8002V26.4ZM36.0002 26.4H25.2002V40.8H32.4002C33.355 40.8 34.2707 40.4207 34.9458 39.7456C35.6209 39.0704 36.0002 38.1548 36.0002 37.2V26.4ZM22.8002 16.8H9.6002V24H22.8002V16.8ZM38.4002 16.8H25.2002V24H38.4002V16.8ZM28.8002 7.2C27.8454 7.2 26.9297 7.57928 26.2546 8.25441C25.5795 8.92954 25.2002 9.84522 25.2002 10.8V14.4H28.8002C29.755 14.4 30.6707 14.0207 31.3458 13.3456C32.0209 12.6704 32.4002 11.7548 32.4002 10.8C32.4002 9.84522 32.0209 8.92954 31.3458 8.25441C30.6707 7.57928 29.755 7.2 28.8002 7.2ZM19.2002 7.2C18.2757 7.20045 17.3868 7.55658 16.7177 8.19458C16.0486 8.83258 15.6506 9.70354 15.6061 10.627C15.5617 11.5504 15.8743 12.4556 16.479 13.1549C17.0838 13.8542 17.9344 14.294 18.8546 14.3832L19.2002 14.4H22.8002V10.8L22.7834 10.4544C22.6975 9.56361 22.2829 8.73676 21.6204 8.13508C20.9579 7.5334 20.0951 7.20004 19.2002 7.2Z" fill="#033FFF"/>
                </svg>
                    
                <h3 class="mb-1">In addition to cash payment, would you like to receive products in exchange for a post?</h3>
                <p class="mb-2">Quae tibi placent quicunq prosunt aut diligebat multum.</p>

                <div class="d-flex justify-content-center">
                    <div class="mx-50">
                        <button type="button" id="btn-yes-div-2" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center mw-100" data-toggle="modal" style="height: 40px; width: 110px; white-space: nowrap;">
                            <span style="margin-top: 2px;">yes</span>
                        </button>      
                    </div>

                    <div class="mx-50">
                        <button type="button" id="btn-no-div-2" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center mw-100" data-toggle="modal" style="height: 40px; width: 110px; white-space: nowrap;">
                            <span style="margin-top: 2px;">no</span>
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <a href="{{url('/connect-facebook')}}" id="btn-back-to-div-1b" class="btn btn-alt position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="height: 44px; width: 150px; white-space: nowrap;">
                    <svg width="20" height="16" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg" class="m-0">
                        <path d="M19.269 7H4.68298L9.97598 1.707L8.56198 0.292999L0.85498 8L8.56198 15.707L9.97598 14.293L4.68298 9H19.269V7Z"/>
                    </svg>
                    <span style="margin-top: 1.5px; margin-left: 10px;">Back</span>
                </a>
            </div>
        </div>

        <div id="div-3" class="text-center d-none">
            <div class="container-niches card card-body mb-2 d-none" id="container-niches">      
                <h3 class="mb-50">Select your niches</h3>
                <p class="mb-2">Quae tibi placent quicunq prosunt aut diligebat multum.</p>
    
                <input id="search-niches" name="search-niches" placeholder="Search" type="text" class="form-control m-auto mw-100" style="width: 100%; height: 41px; min-height: 41px;">
    
                <div class="overflow-auto mt-1">
                    @foreach ($categories as $keyCategory => $category)
                        <div class="niches categories-content category-{{$category['id']}}" style="{{$keyCategory > 0 ? 'margin-top: 10px;' : ''}}" data-category-id="{{$category['id']}}" data-require-measurements="{{$category['require_measurements']}}">
                            <button type="button" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center" data-toggle="modal" style="height: 50px; width: 100%; white-space: nowrap;">
                                @if (File::exists(public_path() . "/assets/images/svg-icons/{$category['icon_path']}.svg"))
                                    <img class="m-0" src="{{ asset("assets/images/svg-icons/{$category['icon_path']}.svg") }}">
                                @else
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="m-0">
                                        <path d="M7.31332 1.036C7.37429 1.01146 7.4395 0.999185 7.50522 0.999872C7.57093 1.00056 7.63587 1.01419 7.69632 1.04L12.5963 3.14C12.6793 3.17559 12.7511 3.23299 12.8041 3.30609C12.857 3.37919 12.8892 3.46528 12.8972 3.55521C12.9052 3.64513 12.8887 3.73555 12.8495 3.81685C12.8102 3.89816 12.7497 3.96732 12.6743 4.017L12.6733 4.019L12.6623 4.026C12.5868 4.07736 12.513 4.13139 12.4413 4.188C12.2933 4.302 12.0933 4.467 11.8883 4.668C11.4953 5.054 11.1413 5.516 11.0183 5.972C11.2583 6.667 11.6003 7.463 11.8923 8.106C12.051 8.45486 12.2143 8.80156 12.3823 9.146L13.9803 10.106C14.2911 10.2926 14.5482 10.5564 14.7268 10.8718C14.9054 11.1873 14.9992 11.5435 14.9993 11.906V13.5C14.9994 13.63 14.9488 13.755 14.8582 13.8484C14.7677 13.9417 14.6443 13.9961 14.5143 14L14.4993 13.5L14.5143 14H14.4803C14.341 14.0036 14.2016 14.0036 14.0623 14C12.3747 13.9607 10.6978 13.72 9.06732 13.283C6.15732 12.491 2.73732 10.806 1.04732 7.213C1.01501 7.14453 0.998678 7.06962 0.999544 6.99392C1.00041 6.91822 1.01846 6.84371 1.05232 6.776C1.57232 5.737 2.62232 4.513 3.77232 3.461C4.91932 2.41 6.23132 1.468 7.31232 1.036H7.31332ZM13.9993 12.998V12.461C7.67232 11.9 4.16032 9.277 2.43732 6.422C2.29332 6.625 2.16732 6.822 2.06032 7.01C3.60532 10.067 6.60732 11.577 9.33032 12.318C10.8547 12.7263 12.4218 12.9545 13.9993 12.998ZM13.4653 10.963L12.0773 10.13L11.1873 11.02C12.0183 11.208 12.9213 11.354 13.8993 11.448C13.8069 11.2463 13.6556 11.0772 13.4653 10.963ZM10.1453 10.646L11.3933 9.4L11.3853 9.382C11.2475 9.09616 11.1128 8.80881 10.9813 8.52C10.6683 7.83995 10.3824 7.14773 10.1243 6.445L8.55532 6.184L9.91532 8.224C9.9724 8.30993 10.0015 8.41142 9.99864 8.51454C9.99577 8.61766 9.96108 8.71737 9.89932 8.8L8.78232 10.29C9.19032 10.45 9.62232 10.598 10.0773 10.732C10.0968 10.701 10.1196 10.6721 10.1453 10.646ZM10.1453 5.434C10.3813 4.83 10.8183 4.317 11.1883 3.954C11.2703 3.874 11.3513 3.798 11.4293 3.728L7.49932 2.044C6.67532 2.414 5.65632 3.127 4.68832 3.982L5.85332 5.146C5.89972 5.19252 5.9365 5.24773 5.96155 5.30847C5.9866 5.36921 5.99943 5.4343 5.99932 5.5V8.797C6.54232 9.187 7.15332 9.552 7.83932 9.881L8.88732 8.483L7.08332 5.777C7.02942 5.69588 7.00039 5.60078 6.99979 5.50339C6.99919 5.406 7.02704 5.31055 7.07994 5.22877C7.13283 5.14699 7.20845 5.08244 7.29752 5.04304C7.38659 5.00364 7.48523 4.99112 7.58132 5.007L10.1443 5.434H10.1453ZM3.95732 4.665C3.65132 4.967 3.36432 5.273 3.10332 5.576C3.60015 6.47644 4.24057 7.28979 4.99932 7.984V5.707L3.95732 4.665Z" />
                                    </svg>
                                @endif 
                            
                                <span style="margin-top: 1.5px; margin-left: 10px;">{{ucwords($category['name'])}}</span>
                            </button>
    
                            @if (isset($category['childs']))
                                @foreach ($category['childs'] as $key => $subcategory)
                                    <div class="px-1 py-0 niches-subcategory">
                                        <div class="overflow-auto text-left" style="max-height: 263px;">
                                            <p class="red-hat-display p-500" style="font-size: 13px;">
                                                @if ($key === 0)
                                                Select subcategory
                                                @endif
                                            </p>
                                            <div class="d-flex">
                                                <div class="custom-control custom-switch custom-control-inline mr-50">
                                                    <input type="checkbox" class="custom-control-input subcategories-content customSwitch{{$subcategory['id']}}" id="customSwitch{{$subcategory['id']}}" onclick="selectNichesInfluencer('customSwitch{{$subcategory['id']}}')" data-subcategory-id="{{$subcategory['id']}}" data-require-measurements="{{$subcategory['require_measurements']}}">
                                                    <label class="custom-control-label custom-control-label-influencer" for="customSwitch{{$subcategory['id']}}"></label>
                                                </div>
                                                <p class="customSwitchSubcategories customSwitch{{$subcategory['id']}}" style="font-size: 13px;" data-parent-id="{{$category['id']}}">{{$subcategory['name']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <button type="button" id="btn-continue-to-div-4" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center mw-100" data-toggle="modal" style="height: 40px; width: 380px; white-space: nowrap;">
                    <span style="margin-top: 1.5px; margin-left: 10px;">Continue</span>
                </button>
            </div>
        </div>

        <div id="div-4" class="div-measurements d-none">
            <div class="card card-body mb-2 pb-5">
                <h3 class="text-center">Place your measurements</h3>
                <div class="d-flex align-items-center" style="margin-top: 10px; margin-bottom: 15px;">
                    <div>
                        <p class="m-0" style="width: 70px;">Unit</p>
                    </div>
                    <div class="btn-group btn-group-toggle flex-wrap" data-toggle="buttons">
                        <label id="toggle-unit-usa" class="btn btn-toggle-measurements btn-unit">
                            <input type="radio" name="options">
                            <div>USA</div> 
                        </label>
                        <label class="btn btn-toggle-measurements btn-unit">
                            <input type="radio" name="options">
                            <div>Europe</div> 
                        </label>
                        <label class="btn btn-toggle-measurements btn-unit">
                            <input type="radio" name="options">
                            <div>Mexico/Brazil</div> 
                        </label>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div>
                        <p class="m-0" style="width: 70px;">Gender</p>
                    </div>
                    <div class="btn-group btn-group-toggle flex-wrap" data-toggle="buttons">
                        <label id="toggle-gender-male" class="btn btn-toggle-measurements btn-gender">
                            <input type="radio" name="options">
                            <div>Male</div> 
                        </label>
                        <label id="toggle-gender-female" class="btn btn-toggle-measurements btn-gender">
                            <input type="radio" name="options">
                            <div>Female</div> 
                        </label>
                    </div>
                </div>

                <label for="slider-pants" class="mt-2 mb-50">Pants</label>
                <div id="slider-pants-men" class="slider w-100"></div>
                <div id="slider-pants-women" class="slider w-100"></div>

                <label for="slider-dress" class="slider-dress mt-3 mb-50">Dress</label>
                <div id="slider-dress" class="slider slider-dress w-100"></div>

                <label for="slider-tshirt" class="mt-3 mb-50">T-shirt</label>
                <div id="slider-tshirt" class="slider w-100"></div>

                <label for="slider-shoes" class="mt-3 mb-50">Shoes</label>
                <div id="slider-shoes-men" class="slider w-100"></div>
                <div id="slider-shoes-women" class="slider w-100"></div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="button" opcao="save" class="measurements-btn btn btn-primary position-relative d-flex justify-content-center align-items-center mx-50" data-toggle="modal" style="height: 40px; width: 237px; white-space: nowrap;">
                    <span style="margin-top: 1.5px;">Save & continue</span>
                </button>

                <button type="button" opcao="later" class="measurements-btn btn btn-alt position-relative d-flex justify-content-center align-items-center mx-50" data-toggle="modal" style="height: 40px; width: 156px; white-space: nowrap;">
                    <span style="margin-top: 1.5px;">Later</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(() => {
    filterSearchbox()
})


$('#btn-yes-div-2').on('click', function () {

    function continueStepCategories() {
        $('#div-2').removeClass('d-block').addClass('d-none')
        $('#div-3').removeClass('d-none').addClass('d-block')
        $('#container-niches').removeClass('d-none')

        $('#icon-check-2').removeClass('d-none')
        $('#marker-timeline-login-influencer-2').addClass('d-none')
        $('#marker-timeline-login-influencer-3').removeClass('badge-circle-secondary').addClass('badge-circle-primary')
        $('#hr-2').removeClass('gradient-line').addClass('primary-line')
        $('#hr-3').addClass('gradient-line')
    }

    $.ajax({
        type: 'PUT',
        url: '{{ route("influencer.set.receive.products") }}',
        dataType: 'JSON',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200) {
                continueStepCategories()
            }
        },
        error: (data) => {
            if (data.status === 500) {
                toastr.error("An internal server error occurred", "Error")
                return
            }
        }
    })
})

$('#btn-continue-to-div-4').on('click', function () {

    if (validateSelectedCategorioes() === false) {
        return false
    }

    loadMeasurementsByGender()

    $('#div-3').removeClass('d-block').addClass('d-none')
    $('#div-4').removeClass('d-none').addClass('d-block')

    $('#icon-check-3').removeClass('d-none')
    $('#marker-timeline-login-influencer-3').addClass('d-none')
    $('#marker-timeline-login-influencer-4').removeClass('badge-circle-secondary').addClass('badge-circle-primary')
    $('#hr-3').removeClass('gradient-line').addClass('primary-line')
    $('#hr-4').addClass('gradient-line')
})

//$('#formCompleteProfile').on('submit', function (event) {
$('.measurements-btn').on('click', function (event) {
    event.preventDefault();
    var opcao = $(this).attr('opcao');

    let categoriesToStore = []
    let measurementsToStore = {
        unit: null,
        gender: null,
        pants: null,
        tshirt: null,
        shoes: null
    }

    var requiresMeasurements = countRequireMeasurementsCategories();

    if (validateContinueMeasurements(opcao, requiresMeasurements) === false) {
        return
    }

    $.each($('.categories-content'), function(index, value) { 
        const categoryId = $(value).attr('data-category-id')
        const subcategories = $(value).find('input:checkbox:checked')        

        $.each(subcategories, function (idx, vl) {
            const subCategoryId = $(vl).attr('data-subcategory-id')

            if (!categoriesToStore.includes(categoryId)) {
                categoriesToStore.push(categoryId)
            }
            
            categoriesToStore.push(subCategoryId)
        })
    })

    $('.btn-unit').each(function() {
        if ($(this).hasClass('active')) {
            measurementsToStore.unit = $(this).find('div').text()
            return
        }
    }) 

    $('.btn-gender').each(function() {
        if ($(this).hasClass('active')) {
            measurementsToStore.gender = $(this).find('div').text()
            return
        }
    })

    if (opcao == 'save' || requiresMeasurements == true) {
        let pants = $('#slider-pants-women').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')
        let shoes = $('#slider-shoes-women').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')
        let dress = $('#slider-dress').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')
        let tshirt = $('#slider-tshirt').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')

        if (measurementsToStore.gender === 'Male') {
            shoes = $('#slider-shoes-men').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')
            pants = $('#slider-pants-men').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext')
            tshirt = $('#slider-tshirt').find('.noUi-base').find('.noUi-handle').attr('aria-valuetext') 
            dress = null
        }

        measurementsToStore.pants = pants
        measurementsToStore.shoes = shoes
        measurementsToStore.dress = dress
        measurementsToStore.tshirt = tshirt

        const dataToStore = {
            category_id: categoriesToStore.join('|'),
            measurements: measurementsToStore
        }
        storeReceiveProductsMeasurements(dataToStore)
    } else {
        const dataToStore = {
            category_id: categoriesToStore.join('|')
        }
        storeReceiveProductsMeasurements(dataToStore)
    }
})

function validateContinueMeasurements(opcao, requiresMeasurements) {
    const unitContent = $('.btn-unit.active')
    const genderContent = $('.btn-gender.active')
    
    let isValid = true
    
    if (opcao == 'save' || requiresMeasurements == true) {
        if (unitContent.length <= 0) {
            toastr.warning("You must select a unit!", "Warning")
            isValid = false
        }

        if (genderContent.length <= 0) {
            toastr.warning("You must select a gender!", "Warning")
            isValid = false
        }
    }

    return isValid
}

function countRequireMeasurementsCategories() {
    let countRequire = 0
    $.each($('.categories-content'), function() { 
        $.each($(this).find('input:checkbox:checked') , function (index, element) {
            const requireMeasurements = $(element).attr('data-require-measurements').toLowerCase()

            if (requireMeasurements == 'y') {
                countRequire++
            }
        })
    })

    if (countRequire > 0) {
        return true
    } else {
        return false
    }
}

function validateSelectedCategorioes() {
    const limitCategories = $('.userCategoriesContent')
    const countSubcategories = $('.categories-content').find('input:checkbox:checked')
    let isValid = true  

    if (countSubcategories.length <= 0) {
        toastr.warning("You must select at least one category/niche!", "Warning")
        isValid = false
    }

    if (limitCategories.length > 5) {
        toastr.warning("Number of categories exceeded the maximum allowed! (5)", "Warning")
        isValid = false
    }

    return isValid
}

function storeReceiveProductsMeasurements(data) {
    $.ajax({
        type: 'POST',
        url: '{{ route("influencer.store.products.measurements") }}',
        data: data,
        dataType: 'JSON',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200 || data.status === 201) {
                window.location = '/register-complete'
            }
        },
        error: (data) => {
            if (data.status === 400) {
                toastr.warning(data.responseJSON.data, "Warning")
                return 
            }
            
            if (data.status === 500) {
                toastr.error("An internal server error occurred", "Error")
                return
            }
        }
    })
}

function filterSearchbox() {
    $("#search-niches").keyup(function () {
        let text = $("#search-niches").val().toLowerCase()

        $(".categories-content").css("display", "block")

        $(".categories-content").each(function () {
            let textCatToSearch = $(this).find('span').text().toLowerCase()
        
            if (textCatToSearch.indexOf(text) < 0) {
                $(this).css("display", "none")
            }
        })
    })
}

$('#btn-no-div-2').on('click', function () {
    $('#div-2').removeClass('d-block').addClass('d-none')
    $('#div-3').removeClass('d-none').addClass('d-block')
    $('#container-niches').removeClass('d-none')

    $('#icon-check-2').removeClass('d-none')
    $('#marker-timeline-login-influencer-2').addClass('d-none')
    $('#marker-timeline-login-influencer-3').removeClass('badge-circle-secondary').addClass('badge-circle-primary')
    $('#hr-2').removeClass('gradient-line').addClass('primary-line')
    $('#hr-3').addClass('gradient-line')
})

</script>
@endsection
