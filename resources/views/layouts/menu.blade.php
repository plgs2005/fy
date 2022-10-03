<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow expanded pt-2" data-scroll-to-active="true" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="navbar-header expanded">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
            <div class="login-header--logo">
              <a href="home">
                <img class="img-fluid" src="../assets/images/logo_horizontal_influencify_02.svg" alt="logo brand" style="width: 268px; height: 100px; margin-top: -27px; margin-left: -27px;">
              </a>
            </div>
        </li>
        <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
            </a>
        </li>
      </ul>
    </div>
    <div class="main-menu-content ps ps--active-y d-flex flex-column justify-content-between">
        <div>
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li id="li-btn-new-campaign" class="mb-1">
                    <a class="p-0" href="{{ route('campaign.copy') }}"> <button type="button" class="btn btn-primary position-relative w-100" style="height: 48px;"><i class="bx bx-plus-circle" style="margin-left: -70px;margin-right: 10px;font-size: 20px;"></i><span style="font-weight: 900;">New Campaign</span></button></a>
                </li>
                <li class="nav-item" id="campaigns-nav-item">
                    <a href="{{ route('brand.campaign.list') }}">
                        <i class="bx bx-paper-plane" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i>
                        <span class="menu-title text-truncate">Campaigns</span>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- <a href="{{ route('brand.analytics') }}"> --}}
                    <a href="#" id="open-brand-analytics">
                        <i class="bx bx-line-chart" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i>
                        <span class="menu-title text-truncate">Analytics</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class="nav-item">
                    <a href="{{ route('brand.profile') }}">
                        <i class="bx bx-user" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i>
                        <span class="menu-title text-truncate">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('brand.settings') }}">
                        <i class="bx bx-cog" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i>
                        <span class="menu-title text-truncate">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subscribe') }}">
                        <i style="margin-right: 8px; margin-left: -2px; margin-top: -2px;">
                        <img class="m-0" src="{{ asset("assets/images/svg-icons/flash.svg") }}" style="filter: invert(49%) sepia(42%) saturate(251%) hue-rotate(188deg) brightness(93%) contrast(89%);" width="24" height="18">
                        </i>  
                        {{-- <i class="bx bx-cog" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i> --}}
                          <span class="menu-title text-truncate">Upgrade to PRO</span>
                      </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out" style="margin-right: 8px; margin-left: -2px; margin-top: -2px;"></i>
                        <span class="menu-title text-truncate">{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
  </div>
  <!-- END: Main Menu-->