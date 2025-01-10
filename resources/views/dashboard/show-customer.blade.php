@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Customer">customer</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Customers'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-2">
                <span class="text-muted fw-light" data-i18n="Customer Details">Customer Details / {{ $customer->name }}
                </span>
            </h4>
            {{--
            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1">Customer ID #{{$customer->name}}</h4>
                    <p class="mb-0">{{now()}}</p>
                </div>
                <button type="button" class="btn btn-label-danger delete-customer">Delete Customer</button>
            </div> --}}

            <div class="row">
                <!-- Customer-detail Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- Customer-detail Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="customer-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded my-3" src="../../assets/img/avatars/15.png" height="110"
                                        width="110" alt="User avatar" />
                                    <div class="customer-info text-center">
                                        <h4 class="mb-1">{{ $customer->name }} </h4>
                                        <small>Customer ID #{{ $customer->id }} </small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around flex-wrap my-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary">
                                            <i class="ti ti-shopping-cart ti-md"></i>
                                        </div>
                                    </div>
                                    <div class="gap-0 d-flex flex-column">
                                        <p class="mb-0 fw-medium">{{ $customer->customervoucherredeemed()->count() }} </p>
                                        <small>Orders</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary">
                                            <i class="ti ti-currency-dollar ti-md"></i>
                                        </div>
                                    </div>
                                    <div class="gap-0 d-flex flex-column">
                                        <p class="mb-0 fw-medium">
                                            {{ $customer->customervoucherredeemed()->sum('paid_price') }}</p>
                                        <small>Spent</small>
                                    </div>
                                </div>
                            </div>

                            <div class="info-container">
                                <small
                                    class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Username:</span>
                                        <span>{{ $customer->name }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Email:</span>
                                        <span>{{ $customer->email }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Status:</span>
                                        <span class="badge bg-label-success">Active</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Contact:</span>
                                        <span>{{ $customer->phone }}</span>
                                    </li>

                                </ul>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                        data-bs-toggle="modal" data-i18n="Edit Details">Edit Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /Plan Card -->
                </div>
                <!--/ Customer Sidebar -->

                <!-- Customer Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Customer Pills -->
                    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link active py-2" href="javascript:void(0);"><i
                                    class="ti ti-user me-1"></i>Overview</a>
                        </li>

                    </ul> --}}
                    <!--/ Customer Pills -->

                    <!-- / Customer cards -->
                    <div class="row text-nowrap">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                            <div class="avatar-initial rounded bg-label-primary">
                                                <i class="ti ti-currency-dollar ti-md"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3" data-i18n="Account Balance">Account Balance</h4>
                                        <div class="d-flex align-items-baseline mb-1 gap-1">
                                            <h4 class="text-primary mb-0">{{ $customer->wallet }}</h4>
                                            <p class="mb-0">Credit Left</p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Account balance for next purchase</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                            <div class="avatar-initial rounded bg-label-success">
                                                <i class="ti ti-gift ti-md"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3" data-i18n="Offerli Customer">Offerli Customer</h4>
                                        <span class="badge bg-label-success mb-2">Total Spent</span>
                                        <p class="text-muted mb-0">
                                            {{ $customer->customervoucherredeemed()->sum('paid_price') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                            <div class="avatar-initial rounded bg-label-warning">
                                                <i class="ti ti-star ti-md"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3" data-i18n="Wishlist">Wishlist</h4>
                                        <div class="d-flex align-items-baseline mb-1 gap-1">
                                            <h4 class="text-warning mb-0">15</h4>
                                            <p class="mb-0">Items in wishlist</p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Receive notification when items go on sale
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                            <div class="avatar-initial rounded bg-label-info">
                                                <i class="ti ti-discount ti-md"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3" data-i18n="Vouchers">Vouchers</h4>
                                        <div class="d-flex align-items-baseline mb-1 gap-1">
                                            <h4 class="text-info mb-0">{{ $customer->customervoucherredeemed()->count() }}
                                            </h4>
                                            <p class="mb-0">Vouchers you win</p>
                                        </div>

                                        <p class="text-muted mb-0 text-truncate">Use Voucher on next purchase</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- / customer cards -->


                </div>
                <!--/ Customer Content -->
            </div>

            <!-- Modal -->
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Edit User Information</h3>
                                <p class="text-muted">Updating user details will receive a privacy audit.</p>
                            </div>
                            <form action="{{ route('customers.update', compact('customer')) }}" method="POST"
                                id="editUserForm" class="row g-3">
                                @csrf
                                @method('Patch')
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserFirstName">Name</label>
                                    <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                        class="form-control" placeholder="John" value="{{ $customer->name }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserFirstNameAR">Arabic Name</label>
                                    <input type="text" id="modalEditUserFirstNameAR" name="modalEditUserFirstNameAR"
                                        class="form-control" placeholder="جون" value="{{ $customer->name_ar }}" />
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserEmail">Email</label>
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ $customer->email }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"></span>
                                        <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                            class="form-control phone-number-mask" placeholder="202 555 0111"
                                            value="{{ $customer->phone }}" />
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit User Modal -->

            <!-- Add New Credit Card Modal -->
            {{-- <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Upgrade Plan</h3>
                                <p>Choose the best plan for user.</p>
                            </div>
                            <form id="upgradePlanForm" class="row g-3" onsubmit="return false">
                                <div class="col-sm-8">
                                    <label class="form-label" for="choosePlan">Choose Plan</label>
                                    <select id="choosePlan" name="choosePlan" class="form-select"
                                        aria-label="Choose Plan">
                                        <option selected>Choose Plan</option>
                                        <option value="standard">Standard - $99/month</option>
                                        <option value="exclusive">Exclusive - $249/month</option>
                                        <option value="Enterprise">Enterprise - $499/month</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">Upgrade</button>
                                </div>
                            </form>
                        </div>
                        <hr class="mx-md-n5 mx-n3" />
                        <div class="modal-body">
                            <p class="mb-0">User current plan is standard plan</p>
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex justify-content-center me-2">
                                    <sup class="h6 pricing-currency pt-1 mt-3 mb-0 me-1 text-primary">$</sup>
                                    <h1 class="display-5 mb-0 text-primary">99</h1>
                                    <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/month</sub>
                                </div>
                                <button class="btn btn-label-danger cancel-subscription mt-3">Cancel Subscription</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--/ Add New Credit Card Modal -->

            <!-- /Modal -->
        </div>
    @endif
@endsection
