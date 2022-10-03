@php
$i=0;
    foreach ($user->notifications as $key => $notification) {
        if($notification->read_at == null) {
            $i++;
        }
    }
@endphp

<li class="dropdown dropdown-notification nav-item"><a id="btn-notifications" class="nav-link nav-link-label"><i id="notification-icon" class="ficon bx bx-bell @if($i) bx-tada @endif bx-flip-horizontal"></i><span id="icon-unread-count" class="badge badge-pill badge-danger badge-up @if($i == 0)d-none @endif">{{$i}}</span></a>
</li>