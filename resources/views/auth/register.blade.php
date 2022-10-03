@extends('layouts.register')
@section('content')
<div class="mb-0 h-100 background-main">
    <div class="row m-0 h-100">
        <!-- register section left -->
        <div class="col-md-6 col-12 px-0 d-flex justify-content-between flex-column">
            <div class="login-header d-flex justify-content-between px-3 align-items-baseline">
                <div class="login-header--logo">
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="img-fluid" src="{{URL::asset('/assets/images/logo_horizontal_influencify_02.svg')}}"  alt="logo brand" style="width: 268px; height: 124px;"></a>
                </div>
                @if (isset($register))
                <div id="div-have-account" class="login-header--button d-flex align-items-baseline">
                    
                    @if (isset($register))
                        <p class="pr-1">Have an account?</p>
                    @else
                        <p class="pr-1">Don't have an account?</p>
                    @endif
                        @if (isset($register))
                            <a class="btn btn-secondary" style="font-size: 13px;"  role="button" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @else
                            <a class="btn btn-secondary" style="font-size: 13px;"  role="button" href="{{ route('registerBrand') }}">Register</a>
                        @endif
                </div>
                @endif
            </div>

            <div id="div-0" class="text-center mx-auto w-40 mt-n5">
                <div class="d-none d-sm-block" id="text-step-1">
                    <p class="text-center title mb-50">Sign up as influencer</p>
                    <p class="mx-auto mb-2" style="max-width: 260px;">Quae tibi placent quicunq prosunt aut diligebat multum.</p>
                </div>

                <div class="d-none" id="text-step-2">
                    <p class="text-center title mb-50">Complete your registration</p>
                    <p class="mx-auto mb-2" style="max-width: 260px;">Quae tibi placent quicunq prosunt aut diligebat multum.</p>
                </div>

                <div class="card disable-rounded-right mb-1 p-3 d-flex justify-content-center">
                    <div class="card-body p-0">
                        <form id="form-signup">
                            <div class="d-block" id="step-1">
                                <input type="hidden" id="referrer" name="referrer" @if (isset($cookie['referrer'])) value="{{$cookie['referrer']}}"  @endif >
                                
                                <div class="form-group mb-50">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email *">
                                </div>
            
                                <div class="form-group mb-1  d-flex align-items-center">
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Password *">
                                    <i id="icon-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePassword();"></i>
                                </div>
            
                                <div class="form-group mb-1  d-flex align-items-center">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm password *">
                                    <i id="icon-password-confirm" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordConfirmation();"></i>
                                </div>
            
                                <div class="form-group mb-2 text-left">
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="accept-terms" required>
                                        <label class="custom-control-label custom-control-label-influencer" for="customSwitch1"></label>
                                        <span>Accept <a class="font-weight-bold" href="#"><u>the terms</u></a></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-none" id="step-2">
                                <div class="form-group mb-50">
                                    <input type="text" class="form-control" id="first-name" name="first_name" placeholder="First name *" style="width: 247px; height: 41px; max-width: 100%;">
                                </div>
                                <div class="form-group mb-50">
                                    <input type="text" class="form-control phone_us" id="phone" name="phone" maxlength="16" placeholder="Phone *" style="width: 247px; height: 41px; max-width: 100%;">
                                </div>

                                <div class="form-group mb-50  d-flex align-items-center">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" style="width: 247px; height: 41px; max-width: 100%;">
                                </div>

                                <div class="form-group mb-50  d-flex align-items-center">
                                    <input type="text" class="form-control" id="apartment-unit" name="apartment_unit" placeholder="Apartment" style="width: 247px; height: 41px; max-width: 100%;">
                                </div>
    
                                <div class="form-group mb-1 text-left">
                                    <p style="font-size: 13px;" class="mb-50"><i>So companies can send you products</i></p>
                                    <button type="button" id="btn-manual-address" class="btn btn-secondary position-relative p-0" style="width: 165px; height: 31px; max-width: 165px !important; font-size: 13px;">Enter address manually</button>
                                </div>
    
                                <div id="div-manual-address" class="mt-1 mb-1 d-none">
                                    <div class="form-group">
                                        <select class="form-control" name="country" id="country" placeholder="Country" style="width: 247px; height: 41px; max-width: 100%;">
                                            @foreach ((new \App\Infrastructure\API\Countries\Countries())->getAllCountriesJson()['data'] as $country)
                                                <option value="{{ $country['Iso2'] }}">{{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="province-state" name="province_state" placeholder="Province/State *" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City *" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="street-address" name="street_address" placeholder="Street address *" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="number" name="number" placeholder="Number" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="apartment" name="apartment" placeholder="Apartment/Unit" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="zipcode" name="zip_code" placeholder="Zipcode" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="number" class="form-control" id="po-box" name="po_box" placeholder="PO Box" style="width: 247px; height: 41px; max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">

                            <button type="button" id="btn-step-1" class="btn btn-primary position-relative d-block" style="width: 247px; height: 40px; max-width: 100%;">Signup</button>
                            <button type="submit" id="btn-step-2" class="btn btn-primary position-relative d-none" style="width: 247px; height: 40px; max-width: 100%;">Continue</button>
                            <a href="#" id="btn-back-step-1" class="d-none mt-2">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="text-center mb-2">
                <p>2021 Influencify® - All Rights Reserved</p>
            </div>
        </div>

        <!-- image section right -->
        <div id="influencer-login-div-right" class="col-md-6 d-md-block d-none p-0" style="background-image: url('{{URL::asset('assets/images/background-login-brand.png')}}');"></div>
    </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY', '')}}&libraries=places&v=weekly&callback=initAutocomplete"></script>

<script>
$(document).ready(function() {
    $('.phone_us').mask('+1 (000) 000-0000');

    $('#btn-step-1').click(function() {

        if (form1StepIsValid() === false) {
            return false
        }

        if ($('#step-1').hasClass('d-block')) {
            $('#step-1').removeClass('d-block').addClass('d-none')
            $('#text-step-1').removeClass('d-sm-block').addClass('d-sm-none')
            $('#btn-step-1').removeClass('d-block').addClass('d-none')
            
            $('#step-2').addClass('d-block')
            $('#text-step-2').addClass('d-sm-block')
            $('#btn-step-2').removeClass('d-none').addClass('d-block')
            $('#btn-back-step-1').removeClass('d-none').addClass('d-block')
        }
    })

    $('#btn-back-step-1').click(function() {
        $(this).removeClass('d-block').addClass('d-none')

        if ($('#step-1').hasClass('d-block')) {
            $('#step-1').removeClass('d-block').addClass('d-none')
            $('#text-step-1').removeClass('d-sm-block').addClass('d-sm-none')
            $('#btn-step-1').removeClass('d-block').addClass('d-none')
            
            $('#step-2').addClass('d-block')
            $('#text-step-2').addClass('d-sm-block')
            $('#btn-step-2').removeClass('d-none').addClass('d-block')
            
        } else {
            $('#step-1').addClass('d-block')
            $('#step-2').removeClass('d-block').addClass('d-none')
            $('#text-step-1').addClass('d-block')
            $('#text-step-2').removeClass('d-sm-block').addClass('d-none')
            $('#btn-step-1').removeClass('d-none').addClass('d-block')
            $('#btn-step-2').removeClass('d-block').addClass('d-none')
        }
    })
})

$('#form-signup').submit(function(event) {
    event.preventDefault()
    
    if (form2StepIsValid() === false) {
        return false
    }

    $.ajax({
        type: 'POST',
        url: "{{ route('register.influencer') }}",
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: (xhr) => {
            $('#btn-step-2').attr('disabled', true)
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200) {
                toastr.success("First steps saved! Redirectioning...", "Success")

                setTimeout(() => {
                    window.location = '/connect-facebook'
                }, 500);
            }

            $('#btn-step-2').removeAttr('disabled')
        },
        error: (data) => {
            console.log(data)
            $('#btn-step-2').removeAttr('disabled')
            if (data.status === 400) {
                toastr.warning(data.responseJSON.data, "Warning")
                return 
            }

            if (data.status === 500) {
                toastr.error("An internal server error occurred", "Error")
                return
            }

            $('#btn-step-2').removeAttr('disabled')
        }
    }) 
})

function form1StepIsValid() {
    let isValid = true

    if (!$("#customSwitch1").is(":checked")) {
        toastr.warning("You need accept the terms!", "Warning")
        isValid = false
    }

    if ($("#email").val().trim() === "") {
        toastr.warning("E-mail is required!", "Warning")
        isValid = false
    }

    const regex = /\S+@\S+\.\S+/
    const validateEmail = regex.test($("#email").val().trim())
    
    if (!validateEmail) {
        toastr.warning("E-mail is invalid!", "Warning")
        isValid = false
    }

    if ($("#password").val().trim() === "") {
        toastr.warning("Password is required!", "Warning")
        isValid = false
    }

    if ($("#password").val().trim().length < 3) {
        toastr.warning("Password must be at least 3 characters!", "Warning")
        isValid = false
    }

    if ($("#password-confirm").val().trim() === "") {
        toastr.warning("Confirm password is required!", "Warning")
        isValid = false
    }

    if ($("#password").val().trim() !== $("#password-confirm").val().trim()) {
        toastr.warning("Password does not match confirmation!", "Warning")
        isValid = false
    }

    return isValid
}

function form2StepIsValid() {

    let isValid = true

    if ($("#first-name").val().trim() === "") {
        toastr.warning("First name is required!", "Warning")
        isValid = false
    }

    if ($("#first-name").val().trim().length < 3) {
        toastr.warning("First name must be at least 3 characters!", "Warning")
        isValid = false
    }

    if ($("#phone").val().trim() === "") {
        toastr.warning("Phone is required!", "Warning")
        isValid = false
    }

    if ($("#country option:selected").val().trim() === "") {
        toastr.warning("Country is required!", "Warning")
        isValid = false
    }

    if ($("#province-state").val().trim() === "") {
        toastr.warning("Province State is required!", "Warning")
        isValid = false
    }

    if ($("#city").val().trim() === "") {
        toastr.warning("City is required!", "Warning")
        isValid = false
    }

    if ($("#street-address").val().trim() === "") {
        toastr.warning("Street address is required!", "Warning")
        isValid = false
    }

    if ($("#zipcode").val().trim() === "") {
        toastr.warning("Zip-code is required!", "Warning")
        isValid = false
    }

    return isValid
}

function initAutocomplete() {
    const input = document.getElementById("address")
    const searchBox = new google.maps.places.SearchBox(input)

    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces()

        if (places.length == 0) {
            return;
        }

        places.forEach((place) => {
            
            if (!place.geometry || !place.geometry.location) {
                toastr.error("Returned place contains no geometry", "Error")
                return;
            }

            setValuesFieldsOnSelect(place)
        })
    })
}

function setValuesFieldsOnSelect(objectPlaces) {
    $("#apartment").val('')
    $("#apartment-unit").val('')
    $("#street-address").val('')
    $("#city").val('')
    $("#province-state").val('')
    $("#country").prop('selectedIndex', 0)
    $("#zipcode").val('')
    $("#po-box").val('')
    $("#number").val('')
    $("#lat").val('')
    $("#lng").val('')

    $("#lat").val(objectPlaces.geometry.location.lat());
    $("#lng").val(objectPlaces.geometry.location.lng());

    objectPlaces.address_components.forEach((address) => {
        if (address.types.includes('street_number')) {
            $("#number").val(address.long_name)
        }

        if (address.types.includes('route')) { 
            $("#street-address").val(address.long_name)
        }

        if (address.types.includes('administrative_area_level_2')) { 
            $("#city").val(address.long_name)
        }

        if (address.types.includes('administrative_area_level_1')) { 
            $("#province-state").val(address.long_name.replace('State of ', ''))
        }

        if (address.types.includes('country')) { 
            // $("#country").val(address.long_name == 'Brasil' ? 'Brazil' : address.long_name)
            $("#country").val(address.short_name)
        }

        if (address.types.includes('postal_code')) { 
            $("#zipcode").val(address.long_name.replace(/[^0-9\.]+/g, ''))
        }
    })
}
</script>
@endsection
