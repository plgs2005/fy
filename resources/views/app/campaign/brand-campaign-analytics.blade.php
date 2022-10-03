{{-- impressions and clicks charts --}}
<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="title mb-0">Clicks analytics</p>
            </div>
            <div>
                <div id="reportrange{{$campaign->id}}" class="reportrange{{$campaign->id}} btn btn-primary font-weight-normal">
                    <i class="bx bx-calendar-alt"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        @if (empty($campaign->clicksData['countries']))
            No click data for the selected period.
        @else
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                {{-- <label class="btn btn-toggle-location btn-toggle-impressions active" onclick="showChartImpressions('#campaign-{{$campaign->id}}')">
                <input type="radio" name="options" id="toggle-impressions">
                <div>impressions</div> 
                </label> --}}
                <label class="btn btn-toggle-location btn-toggle-clicks" onclick="showChartClicks('#campaign-{{$campaign->id}}')">
                <input type="radio" name="options" id="toggle-clicks" checked="">
                <div>clicks</div> 
                </label>
            </div>
            {{-- <div id="chart-impressions-{{$campaign->id}}" class="chart chart-impressions"></div> --}}
            <div id="chart-clicks-{{$campaign->id}}" class="chart chart-clicks"></div>
        @endif
    </div>
</div>
{{-- end impressions and clicks charts --}}
@if (!empty($campaign->clicksData['countries']))
<div class="row clicksByLocation">
    <div class="col-xl-12">
        <p class="title">Clicks by location</p>
    </div>
    <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-toggle-location active clicks-countries" campaignId="{{$campaign->id}}">
              <input type="radio" name="options" id="toggle-update-monthly" checked="">
              <div>countries</div> 
            </label>
            <label class="btn btn-toggle-location clicks-cities" campaignId="{{$campaign->id}}">
              <input type="radio" name="options" id="toggle-update-annually">
              <div>cities</div> 
            </label>
        </div>
        <div id="clicks-countries{{$campaign->id}}">
            <div>
                <p class="title text-right" style="font-size: 15px;">clicks</p>
            </div>
            @foreach ($campaign->clicksData['countries'] as $country)
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
        <div id="clicks-cities{{$campaign->id}}" class="d-none">
            <div>
                <p class="title text-right" style="font-size: 15px;">clicks</p>
            </div>
            @foreach ($campaign->clicksData['cities'] as $key=>$city)
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
    {{-- <div class="col-xl-9 col-md-9 col-sm-6 text-right">
        <div id="clicksmapid{{$campaign->id}}" class="mapid"></div>
    </div> --}}
</div>
@endif
<script>
@if ($campaign->clicksData)
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
                @foreach ($campaign->clicksData['days'] as $day)
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
                @foreach ($campaign->clicksData['days'] as $key=>$day)
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
// configureMapAnalytics(impressionsmapid{{$campaign->id}});
// configureMapAnalytics(clicksmapid{{$campaign->id}});
// configureChartImpressions('#chart-impressions-{{$campaign->id}}');
configureChartClicks('#chart-clicks-{{$campaign->id}}');


$( document ).ready(function() {
    showChartClicks('#campaign-{{$campaign->id}}');
});
@endif
configureDateRangePickerAnalytics({{$campaign->id}}, {{$campaign->dateRangePickerStart}}, {{$campaign->dateRangePickerEnd}}, {{$campaign->starts2()}});

$('.clicks-countries').click(function() {
    var id = $(this).attr('campaignId');
    $('#clicks-cities'+id).addClass('d-none');
    $('#clicks-countries'+id).removeClass('d-none');
});

$('.clicks-cities').click(function() {
  var id = $(this).attr('campaignId');
  $('#clicks-cities'+id).removeClass('d-none');
  $('#clicks-countries'+id).addClass('d-none');
});
</script>