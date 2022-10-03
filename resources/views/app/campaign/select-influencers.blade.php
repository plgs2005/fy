<div class="modal-body">
    <div>
        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close" style="margin-top: -48px; background-color: transparent!important;">
            <span aria-hidden="true" class="title" style="color: #FFFFFF;font-size: 32px;font-weight: normal;">×</span>
        </button>
    </div>
    <div class="d-flex">
        <div id="modal-select-influencer-left">
            <p class="title" style="font-size: 25px;">Select suggested influencers for your campaign</p>
            
            <div class="d-flex flex-wrap overflow-auto" style="max-height: 550px;">
                @php
                    $selected_influencers_quant = $campaign->influencers()->where('brand_accept',1)->get()->count();
                @endphp
                @foreach ($campaign->influencers as $influencer)
                    <div>
                        <div id="card-influencer-{{$influencer->id}}" class="card-influencer-alt d-flex justify-content-between align-items-center m-1 p-2 @if($influencer->pivot->brand_accept) selected @endif" influencer_id="{{$influencer->id}}">
                            <div class="pr-1">
                            <img src="@if($influencer->igAvatar()) {{$influencer->igAvatar()}} @else {{URL::asset('/assets/images/picture-profile.png')}} @endif" class="img-fluid img-influencer rounded-circle">
                            <img src="../assets/images/icon-check.png" class="img-fluid img-influencer-selected">
                            </div>
                            <div class="card-influencer-alt-content">
                                <p class="mb-0 red-hat-text primary card-influencer-alt-title" style="font-size: 15px; font-weight: 500 !important;">{{$influencer->name}}</p>
                                @foreach ($influencer->social_medias as $social_media)
                                    @if ($social_media->social_media == 'instagram_business')
                                        <div class="d-flex">
                                            <i class="bx bxl-instagram" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                                            <p class="mb-0">{{thousandsFormat($social_media->followers)}} followers</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="btn-remove-influencer-selected">
                                <i class="bx bx-trash" onclick="removeInfluencerSelected({{$influencer->id}})" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="modal-select-influencer-right" class="d-flex flex-column" style="min-width: 300px">
            <div>
                <p class="title" style="font-size: 20px;">Selected influencers</p>
            </div>
            @if(!$selected_influencers_quant)
            <div id="div-no-influencers-selected" class="text-center mt-auto">
                <img src="../assets/images/icon-people-community.png" class="img-fluid mb-1">
                <p style="font-size: 18px;">The influencers to be selected will appear here.</p>
                <p style="font-size: 18px;">Min. influencers: 02</p>
            </div>
            @endif
            <div id="div-influencers-selected" class="@if(!$selected_influencers_quant) d-none @endif">
                @foreach ($campaign->influencers as $influencer)
                <input type="hidden" class="influencer_id" id="influencer_id_{{$influencer->id}}" value="@if($influencer->pivot->brand_accept) {{$influencer->id}} @endif">
                    @if($influencer->pivot->brand_accept)
                    <div id="card-influencer-{{$influencer->id}}" class="card-influencer-alt d-flex justify-content-between align-items-center m-1 p-2" influencer_id="{{$influencer->id}}">
                        <div class="pr-1">
                        <img src="@if($influencer->igAvatar()) {{$influencer->igAvatar()}} @else {{URL::asset('/assets/images/picture-profile.png')}} @endif" class="img-fluid img-influencer rounded-circle">
                        <img src="../assets/images/icon-check.png" class="img-fluid img-influencer-selected">
                        </div>
                        <div class="card-influencer-alt-content">
                            <p class="mb-0 red-hat-text primary card-influencer-alt-title" style="font-size: 15px; font-weight: 500 !important;">{{$influencer->name}}</p>
                            @foreach ($influencer->social_medias as $social_media)
                                @if ($social_media->social_media == 'instagram_business')
                                    <div class="d-flex">
                                        <i class="bx bxl-instagram" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                                        <p class="mb-0">{{thousandsFormat($social_media->followers)}} followers</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="btn-remove-influencer-selected">
                            <i class="bx bx-trash" onclick="removeInfluencerSelected({{$influencer->id}})" style="margin-right: 4px; margin-left: -2px; margin-top: 1px; color: #033FFF;"></i>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-auto">
                <button type="button" id="btn-finish-select-influencers" @if($selected_influencers_quant < 2) disabled="true" @endif class="btn btn-primary font-weight-normal red-hat-display w-100" style="font-weight: 500 !important; font-size: 15px; color: #FFFFFF !important;">Finish</button>
            </div>
        </div>

    </div>

</div>

<script>
$('#modal-select-influencer-left .card-influencer-alt').click(function() {
    if (!($(this).hasClass('selected'))) {
        console.log($(this).attr('influencer_id'));
        var id = $(this).attr('influencer_id');
        var aux = $(this).clone();
        $('#div-influencers-selected').append(aux); 

        $(this).addClass('selected'); 

        var counterInfluencerLeft = $('.card-influencer-alt.selected').length;

        if (counterInfluencerLeft >= 2 ) {
            $('#btn-finish-select-influencers').attr('disabled', false);
        } else {
            $('#btn-finish-select-influencers').attr('disabled', true);
        }

        $('#div-influencers-selected').removeClass('d-none');
        $('#div-no-influencers-selected').addClass('d-none');
        $('#influencer_id_'+id).val(id);
    }
});

$('#btn-finish-select-influencers').click(function() {
    var counterInfluencerLeft = $('.card-influencer-alt.selected').length;
    $('#modal-select-influencers').modal('toggle');
    $('#btn-select-influencers').addClass('btn-select-influencers-clicked');
    $('#btn-select-influencers')[0].innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="#747E9F" style="margin-right: 6px;" xmlns="http://www.w3.org/2000/svg"><path d="M14.75 15C15.716 15 16.5 15.784 16.5 16.75L16.499 17.712C16.616 19.902 14.988 21.009 12.067 21.009C9.157 21.009 7.5 19.919 7.5 17.75V16.75C7.5 15.784 8.284 15 9.25 15H14.75ZM14.75 16.5H9.25C9.18369 16.5 9.12011 16.5263 9.07322 16.5732C9.02634 16.6201 9 16.6837 9 16.75V17.75C9 18.926 9.887 19.509 12.067 19.509C14.235 19.509 15.062 18.945 15 17.752V16.75C15 16.6837 14.9737 16.6201 14.9268 16.5732C14.8799 16.5263 14.8163 16.5 14.75 16.5ZM3.75 10H8.126C8 10.4895 7.96777 10.9985 8.031 11.5H3.75C3.6837 11.5 3.62011 11.5263 3.57322 11.5732C3.52634 11.6201 3.5 11.6837 3.5 11.75V12.75C3.5 13.926 4.387 14.509 6.567 14.509C7.029 14.509 7.43 14.483 7.774 14.432C7.20183 14.7945 6.78401 15.3559 6.601 16.008L6.567 16.009C3.657 16.009 2 14.919 2 12.75V11.75C2 10.784 2.784 10 3.75 10ZM20.25 10C21.216 10 22 10.784 22 11.75L21.999 12.712C22.116 14.902 20.488 16.009 17.567 16.009L17.398 16.007C17.2094 15.337 16.7743 14.7633 16.18 14.401C16.567 14.473 17.027 14.509 17.567 14.509C19.735 14.509 20.562 13.945 20.5 12.752V11.75C20.5 11.6837 20.4737 11.6201 20.4268 11.5732C20.3799 11.5263 20.3163 11.5 20.25 11.5H15.97C16.0319 10.9984 15.9993 10.4896 15.874 10H20.25ZM12 8C12.394 8 12.7841 8.0776 13.148 8.22836C13.512 8.37912 13.8427 8.6001 14.1213 8.87868C14.3999 9.15725 14.6209 9.48797 14.7716 9.85195C14.9224 10.2159 15 10.606 15 11C15 11.394 14.9224 11.7841 14.7716 12.148C14.6209 12.512 14.3999 12.8427 14.1213 13.1213C13.8427 13.3999 13.512 13.6209 13.148 13.7716C12.7841 13.9224 12.394 14 12 14C11.2043 14 10.4413 13.6839 9.87868 13.1213C9.31607 12.5587 9 11.7956 9 11C9 10.2043 9.31607 9.44129 9.87868 8.87868C10.4413 8.31607 11.2043 8 12 8ZM12 9.5C11.803 9.5 11.608 9.5388 11.426 9.61418C11.244 9.68956 11.0786 9.80005 10.9393 9.93934C10.8 10.0786 10.6896 10.244 10.6142 10.426C10.5388 10.608 10.5 10.803 10.5 11C10.5 11.197 10.5388 11.392 10.6142 11.574C10.6896 11.756 10.8 11.9214 10.9393 12.0607C11.0786 12.1999 11.244 12.3104 11.426 12.3858C11.608 12.4612 11.803 12.5 12 12.5C12.3978 12.5 12.7794 12.342 13.0607 12.0607C13.342 11.7794 13.5 11.3978 13.5 11C13.5 10.6022 13.342 10.2206 13.0607 9.93934C12.7794 9.65803 12.3978 9.5 12 9.5ZM6.5 3C7.29565 3 8.05871 3.31607 8.62132 3.87868C9.18393 4.44129 9.5 5.20435 9.5 6C9.5 6.79565 9.18393 7.55871 8.62132 8.12132C8.05871 8.68393 7.29565 9 6.5 9C5.70435 9 4.94129 8.68393 4.37868 8.12132C3.81607 7.55871 3.5 6.79565 3.5 6C3.5 5.20435 3.81607 4.44129 4.37868 3.87868C4.94129 3.31607 5.70435 3 6.5 3ZM17.5 3C18.2956 3 19.0587 3.31607 19.6213 3.87868C20.1839 4.44129 20.5 5.20435 20.5 6C20.5 6.79565 20.1839 7.55871 19.6213 8.12132C19.0587 8.68393 18.2956 9 17.5 9C16.7043 9 15.9413 8.68393 15.3787 8.12132C14.8161 7.55871 14.5 6.79565 14.5 6C14.5 5.20435 14.8161 4.44129 15.3787 3.87868C15.9413 3.31607 16.7043 3 17.5 3ZM6.5 4.5C6.10217 4.5 5.72064 4.65803 5.43934 4.93934C5.15803 5.22064 5 5.60217 5 6C5 6.39782 5.15803 6.77936 5.43934 7.06066C5.72064 7.34196 6.10217 7.5 6.5 7.5C6.89782 7.5 7.27936 7.34196 7.56066 7.06066C7.84196 6.77936 8 6.39782 8 6C8 5.60217 7.84196 5.22064 7.56066 4.93934C7.27936 4.65803 6.89782 4.5 6.5 4.5ZM17.5 4.5C17.1022 4.5 16.7206 4.65803 16.4393 4.93934C16.158 5.22064 16 5.60217 16 6C16 6.39782 16.158 6.77936 16.4393 7.06066C16.7206 7.34196 17.1022 7.5 17.5 7.5C17.8978 7.5 18.2794 7.34196 18.5607 7.06066C18.842 6.77936 19 6.39782 19 6C19 5.60217 18.842 5.22064 18.5607 4.93934C18.2794 4.65803 17.8978 4.5 17.5 4.5Z"/></svg>';
    $('#btn-select-influencers')[0].innerHTML += counterInfluencerLeft + ' selected influencers';
    var inputValues = $('.influencer_id').map(function() {
        return $(this).val();
    }).toArray();
    console.log(inputValues);
    $.ajax({
        type:'POST',
        url:'/select-influencers',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'ids': inputValues, 'campaignId': {{$campaign->id}} },
        success:function(data){
            $("#ajax_response").html(data);
        }
    });
});

function removeInfluencerSelected(id) {
  var card = '#card-influencer-'+id;
  console.log(id);
  console.log(card);
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
  $('#influencer_id_'+id).val('');
}
</script>