<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href={{ route('home', ['locale' => app()->getLocale()]) }} class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('/assets/img/logo.png') }}" alt="" width="32" height="22">
                            {{-- <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg> --}}
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">Offerli</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Page -->
                    @if (auth()->user()->hasPermissionTo('View Dashboard'))
                        <li class="menu-item {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}">
                            <a href={{ route('dashboard.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Users'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Controlling">Controlling</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                            <a href={{ route('users') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-users"></i>
                                <div data-i18n="Users">Users</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Roles'))
                        <li class="menu-item {{ Route::currentRouteName() == 'roles.index' ? 'active' : '' }}">
                            <a href={{ route('roles.index') }} class="menu-link">
                                <i class="menu-icon ti ti-lock"></i>
                                <div data-i18n="Roles">Roles</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Brands'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'brands.index' ? 'active' : '' }}">
                            <a href={{ route('brands.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="Brands">Brands</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Categories'))
                        <li class="menu-item {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}">
                            <a href={{ route('categories.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                                <div data-i18n="Categories">Categories</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Categories'))
                        <li class="menu-item {{ Route::currentRouteName() == 'subcategories.index' ? 'active' : '' }}">
                            <a href={{ route('subcategories.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                                <div data-i18n="SubCategory">SubCategory</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Vouchers'))
                        <li class="menu-item {{ Route::currentRouteName() == 'vouchers.index' ? 'active' : '' }}">
                            <a href={{ route('vouchers.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-id"></i>
                                <div data-i18n="Vouchers">Vouchers</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Customers'))
                        <li class="menu-item {{ Route::currentRouteName() == 'customers.index' ? 'active' : '' }}">
                            <a href={{ route('customers.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-text-wrap-disabled"></i>
                                <div data-i18n="Customers">Customers</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Sales'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Statistics">Statistics</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'sales' ? 'active' : '' }}">
                            <a href={{ route('sales') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Sales">Sales</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Rating'))
                        <li class="menu-item {{ Route::currentRouteName() == 'rating.index' ? 'active' : '' }}">
                            <a href={{ route('rating.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-map"></i>
                                <div data-i18n="Rating">Rating</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('View Invoices'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Invoices">Invoices</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'invoice.index' ? 'active' : '' }}">
                            <a href={{ route('invoice.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                                <div data-i18n="Invoices">Invoices</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Add Advertise'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Advertise">Advertise</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'advertise.index' ? 'active' : '' }}">
                            <a href={{ route('advertise.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-components"></i>
                                <div data-i18n="Advertise">Advertise</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermissionTo('Push Notifications'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Notifications">Notifications</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'notifications' ? 'active' : '' }}">
                            <a href={{ route('notifications') }} class="menu-link">
                                <i class="menu-icon fas fa-bell"></i>
                                <div data-i18n="Notifications">Notifications</div>
                            </a>
                        </li>
                    @endif




                    @if (auth()->user()->hasPermissionTo('View Settings'))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text" data-i18n="Settings">Settings</span>
                        </li>
                        <li class="menu-item {{ Route::currentRouteName() == 'settings.edit' ? 'active' : '' }}">
                            <a href={{ route('settings.edit') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Settings">Settings</div>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermissionTo('View Settings'))
                        <li class="menu-item {{ Route::currentRouteName() == 'landing.index' ? 'active' : '' }}">
                            <a href={{ route('landing.index') }} class="menu-link">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Landing Page">Landing Page</div>
                            </a>
                        </li>
                    @endif



                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
