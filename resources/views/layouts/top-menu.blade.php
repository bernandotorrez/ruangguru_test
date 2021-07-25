<nav class="navbar navbar-expand-lg navbar-fixed navbar-blue">
    <div class="navbar-inner">

        <div class="navbar-intro justify-content-xl-between">

            <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none"
                data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- mobile sidebar toggler button -->

            <a class="navbar-brand text-white" href="#">
                <span style="visibility: hidden;">Ruang</span>
                <img class="img-thumbnail" src="https://www.ruangguru.com/hubfs/OPTIMIZE/logo%20rg.svg">

            </a><!-- /.navbar-brand -->

            <button type="button" class="btn btn-burger mr-2 d-none d-xl-flex" data-toggle="sidebar"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- sidebar toggler button -->

        </div><!-- /.navbar-intro -->

        <div class="navbar-content">

            <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">
                <a class="navbar-brand text-white text-center" href="#">
                    <span>Ruangguru Marketing Campaign</span>

                </a><!-- /.navbar-brand -->
            </div>
          </div>

        @if (Auth::check())
        <!-- mobile #navbarMenu toggler button -->
        <button class="navbar-toggler ml-1 mr-2 px-1" type="button" data-toggle="collapse" data-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
            <span class="pos-rel">
                <img class="border-2 brc-white-tp1 radius-round" width="36" src="{{ asset('assets/img/avatar.png') }}"
                    alt="Avatar">
                <span class="bgc-warning radius-round border-2 brc-white p-1 position-tr mr-n1px mt-n1px"></span>
            </span>
        </button>
        @endif

        <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

            <div class="navbar-nav">
                <ul class="nav">
                    @if (Auth::check())
                    <li class="nav-item dropdown order-first order-lg-last">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img id="id-navbar-user-image"
                                class="d-none d-lg-inline-block radius-round border-2 brc-white-tp1 mr-2 w-6"
                                src="{{ asset('assets/img/avatar.png') }}" alt="Avatar">
                            <span class="d-inline-block d-lg-none d-xl-inline-block">
                                <span class="text-90" id="id-user-welcome">Welcome,</span>
                                <span class="nav-user-name">{{ Auth::user()['name'] }}</span>
                            </span>

                            <i class="caret fa fa-angle-down d-none d-xl-block"></i>
                            <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                        </a>

                        <div
                            class="dropdown-menu dropdown-caret dropdown-menu-right dropdown-animated brc-primary-m3 py-1">
                            <div class="d-none d-lg-block d-xl-none">
                                <div class="dropdown-header">
                                    Welcome, Jason
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <a class="dropdown-item btn btn-outline-grey bgc-h-secondary-l3 btn-h-light-secondary btn-a-light-secondary"
                                href="{{ route('login.logout') }}">
                                <i class="fa fa-power-off text-warning-d1 text-105 mr-1"></i>
                                Logout
                            </a>
                        </div>
                    </li><!-- /.nav-item:last -->
                    @endif

                </ul><!-- /.navbar-nav menu -->
            </div><!-- /.navbar-nav -->

        </div><!-- /#navbarMenu -->


    </div><!-- /.navbar-inner -->
</nav>
