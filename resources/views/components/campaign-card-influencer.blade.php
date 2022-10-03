<div class="col mb-4">
    <div class="card h-100">
        <div class="card-body">
        <h5 class="card-title"><a href="
            @role('Influencer')
                {{route('campaign.detail.influencer', ['id' => $campaign->id])}}
            @endrole
            @role('Brand')
                {{route('campaign.detail.brand', ['id' => $campaign->id])}}
            @endrole
            "
            class="card-link stretched-link">{{$campaign->name}}</a></h5>
            <div class="row">
                <div class="col-md-2">
                    img
                </div>
                <div class="col-md-2">
                    Created in: {{$campaign->created_at}}<br>
                    Starts:<br>
                    End:<br>
                </div>
                <div class="col-md-2">
                    {{$campaign->impressions}} impressions
                </div>
                <div class="col-md-2">
                    clicks
                </div>
                <div class="col-md-2">
                    engagement {{$campaign->engagement}}
                </div>
            </div>
        </div>
    </div>
</div>