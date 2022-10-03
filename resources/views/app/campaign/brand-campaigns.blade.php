@extends('layouts.brand')
@section('content')
<div class="row mt-1 d-flex justify-content-between pl-1 pr-1 align-items-baseline mt-2 mb-1">
    <div>
        <div class="btn-group btn-group-toggle mb-1" data-toggle="buttons">
            <label class="btn btn-toggle-primary">
              <input type="radio" name="options" id="toggle-campaign-pending">
              <div>Pending</div> 
              <div class="badge-toggle">
                @php
                    $i=0;
                @endphp
                @foreach ($campaigns as $campaign)
                    @if($campaign->status() == 'scheduled')
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
                @php
                    echo $i;
                @endphp
              </div>
            </label>
            <label class="btn btn-toggle-primary">
              <input type="radio" name="options" id="toggle-campaign-active">
              <div>Active</div> 
              <div class="badge-toggle">
                @php
                    $i=0;
                @endphp
                @foreach ($campaigns as $campaign)
                    @if($campaign->status() == 'active')
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
                @php
                    echo $i;
                @endphp
              </div>
            </label>
            <label class="btn btn-toggle-primary">
              <input type="radio" name="options" id="toggle-campaign-waiting">
              <div>Waiting to release funds</div> 
              <div class="badge-toggle">
                @php
                    $i=0;
                @endphp
                @foreach ($campaigns as $campaign)
                    @if($campaign->status() == 'ended' AND $campaign->fundsReleased()==false)
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
                @php
                    echo $i;
                @endphp
              </div>
            </label>
            <label class="btn btn-toggle-primary">
                <input type="radio" name="options" id="toggle-campaign-past">
                Past campaigns
              </label>
          </div>
    </div>
    <div>
        <div class="d-flex btn input-secondary px-1">
            <i class="bx bx-search font-medium-5" style="color: #747E9F;"></i>
            <input type="text" placeholder="Search campaigns" class="input-secondary" style="color: #747E9F; height: auto;">
        </div>
    </div>
</div>

<div id="guide-pending" class="guide-campaign">

    @foreach ($campaigns as $campaign)
    @if($campaign->status() == 'scheduled')
    <x-campaign-card-brand :campaign="$campaign" />
    @endif
    @endforeach
</div>

<div id="guide-active" class="guide-campaign">
    @foreach ($campaigns as $campaign)
    @if($campaign->status() == 'active')
    <x-campaign-card-brand :campaign="$campaign" />
    @endif
    @endforeach

</div>

<div id="guide-waiting" class="guide-campaign">
    @foreach ($campaigns as $campaign)
    @if($campaign->status() == 'ended' AND $campaign->fundsReleased()==false)
    <x-campaign-card-brand :campaign="$campaign" />
    @endif
    @endforeach
</div>

<div id="guide-past" class="guide-campaign past-campaign">
    @foreach ($campaigns as $campaign)
    @if($campaign->status() == 'ended' AND $campaign->fundsReleased()==true)
    <x-campaign-card-brand :campaign="$campaign" />
    @endif
    @endforeach
</div>

<!-- Start Modal Select Influencers -->

<div class="modal fade" id="modal-select-influencers" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modal-content-select-influencers">
            {{-- ajax loaded --}}
        </div>
    </div>
</div>

<!-- End Modal Select Influencers -->

<!-- Start Modal Release Funds -->

<div class="modal fade" id="modal-release-funds" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-funds">
            {{-- ajax loaded --}}
        </div>
    </div>
</div>

<!-- End Modal Release Funds -->

<!-- Start Modal Campaign Details -->

<div class="modal fade" id="modal-campaign-details" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-details">
           {{-- Ajax content --}}
        </div>
    </div>
</div>
@endsection
<!-- End Modal Campaign Details -->

@section('view-js')
 <script>
    function configureDateRangePickerAnalytics(campaignId, campaignStart, campaignEnd, minDate) {
        var start = moment(campaignStart, 'YYYYMMDD');
        var end = moment(campaignEnd, 'YYYYMMDD');
        var minDate = moment(minDate, 'YYYYMMDD');
        var maxDate = moment();

        function cb(start, end, first = false) {
            if (first == true) {
                $('.reportrange'+campaignId+' span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            } else {
                $.ajax({
                    type:'POST',
                    url:'/campaign-analytics',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'campaignId': campaignId, 'start': start.format('YYYYMMDD'), 'end': end.format('YYYYMMDD')},
                    success:function(data){
                        $("#container-analytics"+campaignId).html(data);
                    }
                });
            }
        }

        var dateRangeOptions = {
            startDate: start,
            minDate: minDate,
            endDate: end,
            maxDate: maxDate,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            } 
        };

        $('.reportrange'+campaignId).daterangepicker(dateRangeOptions, cb);
        cb(start, end, true);

    };

    $('#toggle-campaign-pending').click(function() {
        $('.guide-campaign').addClass('d-none');
        $('#guide-pending').removeClass('d-none');
    });

    $('#toggle-campaign-active').click(function() {
        $('.guide-campaign').addClass('d-none');
        $('#guide-active').removeClass('d-none');
    });

    $('#toggle-campaign-waiting').click(function() {
        $('.guide-campaign').addClass('d-none');
        $('#guide-waiting').removeClass('d-none');
    });

    $('#toggle-campaign-past').click(function() {
        $('.guide-campaign').addClass('d-none');
        $('#guide-past').removeClass('d-none'); 
    });

    $('#btn-select-influencers').click(function() {
        id = $(this).attr('campaignId');
        $.ajax({
            type:'GET',
            url:'show-select-influencers/'+id,
            success:function(data){
                $("#modal-content-select-influencers").html(data);
            }
        });
        $('#modal-select-influencers').modal();
    });



    $('.btn-release-funds').click(function() {
        $(this).removeClass('btn-secondary');
        $(this).addClass('btn-primary');
        id = $(this).attr('campaignId');
        $.ajax({
            type:'GET',
            url:'show-release-funds/'+id,
            success:function(data){
                $("#modal-content-funds").html(data);
            }
        });
        $('#modal-release-funds').modal();
    });

    $('.btn-rating-influencer').click(function() {
        $(' + .btn-release-fund', this).attr('disabled', false);
    });

    $('.btn-release-fund').click(function() {
        $(' + .fund-released', this).removeClass('d-none');
        $(' + .fund-released', this).addClass('d-flex');
        $(this).addClass('d-none');
    });

    $('#btn-close-modal-release-funds').click(function() {
        $('.btn-release-funds').removeClass('btn-primary');
        $('.btn-release-funds').addClass('btn-secondary');
    });

    $('.btn-campaign-details').click(function() {
        id = $(this).attr('campaignId');
        $.ajax({
            type:'GET',
            url:'brand-campaign-show/'+id,
            success:function(data){
                $("#modal-content-details").html(data);
            }
        });
        $('#modal-campaign-details').modal();
    });

    configurationStartScreenCampaigns();
    window.scrollTo(0, 0);
 </script>
 @endsection