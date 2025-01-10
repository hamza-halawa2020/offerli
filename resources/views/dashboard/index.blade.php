@extends('dashboard.layout.app')
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (auth()->user()->hasPermissionTo('View Dashboard'))
            <div class="row mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span data-i18n="Total Used Vouchers">Total Used Vouchers</span>
                                    <div class="d-flex align-items-center my-2">
                                        <h3 class="mb-0 me-2">{{ $soldVoucher->count() }}</h3>
                                        {{-- <p class="text-success mb-0">(+29%)</p> --}}
                                    </div>
                                    <p class="mb-0" data-i18n="Voucher">Voucher</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                            <path
                                                d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card" style="background-color: rgb(62, 158, 84)">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span data-i18n="Total Redeemed">Total Redeemed</span>
                                    <div class="d-flex align-items-center my-2">
                                        <h3 class="mb-0 me-2">{{ $claimedVouchers->count() }}</h3>
                                        {{-- <p class="text-success mb-0">(+18%)</p> --}}
                                    </div>
                                    <p class="mb-0" data-i18n="Voucher">Voucher</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span data-i18n="Invoiced Vouchers">Invoiced Vouchers</span>
                                    <div class="d-flex align-items-center my-2">
                                        <h3 class="mb-0 me-2">{{ $invoicedVouchers->count() }}</h3>
                                        {{-- <p class="text-danger mb-0">(-14%)</p> --}}
                                    </div>
                                    <p class="mb-0" data-i18n="Voucher">Voucher</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-noise-reduction" viewBox="0 0 16 16">
                                            <path
                                                d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m.5-.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m-5 7a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1.5-1.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1-1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-3 5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m.5-.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m1-1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                            <path
                                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M1 8a7 7 0 0 1 12.83-3.875.5.5 0 1 0 .15.235q.197.322.359.667a.5.5 0 1 0 .359.932q.201.658.27 1.364a.5.5 0 1 0 .021.282 7 7 0 0 1-.091 1.592.5.5 0 1 0-.172.75 7 7 0 0 1-.418 1.091.5.5 0 0 0-.3.555 7 7 0 0 1-.296.454.5.5 0 0 0-.712.453c0 .111.036.214.098.297a7 7 0 0 1-.3.3.5.5 0 0 0-.75.614 7 7 0 0 1-.455.298.5.5 0 0 0-.555.3 7 7 0 0 1-1.092.417.5.5 0 1 0-.749.172 7 7 0 0 1-1.592.091.5.5 0 1 0-.282-.021 7 7 0 0 1-1.364-.27A.498.498 0 0 0 5.5 14a.5.5 0 0 0-.473.339 7 7 0 0 1-.668-.36A.5.5 0 0 0 5 13.5a.5.5 0 1 0-.875.33A7 7 0 0 1 1 8" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card" style="background-color: rgb(62, 158, 84)">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span data-i18n="No. of Vouchers">No. of Vouchers</span>
                                    <div class="d-flex align-items-center my-2">
                                        <h3 class="mb-0 me-2">{{ $vouchers->count() }}</h3>
                                        {{-- <p class="text-success mb-0">(+42%)</p> --}}
                                    </div>
                                    <p class="mb-0" data-i18n="Voucher">Voucher</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Website Analytics -->
                <div class="col-lg-6 mb-4">
                    <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                        style="background-color: #38a169;" id="swiper-with-pagination-cards">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-white mb-0 mt-2" data-i18n="Offerli">Offerli</h5>
                                        <small> <span data-i18n="Total">Total</span> {{ $users->count() }} <span
                                                data-i18n="Admin">Adminstrators</span> </small>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                            <h6 class="text-white mt-0 mt-md-3 mb-3" data-i18n="Analytics">Analytics</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                {{ $brands->count() }}</p>
                                                            <p class="mb-0" data-i18n="Brands">Brands</p>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                {{ $branches->count() }}</p>
                                                            <p class="mb-0" data-i18n="Branch">Branch</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                {{ $vouchers->count() }}</p>
                                                            <p class="mb-0" data-i18n="Vouchers">Vouchers</p>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                {{ $brands->where('active', 1)->count() }}</p>
                                                            <p class="mb-0" data-i18n="Active Brands">Active Brands</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                            <img src={{ asset('assets/img/illustrations/card-website-analytics-1.png') }}
                                                alt="Website Analytics" width="170"
                                                class="card-website-analytics-img" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-white mb-0 mt-2" data-i18n="Analytics">Analytics</h5>
                                        <small> <span data-i18n="Total">Total</span> {{ $customers->count() }} <span
                                                data-i18n="Customers">Customers</span></small>
                                    </div>
                                    <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                        <h6 class="text-white mt-0 mt-md-3 mb-3" data-i18n="Sources">Sources</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                            {{ $soldVoucher->count() }}</p>
                                                        <p class="mb-0" data-i18n="Used Vouchers">Used Vouchers</p>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-2">
                                                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                            {{ $categories->count() }}</p>
                                                        <p class="mb-0" data-i18n="Categories">Categories</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                            {{ $subcategories->count() }}</p>
                                                        <p class="mb-0" data-i18n="Sub-Categoirus">Sub-Categoirus </p>
                                                    </li>
                                                    {{-- <li class="d-flex align-items-center mb-2">
                                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k</p>
                                      <p class="mb-0">Campaign</p>
                                    </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                        <img src={{ asset('assets/img/illustrations/card-website-analytics-3.png') }}
                                            alt="Website Analytics" width="170" class="card-website-analytics-img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!--/ Website Analytics -->

                <!-- Sales Overview -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <small class="d-block mb-1 text-muted" data-i18n="Sales Overview">Sales Overview</small>
                                <p class="card-text text-success"></p>
                            </div>
                            <h4 class="card-title mb-1">{{ $soldVoucher->pluck('paid_price')->sum() / 1000 }} k <span
                                    data-i18n="SAR">SAR</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-flex gap-2 align-items-center mb-2">
                                        <span class="badge bg-label-info p-1 rounded"><i
                                                class="ti ti-shopping-cart ti-xs"></i></span>
                                        <p class="mb-0" data-i18n="Revenue">Revenue</p>
                                    </div>
                                    <h5 class="mb-0 pt-1 text-nowrap">
                                        {{ $soldVoucher->pluck('paid_price')->sum() - ($soldVoucher->pluck('paid_price')->sum() * 15) / 100 }}
                                    </h5>
                                    <small class="text-muted">SAR</small>
                                </div>
                                <div class="col-4">
                                    <div class="divider divider-vertical">
                                        <div class="divider-text">
                                            <span class="badge-divider-bg bg-label-secondary">VS</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                        <p class="mb-0" data-i18n="Tax">TAX</p>
                                        <span class="badge bg-label-primary p-1 rounded"><i
                                                class="ti ti-link ti-xs"></i></span>
                                    </div>
                                    <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">
                                        {{ ($soldVoucher->pluck('paid_price')->sum() * 15) / 100 }}
                                    </h5>
                                    <small class="text-muted">SAR</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-4">
                                <div class="progress w-100" style="height: 8px">
                                    <div class="progress-bar bg-info"
                                        style="width: {{ $soldVoucher->pluck('paid_price')->sum() - ($soldVoucher->pluck('paid_price')->sum() * 15) / 100 }}%"
                                        role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width:  {{ ($soldVoucher->pluck('paid_price')->sum() * 15) / 100 }}%"
                                        aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales Overview -->

                <!-- Revenue Generated -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded-pill p-2">
                                    <i class="ti ti-credit-card ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">{{ $profit / 1000 }}k</h5>
                            <small data-i18n="Revenue Generated">Revenue Generated</small>
                        </div>
                        <div id="revenueGenerated"></div>
                    </div>
                </div>
                <!--/ Revenue Generated -->

                <!-- Earning Reports -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                            <div class="card-title mb-0">
                                <h5 class="mb-0" data-i18n="Earning Reports">Earning Reports</h5>
                                <small class="text-muted" data-i18n="Weekly Earnings Overview">Weekly Earnings
                                    Overview</small>
                            </div>
                            {{-- <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="earningReportsId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                          </div>
                        </div> --}}
                            <!-- </div> -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                                    <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                                        <h1 class="mb-0">{{ $weekVoucher->pluck('paid_price')->sum() }}</h1>
                                        <div class="badge rounded bg-label-success"></div>
                                    </div>
                                    <small data-i18n="You informed of this week">You informed of this week</small>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div id="weeklyEarningReports"></div>
                                </div>
                            </div>
                            <div class="border rounded p-3 mt-4">
                                <div class="row gap-4 gap-sm-0">
                                    <div class="col-12 col-sm-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-primary p-1">
                                                <i class="ti ti-currency-dollar ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0" data-i18n="Total sold vouchers">Total sold vouchers</h6>
                                        </div>
                                        <h4 class="my-2 pt-1">{{ $weekVoucher->pluck('paid_price')->sum() }}</h4>
                                        <div class="progress w-75" style="height: 4px">
                                            <div class="progress-bar" role="progressbar" style="width: 65%"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-info p-1"><i
                                                    class="ti ti-chart-pie-2 ti-sm"></i></div>
                                            <h6 class="mb-0" data-i18n="Commission">Commission</h6>
                                        </div>
                                        <h4 class="my-2 pt-1">{{ $profit }}</h4>
                                        <div class="progress w-75" style="height: 4px">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="badge rounded bg-label-danger p-1">
                                                <i class="ti ti-brand-paypal ti-sm"></i>
                                            </div>
                                            <h6 class="mb-0" data-i18n="Tax">Tax</h6>
                                        </div>
                                        <h4 class="my-2 pt-1"> {{ ($soldVoucher->pluck('paid_price')->sum() * 15) / 100 }}
                                        </h4>
                                        <div class="progress w-75" style="height: 4px">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Earning Reports -->

                <!-- Support Tracker -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="background-color: rgb(62, 158, 84)">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="mb-0" data-i18n="Support Tracker">Support Tracker</h5>
                                <small class="" data-i18n="Last 7 Days" style="color: black">Last 7
                                    Days</small>
                            </div>
                            {{-- <div class="dropdown">
                          <button
                            class="btn p-0"
                            type="button"
                            id="supportTrackerMenu"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                          </div>
                        </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                        <h1 class="mb-0">{{ $weekVoucher->count() }}</h1>
                                        <p class="mb-0" data-i18n="Total Redeemed Vouchers This Week">Total Redeemed
                                            Vouchers This Week</p>
                                    </div>
                                    <ul class="p-0 m-0">
                                        <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                            <div class="badge rounded bg-label-primary p-1"><i
                                                    class="ti ti-ticket ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap" data-i18n="New Customers">New Customers</h6>
                                                <small class="text-muted">{{ $weekCustomer->count() }}</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                            <div class="badge rounded bg-label-info p-1">
                                                <i class="ti ti-circle-check ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap" data-i18n="New Vouchers">New Vouchers</h6>
                                                <small class="text-muted">{{ $weekVouchers->count() }}</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-3 align-items-center pb-1">
                                            <div class="badge rounded bg-label-warning p-1"><i
                                                    class="ti ti-clock ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap" data-i18n="New Brands">New Brands</h6>
                                                <small class="text-muted">{{ $weekBrands->count() }}</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                    <div id="supportTracker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endif
    </div>
    <!-- / Content -->
@endsection
