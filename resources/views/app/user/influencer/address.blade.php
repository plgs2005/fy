<div id="map-delivery-address" class="mt-2" style="padding: 0; margin: 0; height: 292px; width: 100%"></div>

<form id="form-address">
    @csrf
    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lng" name="lng">
    <div class="d-flex justify-content-center" style="margin-top: -70px;">
        <div id="card-delivery-address" class="card card-body mb-2" style="max-width: 479px;">
            <div class="form-group">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $influencerAddress->formatted_address ?? '' }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="apartment_unit" id="apartment-unit" placeholder="Apartment/Unit" value="{{ $influencerAddress->apartment_unit ?? '' }}">
            </div>
            <p style="font-size: 13px;"><i>So companies can send you products</i></p>
            <button type="button" id="btn-manual-address" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center" style="width: 165px; height: 31px; font-size: 13px; white-space: nowrap;"><span id="statusAddressBtn"></span></button>
        
            <div id="div-manual-address" class="d-none mt-1">
                <div class="form-group">
                    <select class="form-control" name="country" id="country" placeholder="Country" >
                        @foreach ($countries->getAllCountriesJson()['data'] as $country)
                            @if($influencerAddress)
                                @if ($country['Iso2'] == ($influencerAddress->country ?? ''))
                                    <option value="{{ $country['Iso2'] }}" {{$influencerAddress->country ? 'selected' : ''}}>{{ $country['name'] }}</option>
                                @else
                                    <option value="{{ $country['Iso2'] }}">{{ $country['name'] }}</option>
                                @endif
                            @else
                            <option value="{{ $country['Iso2'] }}">{{ $country['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="province_state" id="province-state" placeholder="Province/State *" value="{{ $influencerAddress->state ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City *" value="{{ $influencerAddress->city ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="street_address" id="street-address" placeholder="Street address *" value="{{ $influencerAddress->address ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="number" id="number" placeholder="Number" value="{{ $influencerAddress->number ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="apartment" id="apartment" placeholder="Apartment/Unit" value="{{ $influencerAddress->apartment ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="zip_code" id="zipcode" placeholder="Zipcode *" value="{{ $influencerAddress->postal_code ?? '' }}">
                </div>
                <div class="form-group mb-0">
                    <input type="number" class="form-control" name="po_box" id="po-box" placeholder="PO Box" value="{{ $influencerAddress->po_box ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    <button id="btnSaveAddress" type="submit" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mb-3" style="width: 250px; height: 40px; white-space: nowrap;">Save new address</button>
</form>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY', '')}}&libraries=places&v=weekly&callback=initAutocomplete"></script>

<script>

$(document).ready(() => {
    verifyDivAddress(true)
})

$('#btn-manual-address').click(function() {
    verifyDivAddress()
})

$('#form-address').submit(function(event) {
    event.preventDefault()
    
    if (formIsValid() === false) {
        return false
    }

    $.ajax({
        type: 'POST',
        url: "{{ route('influencer.store.address') }}",
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: (xhr) => {
            $('#btnSaveAddress').attr('disabled', true)
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200) {
                toastr.success("Address save with success! ", "Success")
                openDeliveryAddress()
            }

            $('#btnSaveAddress').removeAttr('disabled')
        },
        error: (data) => {
            console.log(data)
            $('#btnSaveAddress').removeAttr('disabled')
            if (data.status === 400) {
                toastr.warning(data.responseJSON.data, "Warning")
                return 
            }

            if (data.status === 500) {
                toastr.warning("An internal server error occurred", "Error")
                return
            }

            $('#btnSaveAddress').removeAttr('disabled')
        }
    }) 
})

function formIsValid() {

    let isValid = true

    if ($("#country option:selected").val().trim() === "") {
        toastr.warning("Country is required", "Warning")
        isValid = false
    }

    if ($("#province-state").val().trim() === "") {
        toastr.warning("Province State is required", "Warning")
        isValid = false
    }

    if ($("#city").val().trim() === "") {
        toastr.warning("City is required", "Warning")
        isValid = false
    }

    if ($("#street-address").val().trim() === "") {
        toastr.warning("Street address is required", "Warning")
        isValid = false
    }

    if ($("#zipcode").val().trim() === "") {
        toastr.warning("Zip-code is required", "Warning")
        isValid = false
    }

    return isValid
}

function verifyDivAddress(checkOnload = false) {

    if (checkOnload) {
        $('#statusAddressBtn').text('Enter address manually')
        if ($('#address').val().trim() !== '') {
            $('#div-manual-address').removeClass('d-none');
            $('#statusAddressBtn').text('Close address manually')
            $('#address').focus()
        } 

        return false;
    }

    if ($('#div-manual-address').hasClass('d-none')) {
        $('#div-manual-address').removeClass('d-none');
        $('#statusAddressBtn').text('Close address manually')
    } else {
        $('#div-manual-address').addClass('d-none');
        $('#statusAddressBtn').text('Enter address manually')
    }
}

function initAutocomplete() {
    @if($influencerAddress->lat and $influencerAddress->lng)
    const addressLocation = { lat: {{$influencerAddress->lat}}, lng: {{$influencerAddress->lng}} };
    const zoomLevel = 14;
    @else
    const addressLocation = { lat: 34.052235, lng: -118.243683 };
    const zoomLevel = 13;
    @endif

    const map = new google.maps.Map(document.getElementById("map-delivery-address"), {
        center: addressLocation,
        zoom: zoomLevel,
        mapTypeId: "roadmap",
    })

    @if($influencerAddress)
    const marker = new google.maps.Marker({
    position: addressLocation,
    map: map,
    });
    @endif

    const input = document.getElementById("address")
    const searchBox = new google.maps.places.SearchBox(input)

    map.addListener("bounds_changed", () => searchBox.setBounds(map.getBounds()))
    
    let markers = []

    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces()

        if (places.length == 0) {
            return;
        }

        markers.forEach((marker) => marker.setMap(null))
        
        markers = []

        const bounds = new google.maps.LatLngBounds()

        places.forEach((place) => {
            
            if (!place.geometry || !place.geometry.location) {
                toastr.error("Returned place contains no geometry", "Error")
                return;
            }

            setValuesFieldsOnSelect(place)

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                })
            )

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport)
            } else {
                bounds.extend(place.geometry.location)
            }
        })

        map.fitBounds(bounds)
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
