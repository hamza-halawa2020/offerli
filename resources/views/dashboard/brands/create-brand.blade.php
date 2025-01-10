@extends('dashboard.layout.app')

@section('title')
    <title> New Brand</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Brands'))
        <form id="formAccountSettings" action="{{ route('brands.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div
                class="layout-wrapper layout-content-navbar light-style layout-navbar-fixed layout-menu-fixed layout-compact">
                <div class="layout-container">
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-12 mb-6">
                                    <div class="bs-stepper wizard-numbered mt-2">
                                        <div class="bs-stepper-header">
                                            <div class="step" data-target="#brand-info">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Brand Info</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="line">
                                                <i class="ti ti-chevron-right"></i>
                                            </div>
                                            <div class="step" data-target="#images">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">images</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="line">
                                                <i class="ti ti-chevron-right"></i>
                                            </div>
                                            <div class="step" data-target="#location">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">location</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="line">
                                                <i class="ti ti-chevron-right"></i>
                                            </div>
                                            <div class="step" data-target="#billing-info">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-circle">4</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Billing Info</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="line">
                                                <i class="ti ti-chevron-right"></i>
                                            </div>
                                            <div class="step" data-target="#opening-times">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-circle">5</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Opening Times</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="bs-stepper-content">
                                            <form onSubmit="return false">
                                                <!-- Brand Info  -->
                                                <div id="brand-info" class="content">

                                                    <div class="row g-6">
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="Name">Name</label>
                                                            <input type="text" id="Name" name="name"
                                                                class="form-control" placeholder="Name" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="username">Arabic Name</label>
                                                            <input type="text" id="username" name="name_ar"
                                                                class="form-control" placeholder="Arabic Name" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="email" id="email" class="form-control"
                                                                placeholder="john.doe@email.com" name="email"
                                                                aria-label="john.doe" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="phone">phone</label>
                                                            <input type="text" id="phone" name="phone"
                                                                class="form-control" placeholder="phone" />
                                                        </div>
                                                        <div class="col-sm-6 form-password-toggle">
                                                            <label class="form-label" for="password">Password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="password" name="password"
                                                                    class="form-control"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password2" />
                                                                <span class="input-group-text cursor-pointer"
                                                                    id="password2"><i class="ti ti-eye-off"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 form-password-toggle">
                                                            <label class="form-label" for="confirm-password">Confirm
                                                                Password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="confirm-password"
                                                                    name="password_confirmation" class="form-control"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="confirm-password2" />
                                                                <span class="input-group-text cursor-pointer"
                                                                    id="confirm-password2"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label"
                                                                for="description">description</label>
                                                            <input type="text" id="description" class="form-control"
                                                                name="description" placeholder="description" />
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- images -->
                                                <div id="images" class="content">


                                                    <div class="row g-6">

                                                        <div class="col-sm-6">
                                                            <label for="logo" class="form-label" data-i18n="logo">Com
                                                                Reg
                                                                No</label>
                                                            <input type="file" class="form-control" id="logo"
                                                                name="logo" placeholder="logo" />
                                                        </div>

                                                        {{-- <div class="col-sm-6">
                                                            <label class="form-label" for="country">Country</label>
                                                            <select class="select2" id="country">
                                                                <option label=" "></option>
                                                                <option>UK</option>
                                                                <option>USA</option>
                                                                <option>Spain</option>
                                                                <option>France</option>
                                                                <option>Italy</option>
                                                                <option>Australia</option>
                                                            </select>
                                                        </div> --}}
                                                        {{-- <div class="col-sm-6">
                                                            <label class="form-label" for="language">Language</label>
                                                            <select class="selectpicker w-auto" id="language"
                                                                data-style="btn-transparent" data-icon-base="ti"
                                                                data-tick-icon="ti-check text-white" multiple>
                                                                <option>English</option>
                                                                <option>French</option>
                                                                <option>Spanish</option>
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <!-- location -->
                                                <div id="location" class="content">
                                                    <div class="col">
                                                        <label class="form-label" for="address">address</label>
                                                        <input type="text" id="address" name="address"
                                                            class="form-control" placeholder="address" />
                                                    </div>
                                                    <div class="row g-6">

                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="longitude">longitude</label>
                                                            <input type="text" id="longitude" name="longitude"
                                                                class="form-control" placeholder="longitude" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="latitude">latitude</label>
                                                            <input type="text" id="latitude" name="latitude"
                                                                class="form-control" placeholder="latitude" />
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- Billing Info -->
                                                <div id="billing-info" class="content">
                                                    <div class="row g-6">

                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="Percentage">Percentage</label>
                                                            <input type="text" id="Percentage" class="form-control"
                                                                name="percentage" placeholder="Percentage" />
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="vat_no">vat_no</label>
                                                            <input type="text" id="vat_no" name="vat_no"
                                                                class="form-control" placeholder="vat_no" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="Com_Reg_No">Com_Reg_No</label>
                                                            <input type="text" id="Com_Reg_No" name="Com_Reg_No"
                                                                class="form-control" placeholder="Com_Reg_No" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="other_fee">other_fee</label>
                                                            <input type="text" id="other_fee" name="other_fee"
                                                                class="form-control" placeholder="other_fee" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- opening times -->
                                                <div id="opening-times" class="content">
                                                    <div class="row g-6">
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="vat_no">vat_no</label>
                                                            <input type="text" id="vat_no" name="vat_no"
                                                                class="form-control" placeholder="vat_no" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="Com_Reg_No">Com_Reg_No</label>
                                                            <input type="text" id="Com_Reg_No" name="Com_Reg_No"
                                                                class="form-control" placeholder="Com_Reg_No" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="other_fee">other_fee</label>
                                                            <input type="text" id="other_fee" name="other_fee"
                                                                class="form-control" placeholder="other_fee" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="logo" class="form-label" data-i18n="logo">Com
                                                                Reg
                                                                No</label>
                                                            <input type="file" class="form-control" id="logo"
                                                                name="logo" placeholder="logo" />
                                                        </div>
                                                        <div class="mt-3 col-12 d-flex justify-content-between">
                                                            <button class="btn btn-success btn-submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
