(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

})(window);

(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

})(window);


// ****** Início funções utilizadas na página Login ******

function showHidePassword() {
  if ($('#icon-password').hasClass('bx-show-alt')) {
    $('#icon-password').removeClass('bx-show-alt');
    $('#icon-password').addClass('bx-hide');
    $('#icon-password').attr('title', 'Hide password');
    $('#password').attr('type', 'text');
  } else {
    $('#icon-password').removeClass('bx-hide');
    $('#icon-password').addClass('bx-show-alt');
    $('#icon-password').attr('title', 'Show password');
    $('#password').attr('type', 'password');
  }
}

function validateFormSignup() {
  $('#brand-login-div-right').css('background-image', 'url("../assets/images/background-login2-brand.png")');
  $('#div-1').addClass('d-none');
  $('#div-2').removeClass('d-none');
}

// ****** Fim funções utilizadas na página Login ******




// ****** Início funções utilizadas na página Dashboard ******

function openCampaigns() {
  $("#dashboard-body").load("Campaigns.html");
  $("#dashboard-header-title").html('Campaigns');
}

function openAnalytics() {
  $("#dashboard-body").load("Analytics.html");
  $("#dashboard-header-title").html('Analytics');
}

function openProfile() {
  $("#dashboard-body").load("Profile.html");
  $("#dashboard-header-title").html('Hello, Ana');
}

function openSettings() {
  $("#dashboard-body").load("Settings.html");
  $("#dashboard-header-title").html('Settings');
}

function configureNewCampaignList() {
  $('#campaign-item-2').addClass('d-none');
  $('#campaign-item-3').addClass('d-none');
  $('#campaign-item-4').addClass('d-none');
  $('#campaign-item-5').addClass('d-none');

  $('#campaign-item-2-title').addClass('campaign-item-title-secondary');
  $('#campaign-item-3-title').addClass('campaign-item-title-secondary');
  $('#campaign-item-4-title').addClass('campaign-item-title-secondary');
  $('#campaign-item-5-title').addClass('campaign-item-title-secondary');

  $('#container-timeline-new-campaign').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('#new-campaign-created').addClass('d-none');
}

$('li.nav-item').click(function() {
  $('li.nav-item').not(this).removeClass('open');
});

$('#li-btn-new-campaign').click(function() {
  $('#modal-new-campaign').modal();
  
  $('#dropzone-1')[0].dropzone.options.addRemoveLinks = true;
  $('#dropzone-2')[0].dropzone.options.addRemoveLinks = true;
  $('#dropzone-3')[0].dropzone.options.addRemoveLinks = true;
});

$('#btn-close-modal-new-campaign').click(function() {
  $('#btn-close-modal-new-campaign').addClass('d-none');
  $('#actions-modal-new-campaign').removeClass('d-none');
  $('#actions-modal-new-campaign').addClass('d-flex');
  $('.modal-body-on-action').removeClass('d-none');
});


$('#btn-close-save-modal-new-campaign').click(function() {
  location.reload();
});

$('#btn-close-delete-modal-new-campaign').click(function() {
  location.reload();
});

$('#btn-close-cancel-modal-new-campaign').click(function() {
  $('#btn-close-modal-new-campaign').removeClass('d-none');
  $('#actions-modal-new-campaign').removeClass('d-flex');
  $('#actions-modal-new-campaign').addClass('d-none');
  $('.modal-body-on-action').addClass('d-none');

});

var sliderAge = document.getElementById('slider-age');
if (sliderAge != null) {
  noUiSlider.create(sliderAge, {
    start: [18, 55],
    connect: true,
    tooltips: true,
    step: 1,
    format: wNumb({
      suffix: 'y',
    }),
    range: {
        'min': 0,
        'max': 100
    }
  });
}

var sliderBudget = document.getElementById('slider-budget');
if (sliderBudget != null) {
  noUiSlider.create(sliderBudget, {
      start: [2500],
      connect: 'lower',
      tooltips: true,
      step: 10,
      format: wNumb({
        decimals: 0,
        prefix: '$ ',
      }),
      range: {
          'min': 100,
          'max': 3000
      }
  });

  sliderBudget.noUiSlider.on('update', function( values, handle ) {
    var budgetValue = $('#slider-budget .noUi-handle').attr('aria-valuenow');
    var budgetMax = $('#slider-budget .noUi-handle').attr('aria-valuemax');

    if (budgetValue == budgetMax) {
      $('.budget-overrun').removeClass('d-none');
    } else {
      $('.budget-overrun').addClass('d-none');
    }
  });
}

$('#campaign-item-1-title').click(function() {
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-1').removeClass('d-none');
  $('#campaign-item-1-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-0').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-1').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-0').addClass('badge-circle-primary');
  $('#marker-timeline-new-campaign-1').addClass('badge-circle-primary');
});

$('#campaign-item-2-title').click(function() {
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-2').removeClass('d-none');
  $('#campaign-item-2-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-2').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-2').addClass('badge-circle-primary');
});

$('#campaign-item-3-title').click(function() {
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-3').removeClass('d-none');
  $('#campaign-item-3-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-3').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-3').addClass('badge-circle-primary');
});

$('#campaign-item-4-title').click(function() {
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-4').removeClass('d-none');
  $('#campaign-item-4-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-4').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-4').addClass('badge-circle-primary');
});

$('#campaign-item-5-title').click(function() {
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-5').removeClass('d-none');
  $('#campaign-item-5-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-5').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-5').addClass('badge-circle-primary');
});

$('#campaign-item-1-title-edit').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-1').removeClass('d-none');
  $('#campaign-item-1-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-0').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-1').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-0').addClass('badge-circle-primary');
  $('#marker-timeline-new-campaign-1').addClass('badge-circle-primary');
});

$('#campaign-item-2-title-edit').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-2').removeClass('d-none');
  $('#campaign-item-2-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-2').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-2').addClass('badge-circle-primary');
});

$('#campaign-item-3-title-edit').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-3').removeClass('d-none');
  $('#campaign-item-3-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-3').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-3').addClass('badge-circle-primary');
});

$('#campaign-item-4-title-edit').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-4').removeClass('d-none');
  $('#campaign-item-4-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-4').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-4').addClass('badge-circle-primary');
});

$('#campaign-item-5-title-edit').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('.campaign-item-title').addClass('campaign-item-title-secondary');
  $('.campaign-item').addClass('d-none');
  $('#campaign-item-5').removeClass('d-none');
  $('#campaign-item-5-title').removeClass('campaign-item-title-secondary');
  $('.marker-timeline-new-campaign .badge-circle').removeClass('badge-circle-primary');
  $('.marker-timeline-new-campaign .badge-circle').addClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-5').removeClass('badge-circle-secondary');
  $('#marker-timeline-new-campaign-5').addClass('badge-circle-primary');
});

$('.card-campaign').mouseenter(function() {
  $(' .campaign-selected', this).removeClass('d-none');
});

$('.card-campaign').mouseleave(function() {
  if (!($(' .campaign-selected', this).hasClass('d-flex'))) {
    $(' .campaign-selected', this).addClass('d-none');
  }
});

$('.card-campaign').click(function() {
  $('.campaign-selected').removeClass('d-flex');
  $('.campaign-selected').addClass('d-none');
  $(' .campaign-selected', this).removeClass('d-none');
  $(' .campaign-selected', this).addClass('d-flex');
});

$('.card-type-campaign').mouseenter(function() {
  $(' .card-type-campaign-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-type-campaign').mouseleave(function() {
  if (!($(' .card-type-campaign-selected', this).hasClass('d-flex'))) {
    $(' .card-type-campaign-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-type-campaign').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-type-campaign-selected').removeClass('d-flex');
    $('.card-type-campaign-selected').addClass('d-none');
    $(' .card-type-campaign-selected', this).removeClass('d-none');
    $(' .card-type-campaign-selected', this).addClass('d-flex');
    $('.card-type-campaign svg').addClass('secondary');
    $('.card-type-campaign svg', this).removeClass('primary');
    $('.card-type-campaign + div p').addClass('secondary');
    $('.card-type-campaign + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('.card-goal').mouseenter(function() {
  $(' .card-goal-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-goal').mouseleave(function() {
  if (!($(' .card-goal-selected', this).hasClass('d-flex'))) {
    $(' .card-goal-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-goal').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-goal-selected').removeClass('d-flex');
    $('.card-goal-selected').addClass('d-none');
    $(' .card-goal-selected', this).removeClass('d-none');
    $(' .card-goal-selected', this).addClass('d-flex');
    $('.card-goal svg').addClass('secondary');
    $('.card-goal svg', this).removeClass('primary');
    $('.card-goal + div p').addClass('secondary');
    $('.card-goal + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('.card-audience-1').mouseenter(function() {
  $(' .card-audience-1-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-audience-1').mouseleave(function() {
  if (!($(' .card-audience-1-selected', this).hasClass('d-flex'))) {
    $(' .card-audience-1-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-audience-1').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-audience-1-selected').removeClass('d-flex');
    $('.card-audience-1-selected').addClass('d-none');
    $(' .card-audience-1-selected', this).removeClass('d-none');
    $(' .card-audience-1-selected', this).addClass('d-flex');
    $('.card-audience-1 svg').addClass('secondary');
    $('.card-audience-1 svg', this).removeClass('primary');
    $('.card-audience-1 + div p').addClass('secondary');
    $('.card-audience-1 + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('.card-audience-2').mouseenter(function() {
  $(' .card-audience-2-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-audience-2').mouseleave(function() {
  if (!($(' .card-audience-2-selected', this).hasClass('d-flex'))) {
    $(' .card-audience-2-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-audience-2').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-audience-2-selected').removeClass('d-flex');
    $('.card-audience-2-selected').addClass('d-none');
    $(' .card-audience-2-selected', this).removeClass('d-none');
    $(' .card-audience-2-selected', this).addClass('d-flex');
    $('.card-audience-2 svg').addClass('secondary');
    $('.card-audience-2 svg', this).removeClass('primary');
    $('.card-audience-2 + div p').addClass('secondary');
    $('.card-audience-2 + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('.card-format-1').mouseenter(function() {
  $(' .card-format-1-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-format-1').mouseleave(function() {
  if (!($(' .card-format-1-selected', this).hasClass('d-flex'))) {
    $(' .card-format-1-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-format-1').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    if ($(' .card-format-1-selected', this).hasClass('d-flex')) {
      $(' .card-format-1-selected', this).addClass('d-none');
      $(' .card-format-1-selected', this).removeClass('d-flex');
      $('.card-format-1 svg', this).addClass('primary');
      $(' svg', this).addClass('secondary');
      $(' svg', this).removeClass('primary');
      $(' + div p', this).addClass('secondary');
      $(' +div p', this).removeClass('primary');
    }
    else {
      $(' .card-format-1-selected', this).removeClass('d-none');
      $(' .card-format-1-selected', this).addClass('d-flex');
      $('.card-format-1 svg', this).removeClass('primary');
      $(' svg', this).removeClass('secondary');
      $(' svg', this).addClass('primary');
      $(' + div p', this).removeClass('secondary');
      $(' +div p', this).addClass('primary');
    }
  }
});

$('.card-format-2').mouseenter(function() {
  $(' .card-format-2-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-format-2').mouseleave(function() {
  if (!($(' .card-format-2-selected', this).hasClass('d-flex'))) {
    $(' .card-format-2-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-format-2').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-format-2-selected').removeClass('d-flex');
    $('.card-format-2-selected').addClass('d-none');
    $(' .card-format-2-selected', this).removeClass('d-none');
    $(' .card-format-2-selected', this).addClass('d-flex');
    $('.card-format-2 svg').addClass('secondary');
    $('.card-format-2 svg', this).removeClass('primary');
    $('.card-format-2 + div p').addClass('secondary');
    $('.card-format-2 + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('.card-format-3').mouseenter(function() {
  $(' .card-format-3-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-format-3').mouseleave(function() {
  if (!($(' .card-format-3-selected', this).hasClass('d-flex'))) {
    $(' .card-format-3-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-format-3').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    if ($(' .card-format-3-selected', this).hasClass('d-flex')) {
      $(' .card-format-3-selected', this).addClass('d-none');
      $(' .card-format-3-selected', this).removeClass('d-flex');
      $('.card-format-3 svg', this).addClass('primary');
      $(' svg', this).addClass('secondary');
      $(' svg', this).removeClass('primary');
      $(' + div p', this).addClass('secondary');
      $(' +div p', this).removeClass('primary');
    }
    else {
      $(' .card-format-3-selected', this).removeClass('d-none');
      $(' .card-format-3-selected', this).addClass('d-flex');
      $('.card-format-3 svg', this).removeClass('primary');
      $(' svg', this).removeClass('secondary');
      $(' svg', this).addClass('primary');
      $(' + div p', this).removeClass('secondary');
      $(' +div p', this).addClass('primary');
    }
  }
});

$('.card-format-4').mouseenter(function() {
  $(' .card-format-4-selected', this).removeClass('d-none');
  $(' svg', this).removeClass('secondary');
  $(' svg', this).addClass('primary');
  $(' + div p', this).removeClass('secondary');
  $(' +div p', this).addClass('primary');
});

$('.card-format-4').mouseleave(function() {
  if (!($(' .card-format-4-selected', this).hasClass('d-flex'))) {
    $(' .card-format-4-selected', this).addClass('d-none');
    $(' svg', this).addClass('secondary');
    $(' svg', this).removeClass('primary');
    $(' + div p', this).addClass('secondary');
    $(' +div p', this).removeClass('primary');
  }
});

$('.card-format-4').click(function() {
  if (!($(this).hasClass('campaign-pro'))) {
    $('.card-format-4-selected').removeClass('d-flex');
    $('.card-format-4-selected').addClass('d-none');
    $(' .card-format-4-selected', this).removeClass('d-none');
    $(' .card-format-4-selected', this).addClass('d-flex');
    $('.card-format-4 svg').addClass('secondary');
    $('.card-format-4 svg', this).removeClass('primary');
    $('.card-format-4 + div p').addClass('secondary');
    $('.card-format-4 + div p').removeClass('primary');
    $(' svg', this).removeClass('secondary');
    $(' svg', this).addClass('primary');
    $(' + div p', this).removeClass('secondary');
    $(' +div p', this).addClass('primary');
  }
});

$('#btn-create-campaign-scratch').click(function() {
  $('#container-timeline-new-campaign').removeClass('d-none');
  $('#existing-campaign').addClass('d-none');
});

$('#btn-review-campaign').click(function() {
  $('#container-timeline-new-campaign').addClass('d-none');
  $('#new-campaign-review').removeClass('d-none');
  $('#new-campaign-switch').removeClass('d-none');
  $('#new-campaign-payment').removeClass('d-none');
});

$('.btn-pay-start-campaign').click(function() {
  $('#new-campaign-review').addClass('d-none');
  $('#new-campaign-switch').addClass('d-none');
  $('#new-campaign-payment').addClass('d-none');
  $('#new-campaign-created').removeClass('d-none');
});

$('#btn-go-to-campaigns').click(function() {
  $('#modal-new-campaign').modal('toggle');
  openCampaigns();
});

$('.campaign-pro').click(function() {
  $('#modal-upgrade').modal();
});

$('#switch-influencers-1').click(function(e) {
  if ($('#switch-influencers-1').hasClass('toggle-pro')) {
    e.preventDefault();
    $('#modal-upgrade').modal();
  } else {
    if ($('.switch-influencers-1-text-right').hasClass('primary')){
      $('.switch-influencers-1-text-left').addClass('primary');
      $('.switch-influencers-1-text-right').removeClass('primary');
    } else {
      $('.switch-influencers-1-text-left').removeClass('primary');
      $('.switch-influencers-1-text-right').addClass('primary');
    }
  }
});

$('#switch-influencers-2').click(function(e) {
  if ($('#switch-influencers-2').hasClass('toggle-pro')) {
    e.preventDefault();
    $('#modal-upgrade').modal();
  } else {
    if ($('.switch-influencers-2-text-right').hasClass('primary')){
      $('.switch-influencers-2-text-left').addClass('primary');
      $('.switch-influencers-2-text-right').removeClass('primary');
    } else {
      $('.switch-influencers-2-text-left').removeClass('primary');
      $('.switch-influencers-2-text-right').addClass('primary');
    }
  }
});

$('#switch1').click(function(e) {
  if ($('.switch1').hasClass('primary')){
    $('.switch1').removeClass('primary');
  } else {
    $('.switch1').addClass('primary');
  }
});

$('#switch2').click(function(e) {
  if ($('.switch2').hasClass('primary')){
    $('.switch2').removeClass('primary');
  } else {
    $('.switch2').addClass('primary');
  }
});

$('#switch3').click(function(e) {
  if ($('.switch3').hasClass('primary')){
    $('.switch3').removeClass('primary');
  } else {
    $('.switch3').addClass('primary');
  }
});

$('.datepicker').pickadate({
  format: 'd mmm, yyyy'
});

$('.timepicker').pickatime();

// ****** Fim funções utilizadas na página Dashboard ******




// ****** Início funções utilizadas na página Campaign ******

function configurationStartScreenCampaigns() {
  $('.container-analytics').addClass('d-none');
  $('#toggle-campaign-active').click();
}

function seeHideAnalytics(campaign, mapid) {
    if ($('hr', campaign).hasClass('d-none')) {
      $('hr', campaign).removeClass('d-none');
      $('.container-analytics', campaign).removeClass('d-none');
      $('.impressions-clicks-selected', campaign).addClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('hide analytics');
    } else {
      $('hr', campaign).addClass('d-none');
      $('.container-analytics', campaign).addClass('d-none');
      $('.container-influencers', campaign).addClass('d-none');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
    }
}

function seeHideInfluencers(campaign, mapid) {
    if ($('hr', campaign).hasClass('d-none')) {
      $('hr', campaign).removeClass('d-none');
      $('.container-influencers', campaign).removeClass('d-none');
      $('.influencers-selected', campaign).addClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('hide analytics');
    } else {
      $('hr', campaign).addClass('d-none');
      $('.container-influencers', campaign).addClass('d-none');
      $('.container-analytics', campaign).addClass('d-none');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
      seeHideInfluencers(campaign, mapid);
    }
}

function seeHideImpressionsClicks(campaign, mapid) {
    if ($('hr', campaign).hasClass('d-none')) {
      $('hr', campaign).removeClass('d-none');
      $('.container-analytics', campaign).removeClass('d-none');
      $('.impressions-clicks-selected', campaign).addClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('hide analytics');
    } else {
      $('hr', campaign).addClass('d-none');
      $('.container-analytics', campaign).addClass('d-none');
      $('.container-influencers', campaign).addClass('d-none');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
    }
}

function removeInfluencerSelected(card) {
  var queryLeft = '#modal-select-influencer-left ' + card;
  var queryRight = '#modal-select-influencer-right ' + card;
  $(queryLeft).removeClass('selected');
  $(queryRight).remove();

  var counterInfluencerLeft = $('#modal-select-influencer-left .card-influencer-alt.selected').length;

  if (counterInfluencerLeft >= 3 ) {
      $('#btn-finish-select-influencers').attr('disabled', false);
  } else {
      $('#btn-finish-select-influencers').attr('disabled', true);
  }

  var counterInfluencerRight = $('#modal-select-influencer-right .card-influencer-alt').length;

  if (counterInfluencerRight >= 1 ) {
    $('#div-influencers-selected').removeClass('d-none');
    $('#div-no-influencers-selected').addClass('d-none');
  } else {
    $('#div-influencers-selected').addClass('d-none');
    $('#div-no-influencers-selected').removeClass('d-none');
  }
}

// ****** Fim funções utilizadas na página Campaign ******




// ****** Início funções utilizadas na página Profile ******

function showHidePasswordProfile(x) {
  if (x == 0) {
    if ($('#icon-new-password').hasClass('bx-show-alt')) {
      $('#icon-new-password').removeClass('bx-show-alt');
      $('#icon-new-password').addClass('bx-hide');
      $('#icon-new-password').attr('title', 'Hide password');
      $('#new-password').attr('type', 'text');
    } else {
      $('#icon-new-password').removeClass('bx-hide');
      $('#icon-new-password').addClass('bx-show-alt');
      $('#icon-new-password').attr('title', 'Show password');
      $('#new-password').attr('type', 'password');
    }
  } else if (x == 1){
    if ($('#icon-repeat-new-password').hasClass('bx-show-alt')) {
      $('#icon-repeat-new-password').removeClass('bx-show-alt');
      $('#icon-repeat-new-password').addClass('bx-hide');
      $('#icon-repeat-new-password').attr('title', 'Hide password');
      $('#repeat-new-password').attr('type', 'text');
    } else {
      $('#icon-repeat-new-password').removeClass('bx-hide');
      $('#icon-repeat-new-password').addClass('bx-show-alt');
      $('#icon-repeat-new-password').attr('title', 'Show password');
      $('#repeat-new-password').attr('type', 'password');
    }
  }
}

// ****** Fim funções utilizadas na página Profile ******




// ****** Início funções compartilhadas entre as páginas  ******

function configureDateRangePickerAnalytics() {

  var start = moment().subtract(29, 'days');
  var end = moment();

  function cb(start, end) {
      $('.reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
  }

  $('.reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);

  cb(start, end);

};

function configureChartImpressions(chart) {

  var options = {
  chart: {
    height: 280,
    type: "area",
    toolbar: {
      show: false
    }
  },
  colors: ["#033FFF"],
  dataLabels: {
    enabled: false
  },
  series: [
    {
      data: [12, 82, 20],
    }
  ],
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
      stops: [0, 90, 100]
    }
  },
  grid: {
    show: false
  },
  xaxis: {
    categories: [
      "set, 28",
      "oct, 13",
      "oct, 30"
    ]
  },
};
var chart = new ApexCharts(document.querySelector(chart), options);
chart.render();
  
}

function configureChartClicks(chart) {

  var options = {
  chart: {
    height: 280,
    type: "area",
    toolbar: {
      show: false
    }
  },
  colors: ["#033FFF"],
  dataLabels: {
    enabled: false
  },
  series: [
    {
      data: [52, 42, 70]
    }
  ],
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
      stops: [0, 90, 100]
    }
  },
  grid: {
    show: false
  },
  xaxis: {
    categories: [
      "set, 28",
      "oct, 13",
      "oct, 30"
    ]
  },
};
var chart = new ApexCharts(document.querySelector(chart), options);
chart.render();
  
}

function configureMapAnalytics(id) {
  var map = L.map(id).setView([51.505, -0.09], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  
  L.marker([51.5, -0.09]).addTo(map)
      .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
      .openPopup();
}

function addNewCreditCard(divCard) {
  if ($(' #new-card', divCard).hasClass('d-none')) {
      $(' #new-card', divCard).removeClass('d-none');
      $(' #cards-no-content', divCard).addClass('d-none');
      $(' #cards-content', divCard).addClass('d-none');
      $(' .btn-add-new-credit-card', divCard)[0].value = 'Use existing cards';
  } else {
      $(' #new-card', divCard).addClass('d-none');
      $(' #cards-no-content', divCard).addClass('d-none');
      $(' #cards-content', divCard).removeClass('d-none');
      $(' .btn-add-new-credit-card', divCard)[0].value = 'Add new credit card';
  }
}

function selectCreditCard(divCard) {
  if ($('> div', divCard).hasClass('d-none')) {
    $('> div', divCard).removeClass('d-none');
    $('+ div.card-column-action', divCard).removeClass('d-none');
  } else {
    $('> div', divCard).addClass('d-none');
    $('+ div.card-column-action', divCard).addClass('d-none');
  }
}

function showChartImpressions(divContainerChart) {
  $(' .chart', divContainerChart).addClass('d-none');
  $(' .chart-impressions', divContainerChart).removeClass('d-none');
}

function showChartClicks(divContainerChart) {
  $(' .chart', divContainerChart).addClass('d-none');
  $(' .chart-clicks', divContainerChart).removeClass('d-none');
}

// ****** Fim funções compartilhadas entre as páginas  ******




// ****** Influencer ******

// ****** Início funções utilizadas na página Login  ******

var sliderPantsMen = document.getElementById('slider-pants-men');
if (sliderPantsMen != null) {
noUiSlider.create(sliderPantsMen, {
    start: [2],
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
    start: [2],
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
      start: [4],
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
    start: [5],
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
        start: [10],
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
        start: [10],
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

function validateFormSignupInfluencer() {
  $('#div-0').addClass('d-none');
  $('#div-1').removeClass('d-none');
}

function selectNichesInfluencer(customSwitch) {
  if ($('.niches p.' + customSwitch).hasClass('primary')) {
    $('.niches p.' + customSwitch).removeClass('primary p-500');
  } 
  else {
    $('.niches p.' + customSwitch).addClass('primary p-500');
  }
}

$('#btn-arrow-back-div-1a').click(function() {
  $('#login-main').removeClass('d-none');
  $('#login-timeline').addClass('d-none');
  $('#div-1a').addClass('d-none');
});

$('#btn-arrow-back-div-1b').click(function() {
  $('#div-1a').removeClass('d-none');
  $('#div-1b').addClass('d-none');
  $('#btn-arrow-back-div-1a').removeClass('d-none');
  $('#btn-arrow-back-div-1b').addClass('d-none');
});

$('#btn-arrow-back-div-2').click(function() {
  $('#div-1b').removeClass('d-none');
  $('#div-2').addClass('d-none');
  $('#btn-arrow-back-div-1b').removeClass('d-none');
  $('#btn-arrow-back-div-2').addClass('d-none');
  $('#hr-timeline-login-mobile').css('width', '15%');
  $('#hr-1').removeClass('primary-line');
  $('#hr-1').addClass('gradient-line');
  $('#hr-2').removeClass('gradient-line');
  $('#icon-check-1').addClass('d-none');
  $('#marker-timeline-login-influencer-1').removeClass('d-none');
  $('#marker-timeline-login-influencer-2').removeClass('badge-circle-primary');
  $('#marker-timeline-login-influencer-2').addClass('badge-circle-secondary');
});

$('#btn-arrow-back-div-3').click(function() {
  $('#div-2').removeClass('d-none');
  $('#div-3').addClass('d-none');
  $('#btn-arrow-back-div-2').removeClass('d-none');
  $('#btn-arrow-back-div-3').addClass('d-none');
  $('#hr-timeline-login-mobile').css('width', '30%');
  $('#hr-2').addClass('gradient-line');
  $('#hr-2').removeClass('primary-line');
  $('#hr-3').removeClass('gradient-line');
  $('#icon-check-2').addClass('d-none');
  $('#marker-timeline-login-influencer-2').removeClass('d-none');
  $('#marker-timeline-login-influencer-3').addClass('badge-circle-secondary');
  $('#marker-timeline-login-influencer-3').removeClass('badge-circle-primary');
  $('#btn-arrow-back-div-2').removeClass('d-none');
  $('#btn-arrow-back-div-3').addClass('d-none');
});

$('#btn-arrow-back-div-4').click(function() {
  $('#div-3').removeClass('d-none');
  $('#div-4').addClass('d-none');
  $('#btn-arrow-back-div-3').removeClass('d-none');
  $('#btn-arrow-back-div-4').addClass('d-none');
  $('#hr-timeline-login-mobile').css('width', '50%');
  $('#hr-3').addClass('gradient-line');
  $('#hr-3').removeClass('primary-line');
  $('#hr-4').removeClass('gradient-line');
  $('#icon-check-3').addClass('d-none');
  $('#marker-timeline-login-influencer-3').removeClass('d-none');
  $('#marker-timeline-login-influencer-4').addClass('badge-circle-secondary');
  $('#marker-timeline-login-influencer-4').removeClass('badge-circle-primary');
  $('#btn-arrow-back-div-3').removeClass('d-none');
  $('#btn-arrow-back-div-4').addClass('d-none');
});

$('#btn-continue-to-div-1a').click(function() {
  $('#login-main').addClass('d-none');
  $('#login-timeline').removeClass('d-none');
  $('#div-1a').removeClass('d-none');
  $('#btn-arrow-back-div-1a').removeClass('d-none');
});

// $('#btn-connect-account').click(function() {
//   $('#div-1a').addClass('d-none');
//   $('#div-1b').removeClass('d-none');
//   $('#btn-arrow-back-div-1a').addClass('d-none');
//   $('#btn-arrow-back-div-1b').removeClass('d-none');
// });

// $('#btn-continue-connect-account').click(function() {
//   $('#hr-timeline-login-mobile').css('width', '30%');
//   $('#div-1b').addClass('d-none');
//   $('#div-2').removeClass('d-none');
//   $('#hr-1').removeClass('gradient-line');
//   $('#hr-1').addClass('primary-line');
//   $('#hr-2').addClass('gradient-line');
//   $('#icon-check-1').removeClass('d-none');
//   $('#marker-timeline-login-influencer-1').addClass('d-none');
//   $('#marker-timeline-login-influencer-2').removeClass('badge-circle-secondary');
//   $('#marker-timeline-login-influencer-2').addClass('badge-circle-primary');
//   $('#btn-arrow-back-div-1b').addClass('d-none');
//   $('#btn-arrow-back-div-2').removeClass('d-none');
// });

$('#btn-back-to-div-1b').click(function() {
  $('#hr-timeline-login-mobile').css('width', '15%');
  $('#div-1b').removeClass('d-none');
  $('#div-2').addClass('d-none');
  $('#hr-1').removeClass('primary-line');
  $('#hr-1').addClass('gradient-line');
  $('#hr-2').removeClass('gradient-line');
  $('#icon-check-1').addClass('d-none');
  $('#marker-timeline-login-influencer-1').removeClass('d-none');
  $('#marker-timeline-login-influencer-2').removeClass('badge-circle-primary');
  $('#marker-timeline-login-influencer-2').addClass('badge-circle-secondary');
  $('#btn-arrow-back-div-1b').removeClass('d-none');
  $('#btn-arrow-back-div-2').addClass('d-none');
});

$('#btn-yes-div-2').click(function() {
  $('#hr-timeline-login-mobile').css('width', '50%');
  $('#div-2').addClass('d-none');
  $('#div-3').removeClass('d-none');
  $('#hr-2').removeClass('gradient-line');
  $('#hr-2').addClass('primary-line');
  $('#hr-3').addClass('gradient-line');
  $('#icon-check-2').removeClass('d-none');
  $('#marker-timeline-login-influencer-2').addClass('d-none');
  $('#marker-timeline-login-influencer-3').removeClass('badge-circle-secondary');
  $('#marker-timeline-login-influencer-3').addClass('badge-circle-primary');
  $('#btn-arrow-back-div-2').addClass('d-none');
  $('#btn-arrow-back-div-3').removeClass('d-none');
});

/*
$('#btn-continue-to-div-4').click(function() {
  $('#hr-timeline-login-mobile').css('width', '70%');
  $('#div-3').addClass('d-none');
  $('#div-4').removeClass('d-none');
  $('#hr-3').removeClass('gradient-line');
  $('#hr-3').addClass('primary-line');
  $('#hr-4').addClass('gradient-line');
  $('#icon-check-3').removeClass('d-none');
  $('#marker-timeline-login-influencer-3').addClass('d-none');
  $('#marker-timeline-login-influencer-4').removeClass('badge-circle-secondary');
  $('#marker-timeline-login-influencer-4').addClass('badge-circle-primary');
  $('#btn-arrow-back-div-3').addClass('d-none');
  $('#btn-arrow-back-div-4').removeClass('d-none');
  $('#toggle-unit-usa').addClass('active');
  $('#toggle-gender-female').addClass('active');
  loadMeasurementsByGender();
});

$('#btn-continue-div-4').click(function() {
  $('#login-timeline').addClass('d-none');
  $('#div-4').addClass('d-none');
  $('#div-5').removeClass('d-none');
  $('#btn-arrow-back-div-4').addClass('d-none');
});*/

$('#btn-later-div-4').click(function() {
  $('#login-timeline').addClass('d-none');
  $('#div-4').addClass('d-none');
  $('#div-5').removeClass('d-none');
  $('#btn-arrow-back-div-4').addClass('d-none');
});

$('.niches').click(function() {
  if ($(this).hasClass('niches-open')){
    $(this).removeClass('niches-open');
  } else {
    $(this).addClass('niches-open');
  }
});

$('#btn-manual-address').click(function() {
  if ($('#div-manual-address').hasClass('d-none')) {
      $('#div-manual-address').removeClass('d-none');
  } else {
      $('#div-manual-address').addClass('d-none');
  }
});

// ****** Fim funções utilizadas na página Login ******




// ****** Início funções utilizadas na página Dashboard ******

function openProfileInfluencer() {
  $.ajax({
    type:'GET',
    url:'/influencer-profile',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Profile');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
});
}

function openDeliveryAddress() {
  $.ajax({
    type:'GET',
    url:'/influencer-address',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Delivery address');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
});
}

function openSocialAccounts() {
  $.ajax({
    type:'GET',
    url:'/social-accounts',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Accounts');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
});
}

function openCategoriesAndNiches() {
  $.ajax({
    type:'GET',
    url:'/influencer-categories',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Categories and Niches');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
});
}

function openMeasurements() {
  $.ajax({
    type:'GET',
    url:'/influencer-measurements',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Your Measurements');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
  });
}

function openPayments() {
  $.ajax({
    type:'GET',
    url:'/payments',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Payments');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
  });
}

function openBankInfo() {
  $.ajax({
    type:'GET',
    url:'/bankInfo',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Bank info');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
  });
}

function openGiftOnly() {
  $.ajax({
    type:'GET',
    url:'/giftOnly',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Gift-only Campaigns?');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
  });
}

function openDeleteAccount() {
  $.ajax({
    type:'GET',
    url:'/deleteAccount',
    success:function(data){
      $("#dashboard-body").html(data);
      $("#dashboard-header-title").html('Delete your account');
      if (!($('.tutorial').hasClass('d-none'))) {
        $('.tutorial').addClass('d-none');
      }
      $('#btn-back-campaigns').addClass('d-none');
    },
    error:function(data){
      if(data.status == 401){
        location.reload();
      }
    },
  });
}

$('li.nav-item-influencer').not('li.nav-item-influencer.settings').click(function() {
  $('li.nav-item-influencer').removeClass('open');
  $('li.nav-item-influencer').removeClass('opened');
  $('.settings-submenu').removeClass('opened');
  $('#container-settings-submenu').addClass('d-none');
  $(this).addClass('opened');
});

$('.settings-submenu').click(function() {
  $('.settings-submenu').removeClass('opened');
  $(this).addClass('opened');
});

$('#btn-show-hide-tutorial').click(function() {
  if ($('.tutorial').hasClass('d-none')) {
    $('.tutorial').removeClass('d-none');
    $('#btn-show-hide-tutorial').val('Hide tutorial');
    $('li.nav-item-influencer.settings a').click();
  } else {
    $('.tutorial').addClass('d-none');
    $('#btn-show-hide-tutorial').val('Show tutorial');
    $('li.nav-item-influencer.settings a').click();
  }
});

$('#btn-skip-welcome-modal').click(function() {
  var viewportWidth = $(window).width();
  $('#modal-welcome').modal('toggle');
  if (viewportWidth < 1200) {
    openCampaignsInfluencer();
  } else {
    $('.tutorial').removeClass('d-none');
  }
});

$('.toggle-welcome').click(function() {
  $('.toggle-welcome').removeClass('active');
  $(this).addClass('active');
});

$('#toggle-welcome-1').click(function() {
  var viewportWidth = $(window).width();
  if (viewportWidth < 575.98) {
    $('#div-welcome-influencer').css('background-image', 'url("../assets/images/background-div-welcome-mobile-1.png")');
  }
});

$('#toggle-welcome-2').click(function() {
  var viewportWidth = $(window).width();
  if (viewportWidth < 575.98) {
    $('#div-welcome-influencer').css('background-image', 'url("../assets/images/background-div-welcome-mobile-2.png")');
  }
});

var ts_x;
var ts_y;
$('#modal-welcome').bind('touchstart', function(e) {
   ts_x = e.originalEvent.touches[0].clientX;
   ts_y = e.originalEvent.touches[0].clientY;
});
$('#modal-welcome').bind('touchend', function(e) {
   var td_x = e.originalEvent.changedTouches[0].clientX - ts_x;
   var td_y = e.originalEvent.changedTouches[0].clientY - ts_y;
   // O movimento principal foi vertical ou horizontal?
   if( Math.abs( td_x ) > Math.abs( td_y ) ) {
      // é horizontal
      if( td_x < 0 ) {
         // movimento para a esquerda
         if ($('#toggle-welcome-1').hasClass('active')) {
          $('#toggle-welcome-2').click();
         }
      } else {
         // movimento para a direita
         if ($('#toggle-welcome-2').hasClass('active')) {
          $('#toggle-welcome-1').click();
         }
      }
   } else {
      // é vertical
      if( td_y < 0 ) {
         // cima
      } else {
         // baixo
      }
    }
 });

 $('#btn-toggle-menu').click(function() {
  $('#modal-main-menu-mobile').modal();
 });

 $('#btn-toggle-menu-back').click(function() {
  $('#modal-main-menu-mobile').modal();
  $('#modal-main-menu-mobile-settings').modal();
  $('#btn-toggle-menu').addClass('d-block');
  $('#btn-toggle-menu').removeClass('d-none');
  $('#btn-toggle-menu-back').addClass('d-none');
 });

 $('#btn-back-menu').click(function() {
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#btn-edit-profile-menu-mobile').click(function() {
  openProfileInfluencer();
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-campaigns').click(function() {
  document.location.href = '/influencer-campaigns';
 });

 $('#menu-mobile-item-settings').click(function() {
  $('#modal-main-menu-mobile-settings').modal();
 });

 $('#menu-mobile-item-delivery-address').click(function() {
  openDeliveryAddress();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-social-accounts').click(function() {
  openSocialAccounts();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-categories-niches').click(function() {
  openCategoriesAndNiches();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-your-measurements').click(function() {
  openYourMeasurements();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-payments').click(function() {
  openPayments();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-bank-info').click(function() {
  openBankInfo();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#menu-mobile-item-delete-account').click(function() {
  openDeleteAccount();
  $('#btn-toggle-menu').removeClass('d-block');
  $('#btn-toggle-menu').addClass('d-none');
  $('#btn-toggle-menu-back').removeClass('d-none');
  $('#modal-main-menu-mobile-settings').modal('toggle');
  $('#modal-main-menu-mobile').modal('toggle');
 });

 $('#btn-back-settings').click(function() {
  $('#modal-main-menu-mobile-settings').modal('toggle');
 });


// ****** Fim funções utilizadas na página Dashboard ******


// ****** Início funções utilizadas na página Campaigns ******

function openCampaignDetails(campaign, campaignId, status) {
  var viewportWidth = $(window).width();
  if (viewportWidth > 575.98) {
    $.ajax({
        type:'GET',
        url:'/influencer-campaign-details/'+campaignId,
        success:function(data){
            $("#campaign_details_"+status).html(data);
            $('#btn-back-campaigns').removeClass('d-none');
            $('#container-toggle-campaigns').addClass('d-none');
            $('#guide-active .container-card-campaign-active').addClass('d-none');
            $('#guide-active .guide-campaigns-details').addClass('d-none');
            $('#guide-scheduled .container-card-campaign-active').addClass('d-none');
            $('#guide-scheduled .guide-campaigns-details').addClass('d-none');
            $('#guide-ended .container-card-campaign-active').addClass('d-none');
            $('#guide-ended .guide-campaigns-details').addClass('d-none');
            $(campaign).removeClass('d-none');
            $('#dashboard-header-title')[0].innerText = status+' campaigns';
        }
    });
  } else {
    $.ajax({
      type:'GET',
      url:'/influencer-campaign-details/'+campaignId,
      success:function(data){
          $("#campaign_details_modal").html(data);
          $(campaign+'-mobile').modal();
        }
    });
  }
}

function openJob(job) {
  var viewportWidth = $(window).width();
  if (viewportWidth > 575.98) {
    $('#btn-back-campaigns').removeClass('d-none');
    $('#container-toggle-campaigns').addClass('d-none');
    $('#guide-jobs .container-jobs').addClass('d-none');
    $('#guide-jobs .job-details').addClass('d-none');
    $(job).removeClass('d-none');
    $('#dashboard-header-title')[0].innerText = 'Jobs';
  } else {
    $(job+'-mobile').modal();
  }
}

function acceptJob(job, campaignId, campaignName) {
  $.ajax({
    type:'POST',
    url:'/accept-job',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {'campaign_id': campaignId},
    success:function(data){
        if(data.status == 'success'){
          var viewportWidth = $(window).width();
          if (viewportWidth > 575.98) {
            $('#btn-back-campaigns').addClass('d-none');
            $(job).addClass('d-none');
            $('#div-accept-job').removeClass('d-none');
            $('#dashboard-header-title')[0].innerText = 'Accept job';
            $('#accept_campaign_name').html(campaignName);
          } else {
            $('#modal-main-menu-mobile-accept-job').modal();
            $(job).modal('toggle');
          }
        }else if(data.status == 'error'){
            toastr.error(data.message, "Error");
        }
    },
    error:function(data){
        $.each(data.responseJSON.errors, function(idex, item){
            toastr.warning(item[0], "Warning")
        });
    },
  });
  
}

function declineJob(job, campaignId, campaignName) {
  
  var viewportWidth = $(window).width();
  if (viewportWidth > 575.98) {
    $(job).addClass('d-none');
    $('#div-decline-job').removeClass('d-none');
    $('#dashboard-header-title')[0].innerText = 'Decline job';
    $('#decline_campaign_name').html(campaignName);
    $('#btn-decline-job-back').attr('campaign_id', campaignId);
    $('#campaign_id').val(campaignId);
  } else {
    $('#modal-main-menu-mobile-decline-job').modal();
    $('#campaign_id').val(campaignId);
  }
}

function addLinkJob() {
  var modelAddLinkJob = $('#model-add-link-job')[0].innerHTML;
  $('#div-add-link-job').append(modelAddLinkJob);
}

function addLinkJobMobile() {
  var modelAddLinkJob = $('#model-add-link-job-mobile')[0].innerHTML;
  $('#div-add-link-job-mobile').append(modelAddLinkJob);
}

// ****** Fim funções utilizadas na página Campaigns ******




// ****** Início funções compartilhadas entre as páginas  ******

// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

$('li.nav-item-influencer.settings a').click(function() {
  if ($('li.nav-item-influencer.settings').hasClass('opened')) {
    $('li.nav-item-influencer.settings').removeClass('opened');
    $('#container-settings-submenu').addClass('d-none');
  } else {
    $('li.nav-item-influencer.settings').addClass('opened');
    $('#container-settings-submenu').removeClass('d-none');
  }
});
// ****** Fim funções compartilhadas entre as páginas  ******