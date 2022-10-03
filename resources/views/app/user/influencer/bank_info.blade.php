<div id="container-bank-info">

  @if (!isset($accounts))
    @if (isset($onboardLink))
      <div id="container-payments" class="d-flex align-items-center mt-2">
        <a class="btn btn-primary" href="{{$onboardLink}}">
          {{ __('Onboard Account') }}
        </a>
      </div>
    @elseif (isset($loginLink))
      <div id="container-payments" class="d-flex align-items-center mt-2">
        Please fill in missing information in order to enable payments in you stripe account.
      </div>
      <div id="container-payments" class="d-flex align-items-center mt-2">
        <a class="btn btn-primary" href="{{ $loginLink }}">
          {{ __('Complete details') }}
        </a>
      </div>
    @else
      <div id="container-payments" class="d-flex align-items-center mt-2">
        <a class="btn btn-primary" href="{{ route('stripe.create') }}">
          {{ __('Create Stripe Account') }}
        </a>
      </div>
    @endif


    <div id="div-no-bank-info" class="text-center">
        <div class="d-none d-sm-block">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-50">
                <path d="M27 3H35.55C37.455 3 39 4.545 39 6.45V15C39 16.035 38.868 17.04 38.622 18H41.274C43.332 18 45 19.668 45 21.726V31.5C45.0002 34.0424 44.2825 36.5331 42.9296 38.6855C41.5766 40.838 39.6433 42.5646 37.3523 43.6667C35.0612 44.7688 32.5055 45.2016 29.9793 44.9153C27.4532 44.6289 25.0592 43.635 23.073 42.048L20.562 44.562C20.2803 44.8433 19.8985 45.0011 19.5004 45.0008C19.1024 45.0006 18.7208 44.8422 18.4395 44.5605C18.1582 44.2788 18.0004 43.897 18.0007 43.4989C18.0009 43.1009 18.1593 42.7193 18.441 42.438L20.952 39.927C19.8888 38.5996 19.0867 37.0829 18.588 35.457C16.7906 36.0202 14.8859 36.1524 13.0279 35.8428C11.17 35.5333 9.41095 34.7907 7.89323 33.6752C6.37551 32.5597 5.1417 31.1026 4.29162 29.4217C3.44154 27.7409 2.99907 25.8836 3 24V15.444C3 13.545 4.545 12 6.45 12H15C15.126 12 15.252 12 15.378 12.006C16.043 9.42902 17.5454 7.14604 19.6491 5.51586C21.7529 3.88568 24.3386 3.0007 27 3ZM32.562 32.562L25.212 39.912C26.7728 41.0791 28.6277 41.7888 30.569 41.9617C32.5103 42.1345 34.4613 41.7636 36.2038 40.8905C37.9463 40.0174 39.4113 38.6765 40.435 37.0181C41.4587 35.3596 42.0006 33.449 42 31.5V21.723C41.9992 21.531 41.9224 21.3471 41.7863 21.2116C41.6502 21.0761 41.466 21 41.274 21H31.5C29.5513 21 27.641 21.5423 25.983 22.5662C24.325 23.5901 22.9846 25.0552 22.1119 26.7975C21.2391 28.5399 20.8685 30.4907 21.0414 32.4318C21.2143 34.3728 21.924 36.2274 23.091 37.788L30.441 30.438C30.7227 30.1567 31.1045 29.9989 31.5026 29.9992C31.9006 29.9994 32.2822 30.1578 32.5635 30.4395C32.8448 30.7212 33.0026 31.103 33.0023 31.5011C33.0021 31.8991 32.8437 32.2807 32.562 32.562ZM35.487 18C35.817 17.061 36 16.05 36 15V6.45C36 6.33065 35.9526 6.21619 35.8682 6.1318C35.7838 6.04741 35.6693 6 35.55 6H27C25.0532 6.0003 23.1589 6.63165 21.6012 7.7994C20.0435 8.96715 18.9062 10.6084 18.36 12.477C20.0425 12.9694 21.597 13.8235 22.9148 14.9796C24.2326 16.1357 25.2818 17.5659 25.989 19.17C27.7228 18.3954 29.601 17.9966 31.5 18H35.49H35.487ZM23.382 20.712C22.7206 19.0279 21.5671 17.5821 20.072 16.5632C18.5768 15.5443 16.8093 14.9996 15 15H6.45C6.33065 15 6.21619 15.0474 6.1318 15.1318C6.04741 15.2162 6 15.3307 6 15.45V24C5.9996 25.4433 6.3463 26.8655 7.01086 28.1466C7.67542 29.4278 8.63835 30.5304 9.81843 31.3613C10.9985 32.1922 12.3611 32.7272 13.7913 32.921C15.2215 33.1148 16.6773 32.9619 18.036 32.475C17.9599 31.4151 18.0072 30.35 18.177 29.301L12.438 23.562C12.2985 23.4225 12.1879 23.257 12.1124 23.0748C12.037 22.8925 11.9981 22.6972 11.9981 22.5C11.9981 22.3028 12.037 22.1075 12.1124 21.9252C12.1879 21.743 12.2985 21.5775 12.438 21.438C12.5775 21.2985 12.743 21.1879 12.9253 21.1124C13.1075 21.037 13.3028 20.9981 13.5 20.9981C13.6972 20.9981 13.8925 21.037 14.0748 21.1124C14.257 21.1879 14.4225 21.2985 14.562 21.438L19.152 26.031C20.091 23.919 21.555 22.089 23.382 20.712Z" fill="#747E9F"/>
                </svg>        
            <p>No account registered</p>
            {{-- <button type="submit" id="btn-bank-info-add-1" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 250px; height: 40px; white-space: nowrap;">Add bank account</button> --}}
        </div>

        <div class="d-block d-sm-none">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-50">
                <path d="M27 3H35.55C37.455 3 39 4.545 39 6.45V15C39 16.035 38.868 17.04 38.622 18H41.274C43.332 18 45 19.668 45 21.726V31.5C45.0002 34.0424 44.2825 36.5331 42.9296 38.6855C41.5766 40.838 39.6433 42.5646 37.3523 43.6667C35.0612 44.7688 32.5055 45.2016 29.9793 44.9153C27.4532 44.6289 25.0592 43.635 23.073 42.048L20.562 44.562C20.2803 44.8433 19.8985 45.0011 19.5004 45.0008C19.1024 45.0006 18.7208 44.8422 18.4395 44.5605C18.1582 44.2788 18.0004 43.897 18.0007 43.4989C18.0009 43.1009 18.1593 42.7193 18.441 42.438L20.952 39.927C19.8888 38.5996 19.0867 37.0829 18.588 35.457C16.7906 36.0202 14.8859 36.1524 13.0279 35.8428C11.17 35.5333 9.41095 34.7907 7.89323 33.6752C6.37551 32.5597 5.1417 31.1026 4.29162 29.4217C3.44154 27.7409 2.99907 25.8836 3 24V15.444C3 13.545 4.545 12 6.45 12H15C15.126 12 15.252 12 15.378 12.006C16.043 9.42902 17.5454 7.14604 19.6491 5.51586C21.7529 3.88568 24.3386 3.0007 27 3ZM32.562 32.562L25.212 39.912C26.7728 41.0791 28.6277 41.7888 30.569 41.9617C32.5103 42.1345 34.4613 41.7636 36.2038 40.8905C37.9463 40.0174 39.4113 38.6765 40.435 37.0181C41.4587 35.3596 42.0006 33.449 42 31.5V21.723C41.9992 21.531 41.9224 21.3471 41.7863 21.2116C41.6502 21.0761 41.466 21 41.274 21H31.5C29.5513 21 27.641 21.5423 25.983 22.5662C24.325 23.5901 22.9846 25.0552 22.1119 26.7975C21.2391 28.5399 20.8685 30.4907 21.0414 32.4318C21.2143 34.3728 21.924 36.2274 23.091 37.788L30.441 30.438C30.7227 30.1567 31.1045 29.9989 31.5026 29.9992C31.9006 29.9994 32.2822 30.1578 32.5635 30.4395C32.8448 30.7212 33.0026 31.103 33.0023 31.5011C33.0021 31.8991 32.8437 32.2807 32.562 32.562ZM35.487 18C35.817 17.061 36 16.05 36 15V6.45C36 6.33065 35.9526 6.21619 35.8682 6.1318C35.7838 6.04741 35.6693 6 35.55 6H27C25.0532 6.0003 23.1589 6.63165 21.6012 7.7994C20.0435 8.96715 18.9062 10.6084 18.36 12.477C20.0425 12.9694 21.597 13.8235 22.9148 14.9796C24.2326 16.1357 25.2818 17.5659 25.989 19.17C27.7228 18.3954 29.601 17.9966 31.5 18H35.49H35.487ZM23.382 20.712C22.7206 19.0279 21.5671 17.5821 20.072 16.5632C18.5768 15.5443 16.8093 14.9996 15 15H6.45C6.33065 15 6.21619 15.0474 6.1318 15.1318C6.04741 15.2162 6 15.3307 6 15.45V24C5.9996 25.4433 6.3463 26.8655 7.01086 28.1466C7.67542 29.4278 8.63835 30.5304 9.81843 31.3613C10.9985 32.1922 12.3611 32.7272 13.7913 32.921C15.2215 33.1148 16.6773 32.9619 18.036 32.475C17.9599 31.4151 18.0072 30.35 18.177 29.301L12.438 23.562C12.2985 23.4225 12.1879 23.257 12.1124 23.0748C12.037 22.8925 11.9981 22.6972 11.9981 22.5C11.9981 22.3028 12.037 22.1075 12.1124 21.9252C12.1879 21.743 12.2985 21.5775 12.438 21.438C12.5775 21.2985 12.743 21.1879 12.9253 21.1124C13.1075 21.037 13.3028 20.9981 13.5 20.9981C13.6972 20.9981 13.8925 21.037 14.0748 21.1124C14.257 21.1879 14.4225 21.2985 14.562 21.438L19.152 26.031C20.091 23.919 21.555 22.089 23.382 20.712Z" fill="#747E9F"/>
                </svg>        
            <p>No account registered</p>
            {{-- <button type="submit" id="btn-bank-info-add-1-mobile" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 250px; height: 40px; white-space: nowrap;">Add bank account</button> --}}
        </div>

    </div>
  @endif

  @if (isset($accounts))
  @foreach ($accounts as $account)
  <div id="div-bank-info-3" class="mt-2">
    <div class="card card-body mb-2" style="width: 335px;">
        <div class="d-flex align-items-center">
            {{-- <div class="mr-1">
                <img src="../assets/images/logo-bank.png" class="mb-1 mx-auto" style="max-width: 124px; max-height: 103px;">
            </div> --}}
            <div>
                <p class="mb-50" style="color: #010D33">{{$account->bank_name}}</p>
                <p class="mb-0" style="font-size: 13px;">Last 4: {{$account->last4}}</p>
                <p class="mb-0" style="font-size: 13px;">Country: {{$account->country}}</p>
                <p class="mb-0" style="font-size: 13px;">Currency: {{$account->currency}}</p>
            </div>
        </div>
        {{-- <button type="submit" id="btn-bank-info-add-2" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center mt-50 mb-50" style="font-size: 13px; width: 109px; height: 31px; white-space: nowrap;">Edit bank info</button> --}}
    </div>
  </div>
  @endforeach
  @endif

</div>