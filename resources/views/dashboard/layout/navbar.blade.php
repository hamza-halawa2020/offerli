<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>
    <?php
    $notifications = App\Models\Notification::latest()->get(); // Replace with your logic to retrieve a user
    $unreadNotifications = App\Models\Notification::where('read_at', null)->get(); // Replace with your logic to retrieve a user
    ?>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-language rounded-circle ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                            data-text-direction="ltr">
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="ar"
                            data-text-direction="rtl">
                            <span class="align-middle">العربية</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Notification -->

            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="ti ti-bell ti-md"></i>
                    @if ($unreadNotifications->count())
                        <span
                            class="badge bg-danger rounded-pill badge-notifications">{{ $unreadNotifications->count() }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                            <form action="{{ route('markAllAsRead') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-notifications-all text-body"
                                    style="background: none;" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></button>
                            </form>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @foreach ($notifications as $notification)
                                {{-- <a href="{{ route('brands.index') }}"> --}}
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            @if ($notification->data['type'] == 'new_brand')
                                                <div class="avatar" id="clickableDiv" style="cursor: pointer;">
                                                    <span class="avatar-initial rounded-circle bg-label-info">NB</span>
                                                </div>
                                            @endif
                                            @if ($notification->data['type'] == 'new_voucher')
                                                <div class="avatar">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-success">NV</span>
                                                </div>
                                            @endif
                                            @if ($notification->data['type'] == 'new_feature_request')
                                                <div class="avatar">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-warning">NF</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $notification->data['message'] }}</h6>
                                            <p class="mb-0">{{ $notification->data['action'] }}</p>
                                            <small class="text-muted">{{ $notification->created_at }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            @if (!$notification->read_at)
                                                <a href="{{ route('brands.index') }}" style="padding-bottom: 30px;"
                                                    class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a>
                                            @endif
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                    class="ti ti-x"></span></a>

                                        </div>
                                    </div>
                                </li>
                                {{-- </a> --}}

                                {{-- <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded-circle bg-label-success"><i
                                                        class="ti ti-shopping-cart"></i></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                                            <p class="mb-0">ACME Inc. made new order $1,154</p>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                    class="badge badge-dot"></span></a>
                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                    class="ti ti-x"></span></a>
                                        </div>
                                    </div>
                                </li> --}}
                            @endforeach
                        </ul>
                    </li>

                </ul>
            </li>
            <!--/ Notification -->
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src={{ asset('assets/img/avatars/1.png') }} alt class="h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src={{ asset('assets/img/avatars/1.png') }} alt
                                            class="h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                    <small class="text-muted">{{ auth()->user()->getRoleNames()->first() }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="ti ti-user-check me-2 ti-sm"></i>
                            <span class="align-middle" data-i18n="My Profile">My Profile</span>
                        </a>
                    </li>


                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" style="padding-left: 20% ;padding-right: 20%;"
                            method="POST">
                            @csrf
                            <button class="align-middle btn btn-danger" type="submit" data-i18n="Logout">LogOut
                                <i class="ti ti-logout me-2 ti-sm"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

<!-- / Navbar -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <script>
        document.getElementById('clickableDiv').addEventListener('click', function() {
            window.location.href = "{{ route('brands.index') }}"; // Replace with your actual route
        });
    </script>
