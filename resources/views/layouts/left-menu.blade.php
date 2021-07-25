<div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light">
    <div class="sidebar-inner">

        <div class="ace-scroll flex-grow-1" data-ace-scroll="{}">

            <ul class="nav has-active-border active-on-right">

                @if (!Auth::check())
                <li class="nav-item-caption">
                    <span class="fadeable pl-3">MAIN</span>
                    <span class="fadeinable mt-n2 text-125">&hellip;</span>
                </li>

                <li class="nav-item {{ (url()->current() == route('home.index')) ? 'active' : '' }}">

                    <a href="{{ route('home.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="nav-text fadeable">
                            <span>Submit Submission</span>
                        </span>
                    </a>

                    <b class="sub-arrow"></b>

                </li>

                <li class="nav-item {{ (url()->current() == route('home.check-submission')) ? 'active' : '' }}">

                    <a href="{{ route('home.check-submission') }}" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <span class="nav-text fadeable">
                            <span>Check Submission</span>
                        </span>
                    </a>

                    <b class="sub-arrow"></b>

                </li>
                @endif

                {{-- <li class="nav-item">

                    <a href="#" class="nav-link dropdown-toggle collapsed">
                        <i class="nav-icon fa fa-cube"></i>
                        <span class="nav-text fadeable">
                            <span>Layouts</span>
                        </span>

                        <b class="caret fa fa-angle-left rt-n90"></b>
                    </a>

                    <div class="hideable submenu collapse">
                        <ul class="submenu-inner">

                            <li class="nav-item">
                                <a href="html/dashboard-2.html" class="nav-link">
                                    <span class="nav-text">
                                        <span>Dashboard 2</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <b class="sub-arrow"></b>

                </li> --}}

                @if (Auth::check())
                    @if (Auth::user()['is_admin'] == '1')
                    <li class="nav-item-caption">
                        <span class="fadeable pl-3">ADMIN</span>
                        <span class="fadeinable mt-n2 text-125">&hellip;</span>
                    </li>

                    <li class="nav-item {{ (url()->current() == route('admin.submission-list')) ? 'active' : '' }}">

                        <a href="{{ route('admin.submission-list') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <span class="nav-text fadeable">
                                <span>Submission List</span>
                            </span>
                        </a>

                        <b class="sub-arrow"></b>

                    </li>
                    @endif
                @endif


            </ul>

        </div><!-- /.sidebar scroll -->

    </div>
</div>
