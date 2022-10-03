
$('#btn-notifications').click(function(e) {
    e.preventDefault();
    $('#modal-notifications').modal('show');
    var unread = $('#unread-count').attr('count');
    if(unread > 0) {
      $.ajax({
        type:'GET',
        url:'/notifications-read',
        success: function()
          {
            $('#notification-icon').removeClass('bx-tada');
            $('#icon-unread-count').addClass('d-none');
            $('#unread-count').attr('count', 0);
          }
      });
    }
});

$('#btn-close-modal-notifications').click(function() {
    $('.notification-card').each(function() {
      $(this).removeClass('not-read');
    });
});