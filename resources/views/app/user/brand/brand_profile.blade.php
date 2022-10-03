@extends('layouts.brand')
@section('content')
<div class="row d-flex justify-content-between align-items-baseline mt-2 mb-1">
    <div class="col-xl-12 col-md-4 col-sm-6">
    <p class="red-hat-display" style="font-size: 25px;">Profile details</p>
    </div>
</div>
<div class="row align-items-end">
    <div class="col-xl-2 col-md-4 col-sm-6 d-flex flex-column justify-content-between align-items-center">
        <div>
            <img class="img-profile rounded-circle" src=" @if ($user->avatarImg)  {{URL::asset("/storage/$user->avatarImg")}}
            @else {{URL::asset('/assets/images/picture-profile.png')}}
            @endif" class="img-profile">
            <form id='foto' method="POST" action="{{ route('user.avatar.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" id="avatarImg" name="avatarImg" style="display:none" />
                <button type="button" id="openImgUpload" class="btn btn-secondary position-relative mt-1"  style="margin-bottom: 1px;">Change picture</button>
            </form>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-6">
        <form method="POST" action="{{ route('brand.profile.update') }}">
            @method('put')
            @csrf
            <div class="form-group">
                <input type="text" class="form-control input-secondary @error('password') is-invalid @enderror" id="name" name="name" placeholder="name" required="required" value="{{$user->name}}">
            </div>
            <div class="form-group d-flex align-items-center">
                <input type="text" class="form-control input-secondary phone_us @error('password') is-invalid @enderror" id="phone" name="phone" placeholder="phone" required="required" value="{{$user->phone}}" maxlength="17">
            </div>
            <div class="form-group">
                <input type="email" class="form-control input-secondary @error('password') is-invalid @enderror" id="email" name="email" placeholder="email" required="required" value="{{$user->email}}">
            </div>
            <button type="submit" class="btn btn-primary position-relative">Save</button>
        </form>
    </div>
</div>
<hr class="my-3">

<div class="row mt-1 d-flex justify-content-between align-items-baseline mt-1 mb-1">
    <div class="col-xl-12 col-md-4 col-sm-6">
    <p class="red-hat-display" style="font-size: 25px;">Change password</p>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-md-4 col-sm-6">
        <form method="POST" action="{{ route('user.changePassword') }}">
            @csrf
            <div class="form-group mb-50 d-flex align-items-center">
                <input id="password" type="password" class="form-control input-secondary @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="new password" required>
                <i id="icon-new-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordProfile(0);"></i>
                @error('password')
                <div class="invalid-feedback ml-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                
            </div>
            
            <div class="form-group mb-50 d-flex align-items-center">
                <input id="password-confirm" type="password" class="form-control input-secondary @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="repeat new password" required>
                <i id="icon-repeat-new-password" class="bx bx-show-alt" style="margin-left: -35px; font-size: 25px;" title="Show password" onclick="showHidePasswordProfile(1);"></i>
                @error('password')
                <div class="invalid-feedback ml-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary position-relative" style="margin-top: 2px;">Save new password</button>
        </form>
    </div>
</div>

@endsection

@section('view-js')
<script>
$(document).ready(function() {
    $('.phone_us').mask('+1 (000) 000-0000');
});
//profile
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

var password = document.getElementById("password")
var confirm_password = document.getElementById("password-confirm");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


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
      console.log('handler');
      form.submit();
    },

});

$('#openImgUpload').click(function() {
  $('#avatarImg').trigger('click'); 
});

$('#avatarImg').on('change', function () {
    $('#foto').submit()
});

</script>
@endsection
