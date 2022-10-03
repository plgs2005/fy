@if (!isset($balance))
  <div id="container-payments" class="d-flex align-items-center mt-2">
    Your account has not received any payment yet.
  </div>

@else
<div id="container-payments" class="d-flex align-items-center mt-2">
    <p class="title mr-1 mb-0" style="font-size: 20px">
      Balance: <span style="font-weight: 400">{{stripeNumFormat($balance->available[0]->amount)}} {{ucfirst($balance->available[0]->currency)}}</span>
    </p>
    <button
      type="button"
      id="btn-withdraw-modal"
      class="btn btn-secondary position-relative justify-content-center align-items-center d-flex d-sm-none"
      style="width: 82px; height: 31px; white-space: nowrap; font-size: 13px"
    >
      withdraw
    </button>
  </div>
  
  <div class="row mt-1 d-flex justify-content-between mt-1 mb-1">
    <div class="col-xl-6">
      <div class="d-flex mw-100 mb-2">
        <button type="button" id="btn-receive"
          class="btn btn-primary position-relative d-flex justify-content-center align-items-center mr-1"
          style="width: 194px; height: 31px; white-space: nowrap; font-size: 13px">
          To receive
        </button>
        <button type="button" id="btn-history"
          class="btn btn-secondary position-relative d-flex justify-content-center align-items-center"
          style="width: 194px; height: 31px; white-space: nowrap; font-size: 13px">
          History
        </button>
      </div>
      <div id="payments-content-receive" class="text-center container-payments-influencer">
        <ul class="timeline timeline-payment">
          {{-- <li id="li-timeline-payment-1" class="timeline-item timeline-icon-*color-palette* active pb-2"> --}}
            <div class="timeline-content">
              @foreach ($campaigns as $campaign)
                  @if ($campaign->pivot->paid != true and $campaign->pivot->value > 0)
                  <div class="card mb-2 mr-2">
                    <div class="card-body d-flex flex-column text-left">
                      <p class="card-secondary--title">{{stripeNumFormat($campaign->pivot->value)}}</p>
                      <div class="d-flex">
                        {{-- <div class="pr-1">
                          <img src="../assets/images/logo-nike.png" class="img-fluid"/>
                        </div> --}}
                        <div>
                          <a href="#" style="text-decoration: underline">{{$campaign->name}}</a>
                          <p class="mb-0 mt-50">
                            {{$campaign->dateMetadata()}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
              @endforeach
            </div>
          {{-- </li> --}}
        </ul>
      </div>

      <div id="payments-content-history" class="text-center container-payments-influencer d-none">
        <ul class="timeline timeline-payment">
          @if ($history)
          @foreach ($history as $key=>$item)
          <li id="li-timeline-payment-1" class="timeline-item timeline-icon-*color-palette* active pb-2">
            @php
              echo paymentTimelineDateInfluencer($key);
            @endphp
            <div class="timeline-content">
              @foreach ($item as $item2)
                @if (isset($item2->metadata->campaign_name))
                  <div class="card mb-2 mr-2">
                    <div class="card-body d-flex flex-column text-left">
                      <p class="card-secondary--title">{{stripeNumFormat($item2['amount'])}}</p>
                      <div class="d-flex">
                        {{-- <div class="pr-1">
                          <img src="../assets/images/logo-nike.png" class="img-fluid"/>
                        </div> --}}
                        <div>
                          <a href="#" style="text-decoration: underline">{{$item2->metadata->campaign_name}}</a>
                          <p class="mb-0 mt-50">
                            {{$item2->metadata->datetime}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @else
                    <div class="card mb-2 mr-2">
                      <div class="card-body d-flex flex-column text-left">
                        <p class="card-secondary--title">{{stripeNumFormat($item2['amount'])}}</p>
                        <div class="d-flex">
                          <div>
                            <p>Withdraw</p>
                            <p class="mb-0 mt-50">
                              @if($balance->available[0]->amount < $item2->balance)
                                Processed
                              @else
                                Pending
                              @endif
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
            </div>
          </li>
          @endforeach
          @else
          No history data
          @endif
        </ul>
      </div>

    </div>
    <div class="col-xl-6 d-none d-sm-block">
      <div
        class="d-flex flex-column justify-content-center"
        style="
          background: rgba(228, 233, 233, 0.5);
          border-radius: 8px;
          padding: 80px;
        "
      >
      {{-- withdraw form desktop --}}
      <div id="div-payments-withdraw" class="align-self-center">
        <form id="payments-withdraw" onsubmit="valWithdraw(); return false;">
          <p class="title text-center" style="font-size: 20px">Withdraw</p>
          <div class="card card-body mb-2" style="width: 335px">
            <p class="red-hat-text p-500 mb-50">
              How much do you want to receive?
            </p>
            <div class="form-group">
              <input
                type="text"
                minlength="3"
                id="payments-receive"
                class="form-control"
                required="required"
              />
            </div>
            {{-- <p style="font-size: 13px"><i>Remaining balance: $ 2.600,00</i></p> --}}
            <p class="red-hat-text p-500">This amount will be transfered to the following account:</p>
            <div class="d-flex align-items-center">
              {{-- <div>
                <img
                  src="../assets/images/logo-bank.png"
                  class="mb-1"
                  style="max-width: 124px; max-height: 103px"
                />
              </div> --}}
              <div>
                <p style="color: #010d33" class="mb-50">{{$accounts[0]['bank_name']}}</p>
                <p style="font-size: 13px" class="mb-0">Last 4: {{$accounts[0]['last4']}}</p>
                <p style="font-size: 13px" class="mb-0">Country: {{$accounts[0]['country']}}</p>
                <p style="font-size: 13px" class="mb-0">Currency: {{$accounts[0]['currency']}}</p>
              </div>
            </div>
          </div>
          <button
            type="submit"
            id="btn-payments-continue"
            class="btn btn-primary position-relative d-flex justify-content-center align-items-center m-auto"
            style="width: 250px; height: 40px; white-space: nowrap"
          >
            Continue
          </button>
        </form>
      </div>
      {{-- end withdraw form desktop --}}
  
  
      {{-- confirm withdraw desktop --}}
        <div id="div-payments-confirm-withdraw" class="align-self-center text-center d-none">
          <p class="red-hat-text p-500 mb-50">How much do you want to receive?</p>
          <p id="payments-receive-value" class="mb-50"
            style="color: #010d33; font-weight: 700; font-size: 20px">
          </p>
          <p style="font-size: 13px" class="mb-2"><i id="remainingBalance"></i></p>
          {{-- <p style="font-size: 13px" class="mb-2"><i>You will receive this value in you account in {{$delay_days}} days.</i></p> --}}
          <p class="red-hat-text p-500">Selected bank account:</p>
          <img
            src="../assets/images/logo-bank.png"
            class="mb-2"
            style="max-width: 124px; max-height: 103px"
          />
          <button
            type="submit"
            id="btn-payments-confirm"
            class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50"
            style="width: 250px; height: 40px; white-space: nowrap"
          >
            Confirm Withdraw
          </button>
          <button
            type="submit"
            id="btn-payments-cancel"
            class="btn btn-secondary position-relative d-flex justify-content-center align-items-center m-auto"
            style="width: 250px; height: 40px; white-space: nowrap"
          >
            Cancel
          </button>
        </div>
        {{-- end confirm withdraw desktop --}}
      </div>
    </div>
  </div>
  
  <!-- Start Modal Withdraw -->
  <div
    class="modal fade"
    id="modal-main-menu-mobile-withdraw"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <nav
            class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top pt-2"
          >
            <div class="navbar-wrapper">
              <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                  <div
                    id="container-navbar-mobile"
                    class="bookmark-wrapper d-flex align-items-center w-100"
                  >
                    <a id="btn-back-withdraw">
                      <svg
                        width="25"
                        height="22"
                        viewBox="0 0 25 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="btn-arrow-back m-0"
                      >
                        <path
                          d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z"
                          fill="#010D33"
                        />
                      </svg>
                    </a>
                    <p
                      id="dashboard-header-title-menu-withdraw"
                      class="title mb-0"
                      style="font-size: 20px"
                    >
                      Withdraw
                    </p>
                    <div style="width: 25px"></div>
                  </div>
                </div>
              </div>
            </div>
            <hr
              class="m-0 mt-auto w-100 d-block d-sm-none"
              style="
                height: 2px;
                background: #033fff;
                border-radius: 0px 5px 5px 0px;
              "
            />
          </nav>
          <div>
            <p class="title mr-1 mb-0 mt-2 mb-2" style="font-size: 20px">
              Balance: <span style="font-weight: 400">{{stripeNumFormat($balance->available[0]->amount)}} {{ucfirst($balance->available[0]->currency)}}</span>
            </p>
            <div id="div-payments-withdraw" class="align-self-center">
              <form onsubmit="valWithdrawMobile(); return false;">>
                <div class="card card-body mb-2" style="width: 335px">
                  <p class="red-hat-text p-500 mb-50">
                    How much do you want to receive?
                  </p>
                  <div class="form-group">
                    <input type="text"
                      minlength="3"
                      id="payments-receive-withdraw"
                      class="form-control"
                      required="required"/>
                  </div>
                  {{-- <p style="font-size: 13px"><i>Remaining balance: $ 2.600,00</i></p> --}}
                  <p class="red-hat-text p-500">This amount will be transfered to the following account:</p>
                  <div class="d-flex align-items-center">
                    <div>
                      <img
                        src="../assets/images/logo-bank.png"
                        class="mb-1"
                        style="max-width: 124px; max-height: 103px"
                      />
                    </div>
                    <div>
                      <p style="color: #010d33" class="mb-50">{{$accounts[0]['bank_name']}}</p>
                      <p style="font-size: 13px" class="mb-0">Last 4: {{$accounts[0]['last4']}}</p>
                      {{-- <p style="font-size: 13px" class="mb-0">email@email.com</p> --}}
                    </div>
                  </div>
                </div>
                <button type="submit"
                  id="btn-withdraw-continue"
                  class="btn btn-primary position-relative d-flex justify-content-center align-items-center m-auto"
                  style="width: 250px; height: 40px; white-space: nowrap">Continue</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Withdraw -->
  
  <!-- Start Modal Confirm Withdraw -->
  <div
    class="modal fade"
    id="modal-main-menu-mobile-confirm-withdraw"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <nav
            class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top pt-2"
          >
            <div class="navbar-wrapper">
              <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                  <div
                    id="container-navbar-mobile"
                    class="bookmark-wrapper d-flex align-items-center w-100"
                  >
                    <a id="btn-back-confirm-withdraw">
                      <svg
                        width="25"
                        height="22"
                        viewBox="0 0 25 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="btn-arrow-back m-0"
                      >
                        <path
                          d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z"
                          fill="#010D33"
                        />
                      </svg>
                    </a>
                    <p
                      id="dashboard-header-title-menu-withdraw"
                      class="title mb-0"
                      style="font-size: 20px"
                    >
                      Confirm withdraw
                    </p>
                    <div style="width: 25px"></div>
                  </div>
                </div>
              </div>
            </div>
            <hr
              class="m-0 mt-auto w-100 d-block d-sm-none"
              style="
                height: 2px;
                background: #033fff;
                border-radius: 0px 5px 5px 0px;
              "
            />
          </nav>
          <div>
              <div id="div-payments-confirm-withdraw" class="align-self-center text-center mt-2">
                  <p class="red-hat-text p-500 mb-50">How much do you want to receive?</p>
                  <p id="payments-receive-value-confirm-withdraw" class="mb-50" style="color: #010D33; font-weight: 700; font-size: 20px;"></p>
                  <p style="font-size: 13px;" class="mb-2"><i id="remainingBalance-mobile"></i></p>
                  <p class="red-hat-text p-500">Selected bank account</p>
                  <img src="../assets/images/logo-bank.png" class="mb-2" style="max-width: 124px; max-height: 103px;">
                  <button type="submit" id="btn-confirm-withdraw-confirm" class="btn btn-primary position-relative d-flex justify-content-center align-items-center mx-auto mt-50 mb-50" style="width: 250px; height: 40px; white-space: nowrap;">Confirm Withdraw</button>
                  <button type="submit" id="btn-confirm-withdraw-cancel" class="btn btn-secondary position-relative d-flex justify-content-center align-items-center m-auto" style="width: 250px; height: 40px; white-space: nowrap;">Cancel</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Confirm Withdraw -->
  
  <!-- Start Modal Successful Withdraw -->
  <div
    class="modal fade"
    id="modal-main-menu-mobile-successful-withdrawal"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <nav
            class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top pt-2"
          >
            <div class="navbar-wrapper">
              <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                  <div
                    id="container-navbar-mobile"
                    class="bookmark-wrapper d-flex align-items-center w-100"
                  >
                    <a id="btn-back-successful-withdrawal">
                      <svg
                        width="25"
                        height="22"
                        viewBox="0 0 25 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="btn-arrow-back m-0"
                      >
                        <path
                          d="M25 9.66667H5.552L12.6093 2.60933L10.724 0.723999L0.447998 11L10.724 21.276L12.6093 19.3907L5.552 12.3333H25V9.66667Z"
                          fill="#010D33"
                        />
                      </svg>
                    </a>
                    <p
                      id="dashboard-header-title-menu-withdraw"
                      class="title mb-0"
                      style="font-size: 20px"
                    >
                    Successful withdrawal
                    </p>
                    <div style="width: 25px"></div>
                  </div>
                </div>
              </div>
            </div>
            <hr
              class="m-0 mt-auto w-100 d-block d-sm-none"
              style="
                height: 2px;
                background: #033fff;
                border-radius: 0px 5px 5px 0px;
              "
            />
          </nav>
          <div class="d-flex w-100 h-100">
              <div id="div-payments-successful-withdrawal-mobile" class="text-center">
                  <svg width="36" height="42" viewBox="0 0 36 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M18.1043 2.77215C18.7343 1.20915 20.4893 -0.467851 22.7423 0.156149C24.5123 0.648149 25.6613 1.71915 26.3213 3.14715C26.9333 4.47615 27.0833 6.03915 27.1133 7.53315C27.1433 9.13515 26.8073 11.0611 26.4143 12.7441C26.2389 13.4892 26.0438 14.2294 25.8293 14.9641H29.9843C30.9169 14.9641 31.8367 15.1814 32.6706 15.5988C33.5045 16.0163 34.2297 16.6223 34.7885 17.3689C35.3473 18.1156 35.7243 18.9822 35.8897 19.8999C36.0551 20.8177 36.0043 21.7614 35.7413 22.6561L31.6493 36.5941C31.3683 37.5503 30.8995 38.4409 30.2703 39.2139C29.6411 39.9868 28.8642 40.6266 27.9849 41.0958C27.1056 41.5651 26.1417 41.8543 25.1493 41.9468C24.157 42.0392 23.1561 41.9329 22.2053 41.6341L6.13734 36.5881C5.26838 36.3154 4.47292 35.8484 3.81124 35.2226C3.14956 34.5968 2.63902 33.8286 2.31834 32.9761L0.758341 28.8241C0.261876 27.5027 0.247197 26.0486 0.716886 24.7175C1.18657 23.3863 2.11055 22.2634 3.32634 21.5461L8.94234 18.2311C9.50826 17.7836 10.0333 17.2866 10.5113 16.7461C11.5433 15.5821 12.9623 13.6411 14.3873 10.6141C15.0023 9.30615 15.5183 8.27415 15.9863 7.34415C16.7453 5.83215 17.3813 4.57215 18.1043 2.77215ZM10.5563 20.7601C10.5395 20.7705 10.5225 20.7805 10.5053 20.7901L4.85034 24.1321C4.24245 24.4908 3.78046 25.0522 3.54561 25.7178C3.31077 26.3834 3.31811 27.1104 3.56634 27.7711L5.12634 31.9231C5.28684 32.3495 5.54233 32.7337 5.87344 33.0467C6.20456 33.3596 6.60259 33.593 7.03734 33.7291L23.0993 38.7751C23.6702 38.9549 24.2713 39.019 24.8673 38.9636C25.4632 38.9082 26.0422 38.7345 26.5702 38.4526C27.0982 38.1707 27.5646 37.7864 27.9423 37.322C28.3199 36.8576 28.6011 36.3225 28.7693 35.7481L32.8583 21.8101C32.9899 21.3627 33.0153 20.8907 32.9325 20.4317C32.8497 19.9727 32.661 19.5393 32.3815 19.1659C32.1019 18.7926 31.7391 18.4896 31.322 18.281C30.9048 18.0724 30.4448 17.9639 29.9783 17.9641H23.7803C23.5404 17.964 23.3039 17.9063 23.0908 17.7958C22.8778 17.6854 22.6943 17.5254 22.5559 17.3294C22.4175 17.1334 22.3281 16.907 22.2953 16.6692C22.2625 16.4315 22.2872 16.1894 22.3673 15.9631C22.6673 15.1171 23.1233 13.6531 23.4953 12.0601C23.8733 10.4461 24.1403 8.81415 24.1163 7.59015C24.0863 6.18315 23.9393 5.14215 23.5973 4.40115C23.3033 3.75915 22.8443 3.29715 21.9413 3.04815C21.8123 3.01215 21.6593 3.02115 21.4613 3.15015C21.2029 3.33471 21.0046 3.59143 20.8913 3.88815C20.2004 5.57343 19.4346 7.22708 18.5963 8.84415C18.1313 9.76815 17.6423 10.7461 17.1053 11.8891C15.5633 15.1681 13.9853 17.3521 12.7553 18.7351C12.1433 19.4251 11.6213 19.9171 11.2373 20.2441C11.0423 20.4099 10.8401 20.5671 10.6313 20.7151L10.5833 20.7451L10.5683 20.7571L10.5593 20.7601H10.5563Z" fill="#010D33"/>
                  </svg>
                  <h3>Successful withdrawal!</h3>
                  <p>Quae tibi placent quicunq prosunt aut diligebat multum.</p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Successful Withdraw -->
  
  <script>
      function valWithdraw() {
        var balance = '{{$balance->available[0]->amount}}';
        var paymentsReceive = $("#payments-receive")[0].value;
        paymentsReceive2 = paymentsReceive.replace(/[^\d]/g, '');
        remainingBalance = (balance - paymentsReceive2)/100;
        remainingBalance = parseInt(remainingBalance).toLocaleString('en-US', {minimumFractionDigits: 2});

        if (parseInt(paymentsReceive2) > parseInt(balance)) {
          toastr.warning("Selected value can't be greater than your balance", "Warning");
        } else {
          $("#payments-receive-value")[0].innerText = '$ '+paymentsReceive;
          $("#div-payments-withdraw").addClass("d-none");
          $("#div-payments-confirm-withdraw").removeClass("d-none");
          $("#remainingBalance").text('Remaining balance: $ '+remainingBalance);
        }
      }
  
      function valWithdrawMobile() {
        var balance = '{{$balance->available[0]->amount}}';
        var paymentsReceive = $("#payments-receive-withdraw")[0].value;
        paymentsReceive2 = paymentsReceive.replace(/[^\d]/g, '');
        remainingBalance = (balance - paymentsReceive2)/100;
        remainingBalance = parseInt(remainingBalance).toLocaleString('en-US', {minimumFractionDigits: 2});

        if (parseInt(paymentsReceive2) > parseInt(balance)) {
          toastr.warning("Selected value can't be greater than your balance", "Warning");
        } else {
          $("#modal-main-menu-mobile-confirm-withdraw").modal();
          var paymentsReceive = $("#payments-receive-withdraw")[0].value;
          $("#payments-receive-value-confirm-withdraw")[0].innerText = '$ '+paymentsReceive;
          $("#remainingBalance-mobile").text('Remaining balance: $ '+remainingBalance);
        }
      }
  
      $("#btn-payments-cancel").click(function () {
        $("#div-payments-withdraw").removeClass("d-none");
        $("#div-payments-confirm-withdraw").addClass("d-none");
      });
  
      $("#btn-withdraw-modal").click(function () {
          $("#modal-main-menu-mobile-withdraw").modal();
      });
  
      $("#btn-back-withdraw").click(function () {
          $("#modal-main-menu-mobile-withdraw").modal("toggle");
      });
  
      $("#btn-back-confirm-withdraw").click(function () {
          $("#modal-main-menu-mobile-confirm-withdraw").modal("toggle");
      });
  
      $("#btn-confirm-withdraw-confirm").click(function () {
        $("#btn-payments-confirm").prop("disabled",true);
        var paymentsReceive = $("#payments-receive-withdraw")[0].value;
        paymentsReceive2 = paymentsReceive.replace(/[^\d]/g, '');

        $.ajax({
          type:'POST',
          url:'/withdraw',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {'amount': paymentsReceive2},
          success:function(data){
            if(data[0].status == 'success'){
                toastr.success(data[0].message, "Success");
                $("#modal-main-menu-mobile-successful-withdrawal").modal();
                $("#btn-payments-confirm").prop("disabled",false);
            }else if(data[0].status == 'error'){
                toastr.error(data[0].message, "Error");
                $("#btn-payments-confirm").prop("disabled",false);
            }  
          }
        });
      });

      $("#btn-payments-confirm").click(function () {
        $("#btn-payments-confirm").prop("disabled",true);
        var paymentsReceive = $("#payments-receive")[0].value;
        paymentsReceive2 = paymentsReceive.replace(/[^\d]/g, '');

        $.ajax({
          type:'POST',
          url:'/withdraw',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {'amount': paymentsReceive2},
          success:function(data){
            $("#btn-payments-confirm").prop("disabled",false);
            if(data[0].status == 'success'){
                toastr.success(data[0].message, "Success");
                $("#dashboard-body").load("/payments");
            }else if(data[0].status == 'error'){
                toastr.error(data[0].message, "Error");
                $("#dashboard-body").load("/payments");
            }
          },
          error:function(data){
              console.log(data);
              $.each(data.responseJSON.errors, function(index, item){
                  $.each(item, function(index2, item2){
                    toastr.error(item2, "Error");
                  });
                  $("#btn-payments-confirm").prop("disabled",false);
              });
            },
        });
        
      });
  
      $("#btn-confirm-withdraw-cancel").click(function () {
          $("#modal-main-menu-mobile-confirm-withdraw").modal("toggle");
      });
  
      $("#btn-back-successful-withdrawal").click(function () {
          $("#modal-main-menu-mobile-successful-withdrawal").modal("toggle");
          $("#modal-main-menu-mobile-confirm-withdraw").modal("toggle");
          $("#modal-main-menu-mobile-withdraw").modal("toggle");
      });

      $("#btn-receive").click(function(){
        $("#payments-content-receive").removeClass('d-none')
        $("#payments-content-history").addClass('d-none');
      });

      $("#btn-history").click(function(){
        $("#payments-content-receive").addClass('d-none')
        $("#payments-content-history").removeClass('d-none');
      });

      $(document).ready(function(){
        $('#payments-receive').mask('000.000,00', {reverse: true});
      });
      $(document).ready(function(){
        $('#payments-receive-withdraw').mask('000.000,00', {reverse: true});
      });
            
  </script>
  @endif
  