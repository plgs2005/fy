<div class="mt-2">
    <div id="container-header-profile">
        <div id="container-header-profile-div-1">
            <img class="img-profile rounded-circle" src="{{$user->avatarImg()}}" class="img-profile">
            <form id='foto' enctype="multipart/form-data">
                @csrf
                <input type="file" id="avatarImg" name="avatarImg" style="display:none"/>
                @error('avatarImg')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <h4 class="mb-0">Hello, {{$user->name}}</h4>
                <button type="button" id="openImgUpload" class="btn btn-secondary position-relative mt-1"  style="margin-bottom: 1px;">Change picture</button>
            </form>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-2" >
    <div class="card card-body mb-2" style="max-width: 335px;">
        <form id="form-profile-data">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{$user->name}}">
            </div>
            <div class="form-group d-flex align-items-center">
                <input type="text" class="form-control phone_us @error('password') is-invalid @enderror" id="phone" name="phone" placeholder="phone" value="{{$user->phone}}"  maxlength="17">
            </div>
            <div class="form-group">
                <input type="email" class="form-control @error('password') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{$user->email}}">
            </div>

            <button type="submit" class="btn btn-primary position-relative" id="btnSaveProfile">Save</button>
        </form>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="card card-body" style="max-width: 335px;">
        <form id="form-change-password">
            @csrf
            <div class="form-group mb-50 d-flex align-items-center">
                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" placeholder="new password">
                <i id="icon-new-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordProfile(0);"></i>
                @error('password')
                <div class="invalid-feedback ml-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                
            </div>
            
            <div class="form-group mb-50 d-flex align-items-center">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="repeat new password">
                <i id="icon-repeat-new-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordProfile(1);"></i>
                @error('password')
                <div class="invalid-feedback ml-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary position-relative" id="btnSaveNewPass" style="margin-top: 2px;">Save new password</button>
        </form>
    </div>
</div>

<script>

$(document).ready(function() {
    $('.phone_us').mask('+1 (000) 000-0000');
});

function showHidePasswordProfile(x) {
  if (x == 0) {
    if ($('#icon-new-password').hasClass('bx-show-alt')) {
      $('#icon-new-password').removeClass('bx-show-alt');
      $('#icon-new-password').addClass('bx-hide');
      $('#icon-new-password').attr('title', 'Hide password');
      $('#password').attr('type', 'text');
    } else {
      $('#icon-new-password').removeClass('bx-hide');
      $('#icon-new-password').addClass('bx-show-alt');
      $('#icon-new-password').attr('title', 'Show password');
      $('#password').attr('type', 'password');
    }
  } else if (x == 1){
    if ($('#icon-repeat-new-password').hasClass('bx-show-alt')) {
      $('#icon-repeat-new-password').removeClass('bx-show-alt');
      $('#icon-repeat-new-password').addClass('bx-hide');
      $('#icon-repeat-new-password').attr('title', 'Hide password');
      $('#password-confirm').attr('type', 'text');
    } else {
      $('#icon-repeat-new-password').removeClass('bx-hide');
      $('#icon-repeat-new-password').addClass('bx-show-alt');
      $('#icon-repeat-new-password').attr('title', 'Show password');
      $('#password-confirm').attr('type', 'password');
    }
  }
}

$('#form-change-password').on('submit', function (e) {
    e.preventDefault()

    if (validatePassword() === false) {
        return false
    }

    $.ajax({
        type: "POST",
        url: "{{ route('user.changePassword') }}",
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: (xhr) => {
            $('#btnSaveNewPass').attr('disabled', true)
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (response) => {
            if (response.status === 200) {
                toastr.success("Password update with success!", "Success")
                $('#btnSaveNewPass').removeAttr('disabled')
                clearFormPassword()
            }
        },
        error: (error) => {
            console.log(error)
            $('#btnSaveNewPass').removeAttr('disabled')

            if (error.responseJSON.errors.password) {
                toastr.error(error.responseJSON.errors.password.join(','), "Error")
            }
        }
    });
})

function clearFormPassword() {
    $("#password").val('')
    $("#password-confirm").val('')
}

function validatePassword() {
    let isValid = true 

    if ($("#password").val().trim() === '') {
        $("#password").focus()
        toastr.warning("Password is required!", "Warning")
        isValid = false
    }

    if ($("#password-confirm").val().trim() === '') {
        $("#password-confirm").focus()
        toastr.warning("Password confirm is required!", "Warning")
        isValid = false
    }

    if ($("#password").val().trim() !== $("#password-confirm").val().trim()) {
        $("#password-confirm").focus()
        toastr.warning("Password does not match confirmation!", "Warning")
        isValid = false
    }

    return isValid
}

$('#form-profile-data').on('submit', function (e) {
    e.preventDefault()

    $.ajax({
        type: "PUT",
        url: "{{ route('influencer.profile.update') }}",
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: (xhr) => {
            $('#btnSaveProfile').attr('disabled', true)
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        },
        success: (response) => {
            if (response.status === 200) {
                toastr.success("Profile updated!", "Success")
                $('#btnSaveProfile').removeAttr('disabled')
                openProfileInfluencer()

                if (response.changedEmail !== '') {
                    toastr.success(response.changedEmail, "E-mail verification")
                }
            }
        },
        error: (error) => {
            console.log(error)
            $('#btnSaveProfile').removeAttr('disabled')

            if (error.responseJSON.errors.name) {
                toastr.error(error.responseJSON.errors.name.join(','), "Error")
            }

            if (error.responseJSON.errors.phone) {
                toastr.error(error.responseJSON.errors.phone.join(','), "Error")
            }

            if (error.responseJSON.errors.email) {
                toastr.error(error.responseJSON.errors.email.join(','), "Error")
            }
        }
    });
})



$.validator.addMethod('filesize', function(value, element, param) {
    var length = ( element.files.length );
    var fileSize = 0;
    if (length > 0) {
        for (var i = 0; i < length; i++) {
            fileSize = element.files[i].size; // get file size
            fileSize = fileSize / 1024; //file size in Kb
            fileSize = fileSize / 1024; //file size in Mb
            if(fileSize > param){
                return false;
            }
        }
        return true;
    }
});

$("#foto").validate({
    ignore: "", //required or validator won't work

    rules: {
        avatarImg: { required: true, extension: "png|jpeg|jpg|bmp", filesize: 10 },
    },
    messages: {
        avatarImg: {
            extension: function() {
                toastr.error('File must be PNG, JPEG, BMP')
            },
            filesize: function() {
                toastr.error('Max filesize 10mb')
            },
        },
    },
    
    invalidHandler: function(event, validator) {
        // 'this' refers to the form
        var errors = validator.numberOfInvalids();
        if (errors) {
            toastr.error('Error', "Error")
        }
    },

    submitHandler: function(form) {
        const formData = new FormData()
        formData.append('avatarImg', $('#avatarImg')[0].files[0])

        $.ajax({
            type: "POST",
            url: "{{ route('user.avatar.update') }}",
            data: formData,
            contentType: false,
            processData: false, 
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
            },
            success: (response) => {
                if (response.status === 200 && response.data !== '') {
                    toastr.success("Avatar updated!", "Success")
                    openProfileInfluencer()
                }
            },
            error: (error) => {
                if (error.responseJSON.errors) {
                    toastr.error(error.responseJSON.errors.avatarImg.join(','), "Error")
                }
            }
        });
    },

});

$('#openImgUpload').click(function() {
    $('#avatarImg').trigger('click'); 
});

$('#avatarImg').on('change', function () {
    $('#foto').submit()
});
</script>
