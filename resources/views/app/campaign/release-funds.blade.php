<div class="modal-header">
    <p class="title mb-0" style="font-size: 20px;">Release funds</p>

    <button type="button" id="btn-close-modal-release-funds" class="close" data-dismiss="modal" aria-label="Close" style="
    width: auto;">
        <span aria-hidden="true" class="title">×</span>
    </button>
  </div>
<div class="modal-body">
    <p style="font-size: 14px">Quae tibi placent quicunq prosunt aut diligebat multum.</p>
    <p class="pt-1" style="font-size: 18px; font-weight: 500;">{{$campaign->name}}</p>

    @foreach ($campaign->influencers as $influencer)
        @php
            $posts = $influencer->influencerCampaignPosts($campaign->id);
        @endphp
    <div class="d-flex justify-content-between align-items-center">

        <div>
            <div class="card-influencer d-flex justify-content-between align-items-center" style="min-width: 200px; background-color: transparent;">
                <div class="pr-1">
                    <img src="{{$influencer->avatarImg()}}" class="img-fluid rounded-circle" width="72" height="72">
                </div>
                <div>
                    <p class="mb-0 red-hat-text card-influencer-alt-title" style="font-size: 15px; font-weight: 500 !important;">{{$influencer->name}}</p>
                    @if ($posts)  
                        @foreach ($posts as $post)
                            <div class="d-flex pr-1">
                            <i class="bx bx-link-alt" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            <a href="{{$post->permalink}}" target="_blank" style="text-decoration: underline;">View post {{$loop->iteration}}</a>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex pr-1">
                            No post yet
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <p class="mb-0">Rate this influencer</p>
            <div class="btn-rating-influencer ratings" influencer_id={{$influencer->id}} influencer_rating={{$influencer->pivot->rating}} style="padding-bottom: 10px; padding-left: 0; padding-right: 0;"></div>
            <button type="button" disabled="true" id="release_button_{{$influencer->id}}" influencer_id={{$influencer->id}} class="btn btn-primary font-weight-normal w-100 btn-release-fund @if($influencer->pivot->paid) d-none @endif" style="font-weight: 500 !important; font-size: 15px;">Release fund</button>
            <div class="fund_released_{{$influencer->id}} @if(!$influencer->pivot->paid) d-none @endif pt-50" style="font-weight: 500;">
                <p>Funds released</p> 
                <i class="bx bx-check" style="color: #747E9F;"></i>
            </div>
        </div>
    </div>
    <hr style="border: 1px solid #747E9F; opacity: 0.2;">
    <div class="d-flex justify-content-between align-items-center" id="retorno-funds">

    </div>
    @endforeach
</div>
<script>
$(".ratings").rateYo({
    rating: 0,
    halfStar: true,
    starWidth: "20px",
    spacing   : "5px",
    normalFill: "#A0A0A0",
    ratedFill: "#033FFF",
    starSvg: '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.78803 1.10298C9.28303 0.0989756 10.714 0.0989756 11.209 1.10298L13.567 5.87998L18.84 6.64598C19.947 6.80698 20.389 8.16798 19.588 8.94898L15.772 12.669L16.673 17.919C16.863 19.022 15.705 19.863 14.714 19.343L9.99803 16.863L5.28303 19.343C4.29303 19.863 3.13503 19.023 3.32303 17.919L4.22403 12.669L0.409031 8.94898C-0.391969 8.16898 0.0500314 6.80698 1.15703 6.64598L6.43003 5.87998L8.78803 1.10298Z" fill=""></path></svg>',
    onInit: function (rating, rateYoInstance) {
        rateYoInstance.id = $(this).attr('influencer_id');
        rateYoInstance.inf_rating = $(this).attr('influencer_rating');
        var $rat = $(this).rateYo();
        $rat.rateYo("rating", $(this).attr('influencer_rating'));
        if($(this).attr('influencer_rating') > 0) {
            $("#release_button_"+rateYoInstance.id).prop('disabled', false);
        }
    },
    onSet: function (rating, rateYoInstance) {
        var userId = rateYoInstance.id
        if (rating > 0) {
            $("#release_button_"+userId).prop('disabled', false);
            if( rating != $(this).attr('influencer_rating')) {
            $(this).attr('influencer_rating', rating);
                $.ajax({
                    type:'POST',
                    url:'/user-rating',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'campaignId': {{$campaign->id}}, 'rating': rating, 'userId': userId},
                    success:function(data){
                    $("#retorno-funds").html(data);
                    console.log('foi');
                    }
                });
            }
        }
    }

});

$('.btn-release-fund').click(function(){
    var influencer_id = $(this).attr('influencer_id');
    $.ajax({
        type:'GET',
        url:'/release-funds/'+influencer_id+'/{{$campaign->id}}',
        success:function(data){
            if(data[0].status == 'success'){
                $('#release_button_'+influencer_id).addClass('d-none');
                $('.fund_released_'+influencer_id).removeClass('d-none');
            }else if(data[0].status == 'error'){
                alert("An error occured while trying to release your funds");
            }
            console.log(data);
        $("#retorno-funds").html(data);
        }
    });
}); 

</script>