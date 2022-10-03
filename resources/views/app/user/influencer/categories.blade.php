<div id="container-categories-niches" class="mt-2">

    <form id="formCategories">
        @csrf
        <button type="button" id="btn-add-categories-niches" class="d-flex justify-content-center align-items-center btn btn-primary position-relative mt-1 mb-1" style="font-size: 15px; height: 40px; width: 250px;">
            Add category/niche
            <svg width="25" height="24" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg" class="m-0 ml-50">
                <path d="M19.5 11H13.5V5H11.5V11H5.5V13H11.5V19H13.5V13H19.5V11Z"/>
            </svg>
        </button>

        <div class="container-niches card card-body mb-2 d-none">
                            
            <h3 class="mb-50">Select your niches</h3>
            <p class="mb-2">Quae tibi placent quicunq prosunt aut diligebat multum.</p>

            <input id="search-niches" name="search-niches" placeholder="Search" type="text" class="form-control m-auto mw-100" style="width: 100%; height: 41px; min-height: 41px;">
            
            <div class="overflow-auto mt-1">
                @foreach ($categories as $keyCategory => $category)
                    <div class="niches categories-content category-{{$category['id']}}" style="{{$keyCategory > 0 ? 'margin-top: 10px;' : ''}}" data-category-id="{{$category['id']}}" data-require-measurements="{{$category['require_measurements']}}">
                        <button type="button" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center" data-toggle="modal" style="height: 50px; width: 100%; white-space: nowrap;">
                            @if (File::exists(public_path() . "/assets/images/svg-icons/{$category['icon_path']}.svg"))
                                <img class="m-0 category-icon-color" src="{{ asset("assets/images/svg-icons/{$category['icon_path']}.svg") }}">
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
                                                <label class="custom-control-label custom-control-label-influencer" for="customSwitch{{$subcategory['id']}}">
                                                </label>
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

            <div class="row justify-content-center">
                <button type="submit" id="btnSaveCategories" class="d-flex justify-content-center align-items-center btn btn-primary position-relative mt-1" style="font-size: 15px; height: 40px; width: 250px;">
                    Save
                </button>
            </div>
        </div>
    </form>

    <form id="formUserCategories">
        @csrf
        <div class="d-flex flex-wrap" id="userContentCategories">
            @foreach ($userCategories['categories'] as $userCategory)
                <div class="card card-body mb-2 mr-2 userCategoriesContent category-content-{{$userCategory->id}}"> 
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex">
                            @if (File::exists(public_path() . "/assets/images/svg-icons/{$userCategory->icon_path}.svg"))
                                <img class="m-0 category-icon-color" src="{{ asset("assets/images/svg-icons/{$userCategory->icon_path}.svg") }}">
                            @else
                                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="m-0">
                                    <path d="M7.31332 1.036C7.37429 1.01146 7.4395 0.999185 7.50522 0.999872C7.57093 1.00056 7.63587 1.01419 7.69632 1.04L12.5963 3.14C12.6793 3.17559 12.7511 3.23299 12.8041 3.30609C12.857 3.37919 12.8892 3.46528 12.8972 3.55521C12.9052 3.64513 12.8887 3.73555 12.8495 3.81685C12.8102 3.89816 12.7497 3.96732 12.6743 4.017L12.6733 4.019L12.6623 4.026C12.5868 4.07736 12.513 4.13139 12.4413 4.188C12.2933 4.302 12.0933 4.467 11.8883 4.668C11.4953 5.054 11.1413 5.516 11.0183 5.972C11.2583 6.667 11.6003 7.463 11.8923 8.106C12.051 8.45486 12.2143 8.80156 12.3823 9.146L13.9803 10.106C14.2911 10.2926 14.5482 10.5564 14.7268 10.8718C14.9054 11.1873 14.9992 11.5435 14.9993 11.906V13.5C14.9994 13.63 14.9488 13.755 14.8582 13.8484C14.7677 13.9417 14.6443 13.9961 14.5143 14L14.4993 13.5L14.5143 14H14.4803C14.341 14.0036 14.2016 14.0036 14.0623 14C12.3747 13.9607 10.6978 13.72 9.06732 13.283C6.15732 12.491 2.73732 10.806 1.04732 7.213C1.01501 7.14453 0.998678 7.06962 0.999544 6.99392C1.00041 6.91822 1.01846 6.84371 1.05232 6.776C1.57232 5.737 2.62232 4.513 3.77232 3.461C4.91932 2.41 6.23132 1.468 7.31232 1.036H7.31332ZM13.9993 12.998V12.461C7.67232 11.9 4.16032 9.277 2.43732 6.422C2.29332 6.625 2.16732 6.822 2.06032 7.01C3.60532 10.067 6.60732 11.577 9.33032 12.318C10.8547 12.7263 12.4218 12.9545 13.9993 12.998ZM13.4653 10.963L12.0773 10.13L11.1873 11.02C12.0183 11.208 12.9213 11.354 13.8993 11.448C13.8069 11.2463 13.6556 11.0772 13.4653 10.963ZM10.1453 10.646L11.3933 9.4L11.3853 9.382C11.2475 9.09616 11.1128 8.80881 10.9813 8.52C10.6683 7.83995 10.3824 7.14773 10.1243 6.445L8.55532 6.184L9.91532 8.224C9.9724 8.30993 10.0015 8.41142 9.99864 8.51454C9.99577 8.61766 9.96108 8.71737 9.89932 8.8L8.78232 10.29C9.19032 10.45 9.62232 10.598 10.0773 10.732C10.0968 10.701 10.1196 10.6721 10.1453 10.646ZM10.1453 5.434C10.3813 4.83 10.8183 4.317 11.1883 3.954C11.2703 3.874 11.3513 3.798 11.4293 3.728L7.49932 2.044C6.67532 2.414 5.65632 3.127 4.68832 3.982L5.85332 5.146C5.89972 5.19252 5.9365 5.24773 5.96155 5.30847C5.9866 5.36921 5.99943 5.4343 5.99932 5.5V8.797C6.54232 9.187 7.15332 9.552 7.83932 9.881L8.88732 8.483L7.08332 5.777C7.02942 5.69588 7.00039 5.60078 6.99979 5.50339C6.99919 5.406 7.02704 5.31055 7.07994 5.22877C7.13283 5.14699 7.20845 5.08244 7.29752 5.04304C7.38659 5.00364 7.48523 4.99112 7.58132 5.007L10.1443 5.434H10.1453ZM3.95732 4.665C3.65132 4.967 3.36432 5.273 3.10332 5.576C3.60015 6.47644 4.24057 7.28979 4.99932 7.984V5.707L3.95732 4.665Z" />
                                </svg>
                            @endif 

                            <p class="title primary mb-0" style="font-size: 20px;">&nbsp; {{$userCategory->name}} </p>
                        </div>
                        <div class="icon-delete-category" data-usercategory-id="{{$userCategory->id}}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;">
                                <path d="M5.00293 20C5.00293 21.103 5.89993 22 7.00293 22H17.0029C18.1059 22 19.0029 21.103 19.0029 20V8H21.0029V6H17.0029V4C17.0029 2.897 16.1059 2 15.0029 2H9.00293C7.89993 2 7.00293 2.897 7.00293 4V6H3.00293V8H5.00293V20ZM9.00293 4H15.0029V6H9.00293V4ZM8.00293 8H17.0029L17.0039 20H7.00293V8H8.00293Z" fill="#033FFF"/>
                                <path d="M9.00293 10H11.0029V18H9.00293V10ZM13.0029 10H15.0029V18H13.0029V10Z" fill="#033FFF"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="overflow-auto p-0">
                        @if (isset($userCategory->childs))
                            @foreach ($userCategory->childs as $keyUserSubcategory => $userSubcategory)
                                <div>
                                    <div class="p-0 niches-subcategory niches-subcategory-{{$userCategory->id}}" data-usersubcategory-id="{{$userSubcategory->id}}">
                                        <div class="overflow-auto text-left" style="max-height: 263px;">
                                            <div class="d-flex justify-content-between align-items-center mb-50">
                                                <p style="font-size: 13px;" class="mb-0">{{$userSubcategory->name}}</p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0 icon-delete-subcategory" style="cursor: pointer;" data-usersubcategory-id="{{$userSubcategory->id}}" data-parent-id="{{$userCategory->id}}">
                                                    <path d="M3.33529 13.3335C3.33529 14.0688 3.93329 14.6668 4.66862 14.6668H11.3353C12.0706 14.6668 12.6686 14.0688 12.6686 13.3335V5.3335H14.002V4.00016H11.3353V2.66683C11.3353 1.9315 10.7373 1.3335 10.002 1.3335H6.00195C5.26662 1.3335 4.66862 1.9315 4.66862 2.66683V4.00016H2.00195V5.3335H3.33529V13.3335ZM6.00195 2.66683H10.002V4.00016H6.00195V2.66683ZM5.33529 5.3335H11.3353L11.336 13.3335H4.66862V5.3335H5.33529Z" fill="#010D33"/>
                                                    <path d="M6.00195 6.6665H7.33529V11.9998H6.00195V6.6665ZM8.66862 6.6665H10.002V11.9998H8.66862V6.6665Z" fill="#010D33"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!--
                        <select id="sub-category-1" name="sub-category-1" type="text" class="form-control mt-1" style="cursor: pointer;">
                            <option value="" disabled="" selected="">Add subcategory</option>
                        </select>
                        -->
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>

<script>

$(document).ready(() => {
    filterSearchbox()
})

$('#btn-add-categories-niches').click(function() {
    if ($('.container-niches').hasClass('d-none')) {
        $('.container-niches').removeClass('d-none');
    } else {
        $('.container-niches').addClass('d-none');
    }
});

$('.niches').click(function() {
    if ($(this).hasClass('niches-open')){
        $(this).removeClass('niches-open');
    } else {
        $(this).addClass('niches-open');
    }
});

$('#formCategories').on('submit', function (event) {
    event.preventDefault();

    const categoriesContent = $('.categories-content')
    const limitCategories = $('.userCategoriesContent')
    const countSubcategories = categoriesContent.find('input:checkbox:checked')

    if (countSubcategories.length <= 0) {
        toastr.warning("You must select at least one category/niche!", "Warning")
        return
    }
    
    let dataInsert = []
    $.each(categoriesContent, function(index, value) { 
        const categoryId = $(value).attr('data-category-id')
        const subcategories = $(value).find('input:checkbox:checked')        

        $.each(subcategories, function (idx, vl) {
            const subCategoryId = $(vl).attr('data-subcategory-id')

            if (!dataInsert.includes(categoryId)) {
                dataInsert.push(categoryId)
            }
            
            dataInsert.push(subCategoryId)
        })
    })

    if (validateMeasurements() === false) {
        return 
    }
    
    storeCategory(dataInsert)
    
})

function validateMeasurements() {
    let countRequire = 0
    let valid = true
    let measurementsCount = parseInt('{{$measurementsCount}}')

    $.each($('.categories-content'), function() { 
        $.each($(this).find('input:checkbox:checked') , function (index, element) {
            const requireMeasurements = $(element).attr('data-require-measurements').toLowerCase()

            if (requireMeasurements == 'y') {
                countRequire++
            }
        })
    })

    if (measurementsCount <= 0 && countRequire > 0) {
        valid = false
        toastr.warning("You must enter the measurements. Click here to fill up your measurements.", "Warning", {
            onclick: function () {
                $('#menu-measurements-option').click();
                // openMeasurements()
            },
            extendedTimeOut: 30000,
            timeOut: 30000
        })
    }
    
    return valid
}

$('#gotoMeasurements').on('click', () => {
    
})

$('.icon-delete-category').on('click', function() {
    const id = $(this).attr('data-usercategory-id')
    deleteCategory(id, '/influencer-destroy-categories', () => $(this).closest('.userCategoriesContent').remove())

    $(`.niches-subcategory-${id}`).each(function() {
        const childId = $(this).attr('data-usersubcategory-id')
        deleteCategory(childId, '/influencer-destroy-categories', () => {}, false)
    })
})

$('.icon-delete-subcategory').on('click', function() {
    const id = $(this).attr('data-usersubcategory-id')
    const parentId = $(this).attr('data-parent-id')

    deleteCategory(id, '/influencer-destroy-categories', () => {
        $(`.niches-subcategory-${parentId}`).length
        $(this).closest('.niches-subcategory').remove()

        if ($(`.niches-subcategory-${parentId}`).length == 0) {
            deleteCategory(parentId, '/influencer-destroy-categories', () => openCategoriesAndNiches(), false)
        }
    })
})

function deleteCategory(id, route, action, showMessage = true) {
    $.ajax({
        type: 'DELETE',
        url: `${route}/${id}`,
        dataType: 'JSON',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200) {
                action()
                if (showMessage) {
                    toastr.success("Category deleted with success! ", "Success")
                }
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

function storeCategory(data) {
    $.ajax({
        type: 'POST',
        url: "{{ route('influencer.store.categories') }}",
        data: {
            category_id: data.join('|') 
        },
        dataType: 'JSON',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (data) => {
            if (data.status === 200) {
                openCategoriesAndNiches()
                toastr.success("Category saved with success! ", "Success")
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
</script>