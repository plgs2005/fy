{{-- @extends('layouts.brand')
@section('content') --}}
<div class="row mt-1 d-flex justify-content-between align-items-baseline mt-2 mb-1">
<div class="col-xl-6 col-md-4 col-sm-6">
    <p class="red-hat-display" style="font-size: 25px;">Active</p>
</div>
<div class="col-xl-6 col-md-4 col-sm-6 text-right">
    <div id="reportrange" class="reportrange btn btn-primary font-weight-normal" style="padding-top: 8px;">
        <i class="bx bx-calendar-alt" style="top: 2px"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
    </div>
</div>
</div>
<div class="row">
<div class="col-xl-3 col-md-4 col-sm-6">
    <div class="card text-center mb-2">
        <div class="card-body d-flex flex-wrap">
            <div class="badge-circle badge-circle-lg my-auto" style="color: #010D33; background-color: rgba(230, 231, 235, 1); min-width: 85px; min-height: 85px;">
                <img src="../assets/images/svg-icons/la-plane.svg" class="img-fluid">
            </div>
            <div class="my-auto ml-2 text-left">
                <p class="title mb-50" style="font-size: 30px;">{{$campaigns->count()}}</p>
                <p class="text-muted mb-0 line-ellipsis">campaigns</p>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-4 col-sm-6">
    <div class="card text-center mb-2">
        <div class="card-body d-flex flex-wrap">
            <div class="badge-circle badge-circle-lg my-auto" style="color: #033FFF; background-color: rgba(230, 236, 255, 1); min-width: 85px; min-height: 85px;">
                <img src="../assets/images/svg-icons/people-audience.svg" class="img-fluid">
            </div>
            <div class="my-auto ml-2 text-left">
                <p class="title mb-50" style="font-size: 30px;">{{$influencers}}</p>
                <p class="text-muted mb-0 line-ellipsis">influencers</p>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-4 col-sm-6">
    <div class="card text-center mb-2">
        <div class="card-body d-flex flex-wrap">
            <div class="badge-circle badge-circle-lg my-auto" style="color: #FF9933; background-color: rgba(255, 253, 251, 1); min-width: 85px; min-height: 85px;">
                <img src="../assets/images/svg-icons/eye-show.svg" class="img-fluid">
            </div>
            <div class="my-auto ml-0 text-left">
                <p class="title mb-50" style="font-size: 30px;">{{thousandsFormat($impressions)}}</p>
                <p class="text-muted mb-0 line-ellipsis">impressions</p>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-4 col-sm-6">
    <div class="card text-center mb-2">
        <div class="card-body d-flex flex-wrap">
            <div class="badge-circle badge-circle-lg my-auto" style="color: #02EEFD; background-color: rgba(230, 253, 255, 1); min-width: 85px; min-height: 85px;">
                <img src="../assets/images/svg-icons/money.svg" class="img-fluid">
            </div>
            <div class="my-auto ml-2 text-left">
                <p class="title mb-50" style="font-size: 30px;">${{thousandsFormat($spent, true)}}</p>
                <p class="text-muted mb-0 line-ellipsis">spent</p>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card container-chart-analytics">
<div class="card-body">
    <div class="row">
        <div class="col-xl-12 col-md-4 col-sm-6">
            <p class="title">Clicks analytics</p>
            @if (!isset($clicksData['countries']))
                No click data for the selected period.
            @else
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    {{-- <label class="btn btn-toggle-location btn-toggle-impressions active" onclick="showChartImpressions('.container-chart-analytics')">
                        <input type="radio" name="options" id="toggle-impressions">
                        <div>impressions</div> 
                    </label> --}}
                    <label class="btn btn-toggle-location btn-toggle-clicks" onclick="showChartClicks('.container-chart-analytics')">
                        <input type="radio" name="options" id="toggle-clicks" checked="">
                        <div>clicks</div> 
                    </label>
                </div>
                {{-- <div class="chart chart-impressions"></div> --}}
            @endif
            @if (!empty($clicksData['days']))
                <div class="chart chart-clicks"></div>
            @endif
            
        </div>
    </div>
    @if (isset($clicksData['countries']))
    <div class="row">
        <div class="col-xl-12 col-md-4 col-sm-6">
            <p class="title">Clicks by location</p>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-toggle-location active clicks-countries">
                    <input type="radio" name="options" id="toggle-update-monthly" checked="">
                    <div>countries</div> 
                </label>
                <label class="btn btn-toggle-location clicks-cities">
                    <input type="radio" name="options" id="toggle-update-annually">
                    <div>cities</div> 
                </label>
            </div>
            <div id="clicks-countries">
                <div>
                    <p class="title text-right" style="font-size: 15px;">clicks</p>
                </div>
                @foreach ($clicksData['countries'] as $country)
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="{{$country['countryFlag']}}" class="icon-country rounded">
                            <p class="title font-weight-normal" style="font-size: 15px;">{{$country['countryName']}}</p>
                        </div>
                        <div>
                            <p style="font-size: 15px; padding-right: 4px;">{{$country['clicks']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="clicks-cities" class="d-none">
                <div>
                    <p class="title text-right" style="font-size: 15px;">clicks</p>
                </div>
                @foreach ($clicksData['cities'] as $key=>$city)
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="{{$city['countryFlag']}}" class="icon-country rounded">
                            <p class="title font-weight-normal" style="font-size: 15px;">{{$key.' - '.$city['countryName']}}</p>
                        </div>
                        <div>
                            <p style="font-size: 15px; padding-right: 4px;">{{$city['clicks']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="col-xl-9 col-md-4 col-sm-6 text-right">
            <div id="mapid" class="mapid"></div>
        </div> --}}
    </div>
    @endif
</div>
</div>
{{-- @endsection
@section('view-js') --}}
<script>

@if (!empty($clicksData['days']))

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
        enabled: true
    },
    series: [
    {
        name: 'Clicks',
        data: [
            @foreach ($clicksData['days'] as $day)
                "{{$day}}",
            @endforeach
        ]
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
            @foreach ($clicksData['days'] as $key=>$day)
                "{{$key}}",
            @endforeach
        ],
        labels: {
            show:false
        }
    },
};
var chart = new ApexCharts(document.querySelector(chart), options);
chart.render();

}

@endif

function configureDateRangePickerAnalytics() {

    var start = moment('{{$data['start']}}', 'YYYYMMDD');
    var end = moment('{{$data['end']}}', 'YYYYMMDD');

    function cb(start, end, first = false) {
        if (first == true) {
            $('.reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        } else {
            $.ajax({
                type:'POST',
                url:'/brand-analytics',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'start': start.format('YYYYMMDD'), 'end': end.format('YYYYMMDD')},
                success:function(data){
                    $("#dashboard-body").html(data);
                }
            });
        }
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

    cb(start, end, true);

};
    
configureDateRangePickerAnalytics();
// configureChartImpressions('.chart-impressions');
@if (!empty($clicksData['days']))
configureChartClicks('.chart-clicks');
@endif
// configureMapAnalytics(mapid);
// $('.btn-toggle-impressions').click();

$('.clicks-countries').click(function() {
    $('#clicks-cities').addClass('d-none');
    $('#clicks-countries').removeClass('d-none');
});

$('.clicks-cities').click(function() {
  $('#clicks-cities').removeClass('d-none');
  $('#clicks-countries').addClass('d-none');
});


</script>
{{-- @endsection --}}