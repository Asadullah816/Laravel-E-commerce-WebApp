<!-- partial:partials/_navbar.html -->

<nav class="flex-row p-0 navbar default-layout col-lg-12 col-12 fixed-top d-flex align-items-top">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                <img src="{{ asset('Admin/images/logo.svg') }}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="{{ asset('Admin/images/logo-mini.svg') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Good Morning, <span
                        class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
                <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown"
                    href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
                <div class="pb-0 dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <a class="py-3 dropdown-item">
                        <p class="float-left mb-0 font-weight-medium">Select category</p>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Bootstrap Bundle </p>
                            <p class="mb-0 fw-light small-text">This is a Bundle featuring 16 unique dashboards</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Angular Bundle</p>
                            <p class="mb-0 fw-light small-text">Everything you’ll ever need for your Angular
                                projects</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">VUE Bundle</p>
                            <p class="mb-0 fw-light small-text">Bundle of 6 Premium Vue Admin Dashboard</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">React Bundle</p>
                            <p class="mb-0 fw-light small-text">Bundle of 8 Premium React Admin Dashboard</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                    <span class="input-group-addon input-group-prepend border-right">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>

                </div>
            </li>
            <li class="nav-item">
                <form class="m-0 search-form" action="{{ route('adminsearch') }}" method="get">
                    @csrf
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" name="search"
                        title="Search here">
                    {{-- <button type="submit" value="search" class="form-control">search</button> --}}
                </form>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-mail icon-lg"></i>
                </a>
                <div class="pb-0 dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <a class="py-3 dropdown-item border-bottom">
                        <p class="float-left mb-0 font-weight-medium">You have 4 new notifications </p>
                        <span class="float-right badge badge-pill badge-primary">View all</span>
                    </a>
                    <a class="py-3 dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <i class="m-auto mdi mdi-alert text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="mb-1 preview-subject fw-normal text-dark">Application Error</h6>
                            <p class="mb-0 fw-light small-text"> Just now </p>
                        </div>
                    </a>
                    <a class="py-3 dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <i class="m-auto mdi mdi-settings text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="mb-1 preview-subject fw-normal text-dark">Settings</h6>
                            <p class="mb-0 fw-light small-text"> Private message </p>
                        </div>
                    </a>
                    <a class="py-3 dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <i class="m-auto mdi mdi-airballoon text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="mb-1 preview-subject fw-normal text-dark">New user registration</h6>
                            <p class="mb-0 fw-light small-text"> 2 days ago </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="icon-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="pb-0 dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="countDropdown">
                    <a class="py-3 dropdown-item">
                        <p class="float-left mb-0 font-weight-medium">You have 7 unread mails </p>
                        <span class="float-right badge badge-pill badge-primary">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('Admin/images/faces/face10.jpg') }}" alt="image"
                                class="img-sm profile-pic">
                        </div>
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                            <p class="mb-0 fw-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('Admin/images/faces/face12.jpg') }}" alt="image"
                                class="img-sm profile-pic">
                        </div>
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                            <p class="mb-0 fw-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('Admin/images/faces/face1.jpg') }}" alt="image"
                                class="img-sm profile-pic">
                        </div>
                        <div class="flex-grow py-2 preview-item-content">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                            <p class="mb-0 fw-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('Admin/images/faces/face8.jpg') }}"
                        alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="text-center dropdown-header">
                        <img class="img-md rounded-circle" src="{{ asset('Admin/images/faces/face8.jpg') }}"
                            alt="Profile image">
                        <p class="mt-3 mb-1 font-weight-semibold">Allen Moreno</p>
                        <p class="mb-0 fw-light text-muted">allenmoreno@gmail.com</p>
                    </div>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                        <span class="badge badge-pill badge-danger">1</span></a>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                        Messages</a>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                        Activity</a>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>

                    <div class="dropdown-item "><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                        <form class="m-0 " action="{{ route('logout') }}" method="POST">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
