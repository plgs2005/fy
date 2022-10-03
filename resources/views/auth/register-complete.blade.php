@extends('layouts.register')
@section('content')
<div class="mb-0 h-100 background-main">
    <div id="div-5" class="background-great-influencers w-100 h-100 text-center" style="color: #FFFFFF;">
        <div>
            <div id="container-logo-influencer-great">
                <img src="../assets/images/logo-influencer-white.png" class="img-fluid">
            </div>
            <div id="container-content-influencer-great">
                <div>
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-1">
                        <path d="M24.1043 5.772C24.7343 4.209 26.4893 2.532 28.7423 3.156C30.5123 3.648 31.6613 4.719 32.3213 6.147C32.9333 7.476 33.0833 9.039 33.1133 10.533C33.1433 12.135 32.8073 14.061 32.4143 15.744C32.2389 16.489 32.0438 17.2293 31.8293 17.964H35.9843C36.9169 17.9639 37.8367 18.1812 38.6706 18.5987C39.5045 19.0161 40.2297 19.6222 40.7885 20.3688C41.3473 21.1154 41.7243 21.982 41.8897 22.8998C42.0551 23.8176 42.0043 24.7613 41.7413 25.656L37.6493 39.594C37.3683 40.5502 36.8995 41.4408 36.2703 42.2137C35.6411 42.9866 34.8642 43.6264 33.9849 44.0957C33.1056 44.5649 32.1417 44.8542 31.1493 44.9466C30.157 45.0391 29.1561 44.9328 28.2053 44.634L12.1373 39.588C11.2684 39.3153 10.4729 38.8483 9.81124 38.2225C9.14956 37.5967 8.63902 36.8284 8.31834 35.976L6.75834 31.824C6.26188 30.5026 6.2472 29.0485 6.71689 27.7173C7.18657 26.3862 8.11055 25.2632 9.32634 24.546L14.9423 21.231C15.5083 20.7834 16.0333 20.2865 16.5113 19.746C17.5433 18.582 18.9623 16.641 20.3873 13.614C21.0023 12.306 21.5183 11.274 21.9863 10.344C22.7453 8.832 23.3813 7.572 24.1043 5.772ZM16.5563 23.76C16.5395 23.7703 16.5225 23.7803 16.5053 23.79L10.8503 27.132C10.2424 27.4906 9.78046 28.0521 9.54561 28.7177C9.31077 29.3832 9.31811 30.1103 9.56634 30.771L11.1263 34.923C11.2868 35.3494 11.5423 35.7336 11.8734 36.0465C12.2046 36.3594 12.6026 36.5928 13.0373 36.729L29.0993 41.775C29.6702 41.9548 30.2713 42.0188 30.8673 41.9634C31.4632 41.9081 32.0422 41.7343 32.5702 41.4525C33.0982 41.1706 33.5646 40.7862 33.9423 40.3218C34.3199 39.8574 34.6011 39.3224 34.7693 38.748L38.8583 24.81C38.9899 24.3625 39.0153 23.8905 38.9325 23.4315C38.8497 22.9725 38.661 22.5391 38.3815 22.1658C38.1019 21.7925 37.7391 21.4894 37.322 21.2808C36.9048 21.0722 36.4448 20.9637 35.9783 20.964H29.7803C29.5404 20.9639 29.3039 20.9061 29.0908 20.7957C28.8778 20.6852 28.6943 20.5253 28.5559 20.3292C28.4175 20.1332 28.3281 19.9068 28.2953 19.6691C28.2625 19.4313 28.2872 19.1892 28.3673 18.963C28.6673 18.117 29.1233 16.653 29.4953 15.06C29.8733 13.446 30.1403 11.814 30.1163 10.59C30.0863 9.183 29.9393 8.142 29.5973 7.401C29.3033 6.759 28.8443 6.297 27.9413 6.048C27.8123 6.012 27.6593 6.021 27.4613 6.15C27.2029 6.33456 27.0046 6.59127 26.8913 6.888C26.2004 8.57328 25.4346 10.2269 24.5963 11.844C24.1313 12.768 23.6423 13.746 23.1053 14.889C21.5633 18.168 19.9853 20.352 18.7553 21.735C18.1433 22.425 17.6213 22.917 17.2373 23.244C17.0423 23.4098 16.8401 23.5669 16.6313 23.715L16.5833 23.745L16.5683 23.757L16.5593 23.76H16.5563Z" fill="white"/>
                    </svg>
                </div>
                
                <h3 style="color: #FFFFFF;">Great!</h3>
                
                <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>
                <p class="p-500" style="color: #FFFFFF;">Redirecting you to your dashboard in 5 seconds...</p>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        window.location = '/home'
    }, 5000)
</script>
@endsection