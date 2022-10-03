{{-- <script type="module">

    import Echo from '{{asset('js/echo.js')}}'
  
    import {Pusher} from '{{asset('js/pusher.js')}}'
  
    window.Pusher = Pusher
  
    
  
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{env("PUSHER_APP_KEY")}}',
        wsHost: window.location.hostname,
        host: window.location.hostname,
        httpHost: window.location.hostname,
        wsPort: 6001,
        wssPort:6001,
        forceTLS: true,
        disableStats: true,
    });
  
    window.Echo.private('App.Influencer.User.User.{{ $user->id }}')
    .notification((notification) => {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      if (notification.link) {
        toastr.options.onclick = function() { location.href = notification.link }
      }
      
      if(notification.img_path) {
        var notificationImg = '<div class="pr-1"><img class="rounded-circle" height="48" width="48" src=""></div>';
      } else {
        var notificationImg = '';
      }
      var notificationCard = '<div class="card card-body not-read d-flex justify-content-between align-items-center notification-card">'+notificationImg+'<div><p class="mb-0">'+notification.message+'</p></div></div>'
      $('#notifications-modal-body').prepend(notificationCard);
      toastr.info(notification.message);
      var unread = $('#unread-count').attr('count');
      unread = parseInt(unread);
      unread = unread+1;
      $('#unread-count').attr('count', unread);
      $('#icon-unread-count').html(unread);
      $('#icon-unread-count').removeClass('d-none');
      $('#zero-notification').addClass('d-none');
      $('#notification-icon').addClass('bx-tada');
    });
    console.log("websokets in use")
</script>  --}}