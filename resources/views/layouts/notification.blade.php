<!-- Start Modal Notifications -->
@php
$notifications = $user->notifications;
$unread=0;
@endphp
<div class="modal fade" id="modal-notifications" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <p class="title mb-0" style="font-size: 20px;">Notifications</p>
                </div>
                <button type="button" id="btn-close-modal-notifications" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;">
                    <span aria-hidden="true" class="title">×</span>
                </button>
            </div>
            <div id="notifications-modal-body" class="modal-body">
                @if($notifications->count())
                @foreach ($notifications as $notification)
                    @php
                        if($notification->read_at == null) {
                            $unread++;
                        }
                    @endphp
                    <div class="card card-body @if($notification->read_at == null) not-read @endif d-flex justify-content-between align-items-center notification-card">
                        @if(isset($notification->data['image_path']))
                            <div class="pr-1">
                                <img class="rounded-circle" height="48" width="48" src="{{Storage::url($notification->data['image_path'])}}">
                            </div>
                        @else 
                        <div class="pr-1">
                            <i class="bx bx-paper-plane" style="font-size: 48px"></i>
                        </div>
                        @endif
                        <div>
                            <p class="mb-0">@php echo $notification->data['message'] @endphp </p>
                        </div>
                    </div>
                    <div id="zero-notification" class="card card-body not-read d-none">
                        You don't have any notification.
                    </div>
                @endforeach
                @else
                <div id="zero-notification" class="card card-body not-read">
                    You don't have any notification.
                </div>
                @endif
                <div id="unread-count" count="{{$unread}}"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Notifications -->