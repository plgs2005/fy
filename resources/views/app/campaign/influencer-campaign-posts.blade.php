{{-- @extends('layouts.influencer')
@section('content') --}}
<form id='posts-form' method="POST" action="{{ route('store.campaign.posts') }}">
    <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
@if($can_add_insta)
    @if(!is_null($insta_posts))
        <div class="card mt-1">
            <div class="card-body">
                <h5 class="card-title">Instagram Posts</h5>
                <div class="d-flex overflow-auto">
                    @foreach ($insta_posts as $post)
                    <div id="card-insta-post-{{$loop->iteration}}" class="card card-insta-post" style="max-width: 200px; min-width: 200px;" clicked="false" post_id="{{$post->post_id}}" iteration="{{$loop->iteration}}">
                        <input id="{{$post->post_id}}" name="post_id[]" type="hidden">
                        <img class="mb-1" src="{{$post->media_url}}" height="100" width="100">
                        <p class="card-text">{{$post->caption}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div>
        You didn't post anything on instagram since the campaign started or the posts are already attached to another campaign.
    </div>
    @endif
@else
You already added a instagram post to this campaign.
@endif

@if($can_add_fb)
    @if(!is_null($fb_page_posts))
        <div class="card mt-1">
            <div class="card-body ">
                <h5 class="card-title">Facebook Page Posts</h5>
                <div class="d-flex overflow-auto">
                    @foreach ($fb_page_posts as $post)
                    <div id="card-fb-page-post-{{$loop->iteration}}" class="card card-fb-page-post" style="max-width: 200px; min-width: 200px;" clicked="false" post_id="{{$post->post_id}}" iteration="{{$loop->iteration}}">
                        <input id="{{$post->post_id}}" name="post_id[]" type="hidden">
                        <img class="mb-1" src="{{$post->media_url}}" height="100" width="100">
                        <p class="card-text">{{$post->caption}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div>
        You didn't post anything on your facebook page since the campaign started or the posts are already attached to another campaign.
    </div>
    @endif
@else
You already added a facebook post to this campaign.
@endif

@if(!is_null($insta_posts) OR !is_null($fb_page_posts))
<div>
    <button id="add_posts_button" type="submit" class="btn btn-primary d-none">Add Selected Posts</button>
</div>
@endif
</form>

<script>
//funcoes selecionar posts para campanha
$('.card-insta-post').mouseenter(function() {
    if (($(this).attr('clicked')) == 'false') {
        $(this).addClass('card-fb-page-post-selected');
    }
});

$('.card-insta-post').mouseleave(function() {
    if (($(this).attr('clicked')) == 'false') {
        $(this).removeClass('card-fb-page-post-selected');
    }
});

$(".card-insta-post").click(function(){
    var iteration = $(this).attr('iteration');
    $(".card-insta-post").each(function() {
        var iteration2 = $(this).attr('iteration');
        var post_id = $(this).attr('post_id');
        if (iteration == iteration2) {
            console.log(iteration);
            if ($("#card-insta-post-"+iteration).attr('clicked') == 'true') {
            
            } else {
                $('#add_posts_button').removeClass('d-none');
                $("#"+post_id).val(post_id);
                $("#card-insta-post-"+iteration).addClass('card-fb-page-post-selected');
                $("#card-insta-post-"+iteration).attr('clicked', 'true');
            }
        } else {
            $("#"+post_id).val('');
            $("#card-insta-post-"+iteration2).removeClass('card-fb-page-post-selected');
            $("#card-insta-post-"+iteration2).attr('clicked', 'false');
        }
    });
});



$('.card-fb-page-post').mouseenter(function() {
    if (($(this).attr('clicked')) == 'false') {
        $(this).addClass('card-fb-page-post-selected');
    }
});

$('.card-fb-page-post').mouseleave(function() {
    if (($(this).attr('clicked')) == 'false') {
        $(this).removeClass('card-fb-page-post-selected');
    }
});

$(".card-fb-page-post").click(function(){
    var iteration = $(this).attr('iteration');
    $(".card-fb-page-post").each(function() {
        var iteration2 = $(this).attr('iteration');
        var post_id = $(this).attr('post_id');
        if (iteration == iteration2) {
            console.log(iteration);
            if ($("#card-fb-page-post-"+iteration).attr('clicked') == 'true') {
            //    "#card-fb-page-post-"+iteration).removeClass('card-fb-page-post-selected');
            //     $( $("#card-fb-page-post-"+iteration).attr('clicked', 'false');
            } else {
                $('#add_posts_button').removeClass('d-none');
                $("#"+post_id).val(post_id);
                $("#card-fb-page-post-"+iteration).addClass('card-fb-page-post-selected');
                $("#card-fb-page-post-"+iteration).attr('clicked', 'true');
            }
        } else {
            $("#"+post_id).val('');
            $("#card-fb-page-post-"+iteration2).removeClass('card-fb-page-post-selected');
            $("#card-fb-page-post-"+iteration2).attr('clicked', 'false');
        }
    });
});

$("#posts-form").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           data: form.serialize(),
           
           success: function(data)
           {
                if(data.status == 'success'){
                    toastr.success(data.message, "Success");
                    $('#modal-select-post').modal('hide');
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
});
//fim funcoes selecionar posts para campanha
</script>

{{-- @endsection --}}