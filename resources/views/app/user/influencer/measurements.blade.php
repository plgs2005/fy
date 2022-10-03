<div id="container-your-measurements" class="div-measurements mt-3 mb-3" style="max-width: 454px;">

    <div class="card card-body mb-2 pb-5">
            
        <h3 class="text-center">Place your measurements</h3>

        <div class="d-flex align-items-center" style="margin-top: 10px; margin-bottom: 15px;">
            <div>
                <p class="m-0" style="width: 70px;">Unit</p>
            </div>
            <div class="btn-group btn-group-toggle flex-wrap" data-toggle="buttons">
                <label class="btn btn-toggle-measurements btn-unit {{$userMeasurements && $userMeasurements->unit == 'USA' ? 'active' : '' }}">
                  <input type="radio" name="options">
                  <div>USA</div> 
                </label>
                <label class="btn btn-toggle-measurements btn-unit {{$userMeasurements && $userMeasurements->unit == 'Europe' ? 'active' : '' }}">
                  <input type="radio" name="options">
                  <div>Europe</div> 
                </label>
                <label class="btn btn-toggle-measurements btn-unit {{$userMeasurements && $userMeasurements->unit == 'Mexico/Brazil' ? 'active' : '' }}">
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
                <label id="toggle-gender-male" class="btn btn-toggle-measurements btn-gender {{$userMeasurements && $userMeasurements->gender == 'Male' ? 'active' : '' }}">
                  <input type="radio" name="options">
                  <div>Male</div> 
                </label>
                <label id="toggle-gender-female" class="btn btn-toggle-measurements btn-gender {{$userMeasurements && $userMeasurements->gender == 'Female' ? 'active' : '' }}">
                  <input type="radio" name="options">
                  <div>Female</div> 
                </label>
            </div>
        </div>

        <label for="slider-pants" class="mt-2 mb-50">Pants</label>
        <div id="slider-pants-men" class="slider w-100 d-none"></div>
        <div id="slider-pants-women" class="slider w-100 d-none"></div>

        <label for="slider-dress" class="slider-dress mt-3 mb-50">Dress</label>
        <div id="slider-dress" class="slider slider-dress w-100"></div>

        <label for="slider-tshirt" class="mt-3 mb-50">T-shirt</label>
        <div id="slider-tshirt" class="slider w-100"></div>

        <label for="slider-shoes" class="mt-3 mb-50">Shoes</label>
        <div id="slider-shoes-men" class="slider w-100 d-none"></div>
        <div id="slider-shoes-women" class="slider w-100 d-none"></div>
      
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" id="btn-continue-div-4" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-50" data-toggle="modal" style="height: 40px; width: 237px; white-space: nowrap;">
            <span style="margin-top: 1.5px;">Save</span>
        </button>
    </div>

</div>

<script>

var gendeR = '{{ $userMeasurements->gender ?? null }}'
var pantS = '{{ $userMeasurements->pants ?? null }}'
var shoeS = '{{ $userMeasurements->shoes ?? null }}'
var shirtS = '{{ $userMeasurements->tshirt ??  null }}'
var dresS = '{{ $userMeasurements->dress ?? null }}'

var sliderPantsMen = document.getElementById('slider-pants-men');
if (sliderPantsMen != null) {
    noUiSlider.create(sliderPantsMen, {
        start: [parseInt(pantS) || 2],
        connect: 'lower',
        tooltips: true,
        step: 1,
        format: wNumb({
        decimals: 0
        }),
        range: {
            'min': 0,
            'max': 6
        }
    });
    sliderPantsMen.noUiSlider.on('update', function( values, handle ) {
        var measurementes = ["28-30 (XS)", "30-32 (S)", "32-34 (M)", "34-36 (L)", "36-38 (XL)", "40-44 (XXL)", "46-50 (3XL)"];
        var pantsValue = $('#slider-pants-men .noUi-handle').attr('aria-valuenow');
        $('#slider-pants-men .noUi-tooltip').text(measurementes[parseInt(pantsValue)]);
    });
}

var sliderPantsWomen = document.getElementById('slider-pants-women');
if (sliderPantsWomen != null) {
    noUiSlider.create(sliderPantsWomen, {
        start: [parseInt(pantS) || 2],
        connect: 'lower',
        tooltips: true,
        step: 1,
        format: wNumb({
        decimals: 0
        }),
        range: {
            'min': 0,
            'max': 12
        }
    });
    sliderPantsWomen.noUiSlider.on('update', function( values, handle ) {
        var measurementes = ["000 (XXXS)", "00 (XXS)", "0 (XS)", "2 (XS)", "4 (S)", "6 (S)", "8 (M)", "10 (M)", "12 (L)", "14 (L)", "16 (XL)", "18 (XL)", "20 (XXL)"];
        var pantsValue = $('#slider-pants-women .noUi-handle').attr('aria-valuenow');
        $('#slider-pants-women .noUi-tooltip').text(measurementes[parseInt(pantsValue)]);
    });
}


var sliderDress = document.getElementById('slider-dress');
if (sliderDress != null) {
    noUiSlider.create(sliderDress, {
        start: [parseInt(dresS) || 4],
        connect: 'lower',
        tooltips: true,
        step: 1,
        format: wNumb({
        decimals: 0
        }),
        range: {
            'min': 0,
            'max': 8
        }
    });
    sliderDress.noUiSlider.on('update', function( values, handle ) {
        var measurementes = ["XXXS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "XXXL"];
        var dressValue = $('#slider-dress .noUi-handle').attr('aria-valuenow');
        $('#slider-dress .noUi-tooltip').text(measurementes[parseInt(dressValue)]);
    });
}

var sliderTshirt = document.getElementById('slider-tshirt');
if (sliderTshirt != null) {
    noUiSlider.create(sliderTshirt, {
        start: [parseInt(shirtS) || 5],
        connect: 'lower',
        tooltips: true,
        step: 1,
        format: wNumb({
        }),
        range: {
            'min': 0,
            'max': 7
        }
    });
    sliderTshirt.noUiSlider.on('update', function( values, handle ) {
        var measurementes = ["XXXS", "XS", "S", "M", "L", "XL", "XXL", "XXXL"];
        var tShirtValue = $('#slider-tshirt .noUi-handle').attr('aria-valuenow');
        $('#slider-tshirt .noUi-tooltip').text(measurementes[parseInt(tShirtValue)]);
    });
}

var sliderShoesMen = document.getElementById('slider-shoes-men');
if (sliderShoesMen != null) {
    noUiSlider.create(sliderShoesMen, {
        start: [shoeS || 10],
        connect: 'lower',
        tooltips: true,
        step: 0.5,
        format: wNumb({
        }),
        range: {
            'min': 6,
            'max': 14
        }
    });
}

var sliderShoesWomen = document.getElementById('slider-shoes-women');
if (sliderShoesWomen != null) {
    noUiSlider.create(sliderShoesWomen, {
        start: [shoeS || 10],
        connect: 'lower',
        tooltips: true,
        step: 0.5,
        format: wNumb({
        }),
        range: {
            'min': 4,
            'max': 13
        }
    });
}

function loadMeasurementsByGender() {
    if ($('#toggle-gender-male').hasClass('active')) {
        $('#slider-pants-men').removeClass('d-none');
        $('#slider-shoes-men').removeClass('d-none');
        $('#slider-pants-women').addClass('d-none');
        $('#slider-shoes-women').addClass('d-none');
        $('.slider-dress').addClass('d-none');
    } else {
        $('#slider-pants-women').removeClass('d-none');
        $('#slider-shoes-women').removeClass('d-none');
        $('#slider-pants-men').addClass('d-none');
        $('#slider-shoes-men').addClass('d-none');
        $('.slider-dress').removeClass('d-none');
    }
}

$("#toggle-gender-male").change(function () {
    loadMeasurementsByGender();
});

$("#toggle-gender-female").change(function () {
    loadMeasurementsByGender();
});

$(document).ready(() => {
    loadMeasurementsByGender()
})

$('#btn-continue-div-4').on('click', function (event) {
    event.preventDefault();

    let measurementsToStore = {
        unit: null,
        gender: null,
        pants: null,
        tshirt: null,
        shoes: null
    }

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
        measurements: measurementsToStore
    }

    if (!measurementsToStore.unit || !measurementsToStore.gender) {
        toastr.warning("You must select a unit and gender!", "Warning")
        return
    }

    updateMeasurements(dataToStore)
})

function updateMeasurements(data) {
    $.ajax({
        type: 'PUT',
        url: '{{ route("influencer.update.measurements") }}',
        data: data,
        dataType: 'JSON',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200 || data.status === 201) {
                toastr.success("Measurements update with success!", "Success")
                openYourMeasurements()
            }
        },
        error: (data) => {
            console.log(data)
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
</script>