//login/register
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

//register
function showHidePasswordConfirmation() {
  if ($('#icon-password-confirm').hasClass('bx-show-alt')) {
    $('#icon-password-confirm').removeClass('bx-show-alt');
    $('#icon-password-confirm').addClass('bx-hide');
    $('#icon-password-confirm').attr('title', 'Hide password');
    $('#password-confirm').attr('type', 'text');
  } else {
    $('#icon-password-confirm').removeClass('bx-hide');
    $('#icon-password-confirm').addClass('bx-show-alt');
    $('#icon-password-confirm').attr('title', 'Show password');
    $('#password-confirm').attr('type', 'password');
  }
}


//deprecated
// function newCampaign() {
//   $.ajax({
//     type:'GET',
//     url:'/campaign-create',
//     success:function(data){
//        $("#container-modal-new-campaign").html(data);
//        $('#modal-new-campaign').modal('show')
//     }
//  });
// }

//deprecated
// function openCampaigns() {
//   $.ajax({
//     type:'GET',
//     url:'/brand-campaigns-ajax',
//     data: {'ajax': true},
//     success:function(data){
//        $("#dashboard-body").html(data);
//        $("#dashboard-header-title").html('Campaigns');
//        window.scrollTo(0, 0);
//     }
//  });
// }

//deprecated
// function openSettings() {
//   $("#dashboard-body").load("Settings.html");
//   $("#dashboard-header-title").html('Settings');
// }


//analytics/campaigns
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

//analytics/campaigns


//analytics/campaigns
function configureMapAnalytics(id) {
  var map = L.map(id).setView([51.505, -0.09], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  
  L.marker([51.5, -0.09]).addTo(map)
      .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
      .openPopup();
}

function configurationStartScreenCampaigns() {
  $('.container-analytics').addClass('d-none');
  $('#toggle-campaign-active').click();
}

function seeHideAnalytics(campaign, id) {
    if ($('.container-analytics', campaign).hasClass('d-none')) {
      if ($('hr', campaign).hasClass('d-none')) {
        $('hr', campaign).removeClass('d-none');
      }
      $('.container-analytics', campaign).removeClass('d-none');
      $('.container-influencers', campaign).addClass('d-none');
      $('.impressions-clicks-selected', campaign).addClass('btn-secondary');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('hide analytics');
      if($("#container-analytics"+id).attr('analytics-loaded') == "false") {
        $.ajax({
          type:'POST',
          url:'/campaign-analytics',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {'campaignId': id},
          success:function(data){
            $("#container-analytics"+id).html(data);
            $("#container-analytics"+id).attr('analytics-loaded', 'true');
          }
      });
      }
    } else {
      if (!$('hr', campaign).hasClass('d-none')) {
        $('hr', campaign).addClass('d-none');
      }
      $('.container-analytics', campaign).addClass('d-none');
      $('.container-influencers', campaign).addClass('d-none');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
    }
}

function seeHideInfluencers(campaign) {
    if ($('.container-influencers', campaign).hasClass('d-none')) {
      if ($('hr', campaign).hasClass('d-none')) {
        $('hr', campaign).removeClass('d-none');
      }
      $('.container-influencers', campaign).removeClass('d-none');
      $('.container-analytics', campaign).addClass('d-none');
      $('.influencers-selected', campaign).addClass('btn-secondary');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
    } else {
      if (!$('hr', campaign).hasClass('d-none')) {
        $('hr', campaign).addClass('d-none');
      }
      $('.container-influencers', campaign).addClass('d-none');
      $('.container-analytics', campaign).addClass('d-none');
      $('.influencers-selected', campaign).removeClass('btn-secondary');
      $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
      $('.see-hide-analytics', campaign).html('see analytics');
    }
}

// function seeHideImpressionsClicks(campaign) {
//     if ($('hr', campaign).hasClass('d-none')) {
//       $('hr', campaign).removeClass('d-none');
//       $('.container-analytics', campaign).removeClass('d-none');
//       $('.impressions-clicks-selected', campaign).addClass('btn-secondary');
//       $('.see-hide-analytics', campaign).html('hide analytics');
//     } else {
//       $('hr', campaign).addClass('d-none');
//       $('.container-analytics', campaign).addClass('d-none');
//       $('.container-influencers', campaign).addClass('d-none');
//       $('.impressions-clicks-selected', campaign).removeClass('btn-secondary');
//       $('.influencers-selected', campaign).removeClass('btn-secondary');
//       $('.see-hide-analytics', campaign).html('see analytics');
//     }
// }




//???????????????-------
$('li.nav-item').click(function() {
  $('li.nav-item').not(this).removeClass('open');
});



function showChartImpressions(divContainerChart) {
  $(' .chart', divContainerChart).addClass('d-none');
  $(' .chart-impressions', divContainerChart).removeClass('d-none');
  $('.impressionsByLocation').removeClass('d-none');
  $('.clicksByLocation').addClass('d-none');
}

function showChartClicks(divContainerChart) {
  $(' .chart', divContainerChart).addClass('d-none');
  $(' .chart-clicks', divContainerChart).removeClass('d-none');
  $('.impressionsByLocation').addClass('d-none');
  $('.clicksByLocation').removeClass('d-none');
}

$('.campaign-pro').click(function() {
  if (!($(this).hasClass('subscription-active'))) {
    $('#modal-upgrade').modal();
  }
});

$('#open-brand-analytics').click(function() {
  $.ajax({
    type:'POST',
    url:'/brand-analytics',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {'first': true},
    success:function(data){
       $("#dashboard-body").html(data);
    }
 });
});