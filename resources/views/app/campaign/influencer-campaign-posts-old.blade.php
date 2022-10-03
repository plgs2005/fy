<div class="card text-center" style="height: 92%;">
    <div class="card-body d-flex flex-column justify-content-center">
        <div id="div-job-links" class="mb-auto">
            @if ($posts->count())
            <p>Campaign posts</p>
            @endif
            @foreach ($posts as $post)
            <div class="d-flex justify-content-between mb-1">
                <div class="w-100 mr-50">
                    <a href="{{$post->permalink}}" target="_blank" class="input-add-link links-jobs">{{$post->permalink}}</a>
                </div>
                @if ($campaign->status() == 'active')
                <div class="div-btn-remove-link-job" post_id="{{$post->id}}">
                    <button type="button" id="" class="btn position-relative m-auto d-flex justify-content-center align-items-center" style="height: 41px; width: 50px; white-space: nowrap; background-color:  transparent; color: #EB5757">
                        <span class="mb-0" style="font-size: 30px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.00293 20C5.00293 21.103 5.89993 22 7.00293 22H17.0029C18.1059 22 19.0029 21.103 19.0029 20V8H21.0029V6H17.0029V4C17.0029 2.897 16.1059 2 15.0029 2H9.00293C7.89993 2 7.00293 2.897 7.00293 4V6H3.00293V8H5.00293V20ZM9.00293 4H15.0029V6H9.00293V4ZM8.00293 8H17.0029L17.0039 20H7.00293V8H8.00293Z" fill="#EB5757"/>
                                <path d="M9.00293 10H11.0029V18H9.00293V10ZM13.0029 10H15.0029V18H13.0029V10Z" fill="#EB5757"/>
                            </svg>
                        </span>
                    </button>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if (!$posts->count())
        <div id="div-no-link-job">
            <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg" class="my-0 mb-50 no-jobs">
                <path d="M16.5773 22.1156C18.7961 19.8968 22.6658 19.8968 24.8845 22.1156L26.2691 23.5001L29.0382 20.731L27.6536 19.3465C25.8069 17.4978 23.3473 16.4775 20.7309 16.4775C18.1146 16.4775 15.6549 17.4978 13.8082 19.3465L9.65263 23.5001C7.82021 25.3384 6.79126 27.8282 6.79126 30.4238C6.79126 33.0194 7.82021 35.5092 9.65263 37.3475C10.5611 38.2572 11.6403 38.9785 12.8283 39.4698C14.0163 39.9611 15.2897 40.2129 16.5753 40.2106C17.8613 40.2133 19.1351 39.9617 20.3235 39.4703C21.5119 38.979 22.5914 38.2575 23.5 37.3475L24.8845 35.963L22.1155 33.1939L20.7309 34.5784C19.6273 35.6771 18.1335 36.2939 16.5763 36.2939C15.0191 36.2939 13.5253 35.6771 12.4217 34.5784C11.3221 33.4753 10.7047 31.9813 10.7047 30.4238C10.7047 28.8663 11.3221 27.3723 12.4217 26.2692L16.5773 22.1156Z" fill="#747E9F"/>
                <path d="M23.5 9.65254L22.1154 11.0371L24.8845 13.8062L26.269 12.4216C27.3726 11.323 28.8664 10.7062 30.4236 10.7062C31.9809 10.7062 33.4747 11.323 34.5782 12.4216C35.6778 13.5247 36.2953 15.0187 36.2953 16.5762C36.2953 18.1338 35.6778 19.6278 34.5782 20.7308L30.4227 24.8845C28.2039 27.1032 24.3342 27.1032 22.1154 24.8845L20.7309 23.4999L17.9618 26.269L19.3463 27.6535C21.193 29.5022 23.6527 30.5225 26.269 30.5225C28.8854 30.5225 31.345 29.5022 33.1917 27.6535L37.3473 23.4999C39.1798 21.6616 40.2087 19.1718 40.2087 16.5762C40.2087 13.9806 39.1798 11.4909 37.3473 9.65254C35.5095 7.81916 33.0196 6.78955 30.4236 6.78955C27.8277 6.78955 25.3378 7.81916 23.5 9.65254Z" fill="#747E9F"/>
            </svg>
            <p class="mb-50 no-link-job">You don't have job URLs</p>
        </div>
        @endif

        <form id="job_links_form" method="POST" action="{{ route('store.campaign.posts') }}">
            @csrf
            <input type="hidden" name="campaignId" value="{{$campaign->id}}">
            <div id="div-add-link-job" class="mb-auto d-none">
                <div id="model-add-link-job">
                    <div class="d-flex justify-content-between mb-1">
                        
                        <div class="w-100 mr-50">
                            <input type="text" class="input-add-link form-control" name="post_url[]" placeholder="Add link" required="required" style="width: 100%; height: 41px;">
                        </div>
                        
                        <div class="div-btn-add-link-job mr-50">
                            <button type="button" class="btn-add-link-job btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" style="height: 41px; width: 50px; white-space: nowrap;" onclick="addLinkJob()">
                                <span class="mb-0" style="margin-top: 1px; font-size: 30px;">+</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div id="div-save-cancel-link-job" class="mt-auto d-none">
            <div class="d-flex justify-content-between">
                <div class="w-50 mr-50">
                    <button id="btn-save-links-jobs" type="button" id="" class="btn btn-primary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 100%; height: 40px; white-space: nowrap;">
                        <span style="margin-top: 2px; font-size: 13px;">Save links</span>
                    </button>
                </div>
                <div class="w-50">
                    <button type="button" id="btn-cancel-add-links-jobs" class="btn btn-secondary position-relative m-auto d-flex justify-content-center align-items-center" data-toggle="modal" style="width: 100%; height: 40px; white-space: nowrap;">
                        <span style="margin-top: 2px; font-size: 13px;">Cancel</span>
                    </button>
                </div>
            </div>
        </div>

        @if ($campaign->status() == 'active')
        <div id="div-btn-add-links-jobs">
            <button id="btn-add-links-jobs" class="btn btn-secondary position-relative mx-auto d-flex justify-content-center align-items-center mt-1" style="width: 100%; height: 40px; white-space: nowrap;">
                <span style="margin-top: 2px;">Add your posts URLs</span>
            </button>
        </div>
        @endif

    </div>
</div>


<script>
$('#btn-add-links-jobs').click(function() {
    $('#div-no-link-job').addClass('d-none');
    $('#div-add-link-job').removeClass('d-none');
    $('#div-save-cancel-link-job').removeClass('d-none');
    $('#div-btn-add-links-jobs').addClass('d-none');
    $('.input-add-link').removeClass('links-jobs');
    $('.div-btn-add-link-job').removeClass('d-none');
    $("#div-job-links").addClass('d-none')
});

$('#btn-cancel-add-links-jobs').click(function() {
    $('#div-no-link-job').removeClass('d-none');
    $('#div-add-link-job').addClass('d-none');
    $('#div-save-cancel-link-job').addClass('d-none');
    $('#div-btn-add-links-jobs').removeClass('d-none');
    $('.input-add-link').removeClass('links-jobs');
    $('.div-btn-add-link-job').removeClass('d-none');
    $("#div-job-links").removeClass('d-none')
});

$('#btn-save-links-jobs').click(function() {
    var form = $("#job_links_form");
    var url = form.attr('action');
    $.ajax({
        type: 'POST',
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: form.serialize(),
        success:function(data){
            if(data.status == 'success'){
                toastr.success(data.message, "Success");
                $("#job-links").load('/influencer-campaign-posts/{{$campaign->id}}');
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

$(".div-btn-remove-link-job").click(function() {
post_id = $(this).attr('post_id');
console.log(post_id);
$.ajax({
        type: 'POST',
        url: '/detach-post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'post_id': post_id},
        success:function(data){
            if(data.status == 'success'){
                toastr.success(data.message, "Success");
                $("#job-links").load('/influencer-campaign-posts/{{$campaign->id}}');
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
</script>